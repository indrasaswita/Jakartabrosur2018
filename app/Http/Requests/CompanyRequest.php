<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompanyRequest extends Request
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
            'nickname' => 'required',
            'address' => 'required',
            'phone1' => 'required|min:5|max:15',
            'phone2' => 'max:15',
            'phone3' => 'max:15',
            'type' => 'required'
        ];
    }
}
