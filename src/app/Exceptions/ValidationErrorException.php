<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Collection;

class ValidationErrorException extends Exception
{
    public Collection $errors;
    public function __construct(Collection $errors)
    {
        $this->errors = $errors;

        parent::__construct($errors->join(', '));
    }
}
