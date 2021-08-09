<?php

namespace Customers\Contracts;

Interface PhoneNumbersValidatorInterface
{
    public function execute($number, $countryCode);
}
