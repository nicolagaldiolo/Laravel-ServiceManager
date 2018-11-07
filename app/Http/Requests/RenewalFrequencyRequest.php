<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
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
        $type = $this->request->get('type');

        return [
            'value' => 'required|numeric|min:1|unique:renewal_frequencies,value,' . $renewalFrequency . ',id,type,' . $type . ',user_id,' . Auth::user()->id,
            'type' => 'required|numeric'
        ];
    }
}
