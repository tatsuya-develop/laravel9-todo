<?php

namespace Database\Factories;

trait FactoryTrait
{
    public function sequentCode(int $seq): string
    {
        return str_pad($seq, 4, '0', STR_PAD_LEFT);
    }
}
