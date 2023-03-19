<?php

namespace App\Http\Requests\Backend\Update;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [

        ];
    }
}
