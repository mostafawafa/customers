<?php

namespace Customers\Services;

use Customers\Contracts\PhoneNumbersValidatorInterface;
use Illuminate\Support\Arr;

/**
 * Class PhoneNumbersRegexValidator to validate phone numbers by regex
 * @package Customers\Services
 */
class PhoneNumbersRegexValidator implements PhoneNumbersValidatorInterface
{
    private const REGEX_MAPPING = [
        '237' => '/\(237\)\ ?[2368]\d{7,8}$/',
        '212' => '/\(212\)\ ?[5-9]\d{8}$/',
        '258' => '/\(258\)\ ?[28]\d{7,8}$/',
        '256' => '/\(256\)\ ?\d{9}$/',
        '251' => '/\(251\)\ ?[1-59]\d{8}$/'
    ];

    public function execute($number, $countryCode)
    {
        $regex = Arr::get(self::REGEX_MAPPING, $countryCode);
        return (bool)preg_match($regex, $number);
    }
}
