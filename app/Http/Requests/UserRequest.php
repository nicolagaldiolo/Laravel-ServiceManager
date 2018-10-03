<?php

namespace App\Http\Requests;

use App\Enums\UserType;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

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
        $user = $this->route('user') ? $this->route('user')->id : 'NULL';
        //unique:table,column,except,idColumn

        return [
            'name'      => 'sometimes|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email,' . $user,
            'password'  => 'sometimes|string|min:6|max:255|confirmed',
            'role'      => ['required', new EnumValue(UserType::class, false)],
        ];
    }
}
