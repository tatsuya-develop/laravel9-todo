<?php

namespace App\Helpers;

class Word
{
    public static function field(string $code, ...$args): string
    {
        $message = __("words.fields.$code");

        return sprintf($message, ...$args);
    }
}
