<?php

namespace App\Http\Requests;

use App\Enums\RenewalSM;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRenewalRequest extends FormRequest
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

        $renewal = $this->route('renewal') ? $this->route('renewal')->id : 'NULL';
        $service = $this->route('service') ? $this->route('service')->id : 'NULL';
        //unique:table,column,except,idColumn

        return [
            'amount'        => 'sometimes|regex:/[0-9]+[.,]?[0-9]*/|max:8',
            'deadline'      => 'required|date|date_format:d-m-Y|unique:renewals,deadline,' . $renewal . ',id,service_id,' . $service,
            //'deadline'      => 'date_format:Y-m-d|required|date|unique:renewals,deadline',
            'status'        => ['sometimes', 'required', new EnumValue(RenewalSM::class, false)],
        ];
    }
}
