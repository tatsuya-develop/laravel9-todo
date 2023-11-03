<?php

namespace Tests\Unit\ValueObjects\Common;

use App\Exceptions\ValidationErrorException;
use Data\ValueObjects\Common\NotBlankString;
use Tests\Support\TestCase;

class NotBlankStringTest extends TestCase
{
    /**
     * @test
     * @testdox 有効な値であること
     * @throws ValidationErrorException
     */
    public function validString(): void
    {
        $validString = 'Hello World';
        $notBlankString = new NotBlankString($validString, 'field');
        $this->assertEquals($validString, $notBlankString->getValue());
    }

    /**
     * @test
     * @testdox 無効な値はValidationErrorExceptionが発生すること
     */
    public function emptyStringThrowsException(): void
    {
        $this->expectException(ValidationErrorException::class);
        $this->expectExceptionMessageMatches('/\[VLO_0001\]/');

        new NotBlankString('', 'field');
    }
}
