<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CheckUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'phone' => 'required|unique:vacancies|unique:companies',
            'email' => 'required|email|unique:admins|unique:vacancies|unique:companies'
        ];
    }
}
