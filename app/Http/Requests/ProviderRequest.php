<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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

        if ($this->method() == 'PUT') {
            $provider = $this->route('provider');
            $name_rule = 'required|string|max:255|unique:providers,name,'.$provider->id; // mi permette di ignorare i cambiamenti se il nome che stiamo passando appartiene al record corrent, se è cambiato allora scatta il controllo di validazione',
            $website_rule = 'sometimes|string|max:255|unique:providers,website,'.$provider->id; // mi permette di ignorare i cambiamenti se l'url che stiamo passando appartiene al record corrent, se è cambiato allora scatta il controllo di validazione',
        } else {
            $name_rule = 'required|string|max:255|unique:providers,name';
            $website_rule = 'sometimes|string|max:255|unique:providers,website';
        }

        return [
            'name'      => $name_rule,
            'label'     => 'sometimes|string|max:255',
            'website'    => $website_rule
        ];
    }
}
