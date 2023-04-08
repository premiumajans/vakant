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
            'phone' => 'required|min:7',
            'position' => 'required',
            'company' => 'required',
            'relevant_people' => 'required',
            'candidate_requirements' => 'required',
            'about_job' => 'required',
        ];
    }
}
