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
            //$deadline = 'sometimes|date|date_format:d-m-Y|after:' . date('d-m-Y');
            $deadline = 'sometimes|date';
        } else {
            $url_rule = 'required|url|unique:domains,url';
            //$deadline = 'required|date|date_format:d-m-Y|after:' . date('d-m-Y');
            $deadline = 'required|date';
        }

        return [
            'url'       => $url_rule, // mi permette di ignorare i cambiamenti se l'url che stiamo passando appartiene al record corrent, se è cambiato allora scatta il controllo di validazione
            'domain_id'     => 'sometimes|nullable|exists:providers,id',
            'hosting_id'    => 'sometimes|nullable|exists:providers,id',
            'customer_id'   => 'required|exists:customers,id',
            'deadline'      => $deadline,
            'amount'        => 'sometimes|regex:/[0-9]+[.,]?[0-9]*/|max:8',
            'payed'         => 'sometimes|boolean',
            'note'          => 'sometimes|max:255'
        ];
    }
}