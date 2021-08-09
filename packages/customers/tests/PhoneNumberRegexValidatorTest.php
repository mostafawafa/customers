<?php

namespace Customers\Tests;

use Customers\Services\PhoneNumbersRegexValidator;
use PHPUnit\Framework\TestCase;

class PhoneNumberRegexValidatorTest extends TestCase
{
    private string $validPhone;
    private string $countryCode;
    private string $notValidPhone;
    private PhoneNumbersRegexValidator $validator;

    public function setUp(): void
    {
        $this->countryCode = '237';
        $this->validPhone = '(237) 697151594';
        $this->notValidPhone = '(237) 9311168450';
        $this->validator = new PhoneNumbersRegexValidator();
    }

    public function testReturnTrueIfValidRegex()
    {
        $result = $this->validator->execute($this->validPhone, $this->countryCode);

        $this->assertTrue($result);
    }

    public function testReturnFalseIfNotValidRegex()
    {
        $result = $this->validator->execute($this->notValidPhone, $this->countryCode);

        $this->assertFalse($result);
    }
}
