<?php

namespace App\Http\Requests\Backend\Mixins;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|max:50',
            'password' => 'required|min:5'
        ];
    }

    public function attributes()
    {
        return [

            'email' => __('backend.email'),
            'password' => __('backend.password')
        ];
    }
}
