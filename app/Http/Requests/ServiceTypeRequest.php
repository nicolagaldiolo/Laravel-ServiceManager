<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ServiceTypeRequest extends FormRequest
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

        $serviceType = $this->route('service_type') ? $this->route('service_type')->id : 'NULL';
        //unique:table,column,except,idColumn

        return [
            'name' => 'required|unique:service_types,name,' . $serviceType . ',id,user_id,' . Auth::user()->id
        ];
    }
}
