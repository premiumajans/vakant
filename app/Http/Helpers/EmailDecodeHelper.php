<?php

namespace App\Http\Helpers;

class EmailDecodeHelper
{
    public static function decode($encodedEmail)
    {
        $email = '';
        $key = hexdec(substr($encodedEmail, 0, 2));
        for ($i = 2; $i < strlen($encodedEmail) - 1; $i += 2) {
            $email .= chr(hexdec(substr($encodedEmail, $i, 2)) ^ $key);
        }
        return $email;
    }
}
