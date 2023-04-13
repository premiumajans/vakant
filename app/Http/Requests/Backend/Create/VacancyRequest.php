<?php

namespace App\Http\Requests\Backend\Create;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'email' => 'required|email',
            'position' => 'required',
            'company' => 'required',
            'candidate_requirements' => 'required',
            'about_job' => 'required',
        ];
    }
}
