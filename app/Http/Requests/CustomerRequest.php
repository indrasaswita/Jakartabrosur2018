<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CustomerRequest extends Request
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
            'companyID' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|max:32',
            'name' => 'required|min:5|max:16',
            'type' => 'required',
            'title' => 'required',
            'address' => 'required|min:12|max:255',
            'cityID' => 'required',
            'postcode' => 'numeric|digits:5',
            'phone1' => 'required|digits_between:8,15',
            'phone2' => 'digits_between:8,15',
            'phone3' => 'digits_between:8,15',
            'news' => 'required'
        ];
    }
}
