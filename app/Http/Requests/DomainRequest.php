<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainRequest extends FormRequest
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
        return [
            'url'       => 'required|url',
            'domain'    => 'sometimes|exists:providers,id',
            'hosting'   => 'sometimes|exists:providers,id',
            'deadline'  => 'required|date',
            'amount'    => 'required|numeric',
            'payed'     => 'required|boolean',
            'note'      => 'sometimes|string|max:255'
        ];
    }
}
