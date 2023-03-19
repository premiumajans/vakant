<?php

namespace App\Http\Requests\User\Update;

use Illuminate\Foundation\Http\FormRequest;

class SecurityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'currentPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ];
    }
}
