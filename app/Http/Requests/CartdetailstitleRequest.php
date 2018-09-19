<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CartdetailstitleRequest extends Request
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
            'cartID'=>'required|integer',
            'jobtitle'=>'required|min:12|max:128',
            'jobtype'=>'required',
            'customernote'=>'max:255',
        ];
    }
}
