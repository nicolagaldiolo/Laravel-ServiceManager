<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        if ($this->method() == 'PATCH') {
            $user = $this->route('user');
            $email = 'required|email|unique:users,email,' . $user->id;
        } else {
            $email = 'required|email|unique:users,email';
        }

        return [
            'name'      => 'sometimes|string',
            'email'     => $email,
            'role'      => ['sometimes','required', Rule::in(['user', 'admin'])],
            //'avatar'    => 'sometimes|image|mimes:jpeg,bmp,png'
        ];
    }
}
