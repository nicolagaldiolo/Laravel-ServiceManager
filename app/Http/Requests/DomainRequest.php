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

        if ($this->method() == 'PATCH') {
            $domain = $this->route('domain');
            $url_rule = 'required|url|unique:domains,url,' . $domain->id;
        } else {
            $url_rule = 'required|url|unique:domains,url';
        }

        return [
            'url'       => $url_rule, // mi permette di ignorare i cambiamenti se l'url che stiamo passando appartiene al record corrent, se è cambiato allora scatta il controllo di validazione
            'domain_id'     => 'sometimes|exists:providers,id',
            'hosting_id'    => 'sometimes|exists:providers,id',
            'customer_id'   => 'required|exists:customers,id',
            'deadline'      => 'required|date|date_format:d-m-Y|after:' . date('d-m-Y'),
            'amount'        => 'required|regex:/[0-9]+[.,]?[0-9]*/|max:8',
            'payed'         => 'required|boolean',
            'note'          => 'sometimes|max:255'
        ];
    }
}