<?php

namespace App\Http\Requests\Backend\Create;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'phone' => 'required',
            'name' => 'required',
            'email' => 'email|required',
            'address' => 'required',
        ];
    }
}
