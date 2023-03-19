<?php

namespace App\Http\Requests\Frontend\Create;

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
            'email' => 'required|email|unique:admins|unique:vacancies|unique:companies',
            'phone' => 'required|min:7|unique:vacancies|unique:companies',
            'position' => 'required',
            'company' => 'required',
            'relevant_people' => 'required',
            'candidate_requirements' => 'required',
            'about_job' => 'required',
        ];
    }
}
