<?php

namespace App\Http\Requests;

use App\Enums\FrequencyRenewals;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $formRequests = [
            ServiceRenewalRequest::class
        ];

        $rules = [
            'url'               => 'required|url|max:255',
            'customer_id'       => 'required|exists:customers,id,user_id,' . Auth::user()->id,
            'provider_id'       => 'required|exists:providers,id,user_id,' . Auth::user()->id,
            'service_type_id'   => 'required|exists:service_types,id,user_id,' . Auth::user()->id,
            'frequency'         => ['required', new EnumValue(FrequencyRenewals::class, false)],
            'note'              => 'sometimes|max:255'
        ];

        // Se sono in creazione quindi non ho passato il parametro service nella rotta
        if(!$this->route('service')){
            foreach ($formRequests as $source) {
                $rules = array_merge($rules, (new $source)->rules()
                );
            }
        }

        return $rules;
    }
}
