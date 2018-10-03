<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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

        $provider = $this->route('provider') ? $this->route('provider')->id : 'NULL';
        //unique:table,column,except,idColumn

        return [
            'name'      => 'required|unique:providers,name,' . $provider . ',id,user_id,' . Auth::user()->id,
            'website'   => 'sometimes|nullable|url|max:255',
            'label'     => 'sometimes|max:7',
        ];
    }
}
