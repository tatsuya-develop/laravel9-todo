<?php

namespace App\Helpers;

class Message
{
    public static function error(string $code, ...$args): string
    {
        $message = __("messages.errors.$code");

        return "[$code] " . sprintf($message, ...$args);
    }
}
