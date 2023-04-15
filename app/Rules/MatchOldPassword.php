<?php

namespace App\Rules;

use App\Models\Admin;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MatchOldPassword implements Rule
{
    private $parameter;

    public function __construct($parameter)
    {
        $this->parameter = $parameter;
    }
    public function passes($attribute, $value)
    {
        return '';
    }

    public function message()
    {
        return 'current_password_is_not_correct';
    }
}
