<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RenewalFrequencyRequest extends FormRequest
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

        $renewalFrequency = $this->route('renewal_frequency') ? $this->route('renewal_frequency')->id : 'NULL';
        //unique:table,column,except,idColumn

        return [
            //'name' => 'required|unique:service_types,name,' . $serviceType . ',id,user_id,' . Auth::user()->id
            'value' => 'required|numeric|min:1',
            'type' => 'required|numeric'
        ];
    }
}
