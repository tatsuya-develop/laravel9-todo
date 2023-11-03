<?php

namespace Data\ValueObjects\Common;

use Data\ValueObjects\ValueObject;

class BoolValue extends ValueObject
{
    private bool $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function getValue(): bool
    {
        return $this->value;
    }

    public function isTrue(): bool
    {
        return $this->value === true;
    }

    public function isFalse(): bool
    {
        return $this->value === false;
    }
}
