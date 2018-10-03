<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CustomerRequest extends FormRequest
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

        $customer = $this->route('customer') ? $this->route('customer')->id : 'NULL';
        //unique:table,column,except,idColumn

        return [
            'name'      => 'required|string',
            'email'     => 'required|email|unique:customers,email,' . $customer . ',id,user_id,' . Auth::user()->id,
            'phone'     => 'sometimes',
            'address'   => 'sometimes'
        ];
    }
}
