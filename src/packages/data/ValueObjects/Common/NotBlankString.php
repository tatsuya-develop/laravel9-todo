<?php

namespace Data\ValueObjects\Common;

use App\Exceptions\ValidationErrorException;
use App\Helpers\Message;
use Data\ValueObjects\ValueObject;

class NotBlankString extends ValueObject
{
    private string $value;

    /**
     * @throws ValidationErrorException
     */
    public function __construct(string $value, string $field)
    {
        if (empty($value)) {
            throw new ValidationErrorException(collect(Message::error('VLO_0001', $field)));
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
