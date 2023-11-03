<?php

namespace Tests\Unit\ValueObjects\Common;

use App\Exceptions\ValidationErrorException;
use Data\ValueObjects\Common\PositiveNumber;
use Tests\Support\TestCase;

class PositiveNumberTest extends TestCase
{
    /**
     * @test
     * @throws ValidationErrorException
     */
    public function validInteger(): void
    {
        $positiveNumber = new PositiveNumber(5, 'field');
        $this->assertInstanceOf(PositiveNumber::class, $positiveNumber);
        $this->assertEquals(5, $positiveNumber->getValue());
    }

    /**
     * @test
     * @testdox 無効な値はValidationErrorExceptionが発生すること
     * @dataProvider provider
     * @param int $invalidValue
     */
    public function invalidIntegerThrowsException(int $invalidValue): void
    {
        $this->expectException(ValidationErrorException::class);
        $this->expectExceptionMessageMatches('/\[VLO_0003\]/');

        new PositiveNumber($invalidValue, 'field');
    }

    /**
     * @return int[][]
     */
    public function provider(): array
    {
        return [
            'zero' => [0],
            'negative' => [-1],
        ];
    }
}
