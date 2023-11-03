<?php

namespace Data\ValueObjects\Common;

use App\Exceptions\ValidationErrorException;
use App\Helpers\Message;
use Data\ValueObjects\ValueObject;

class PositiveNumber extends ValueObject
{
    private int $value;

    /**
     * @throws ValidationErrorException
     */
    public function __construct(int $value, string $field)
    {
        if ($value <= 0) {
            throw new ValidationErrorException(collect(Message::error('VLO_0003', $field, 1)));
        }

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
