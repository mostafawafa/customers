<?php

namespace Customers\Services;

use Customers\Contracts\CountryToCodeMapperInterface;
use Illuminate\Support\Arr;

/**
 * Class CountryToCodeMapper Mapper between phone code and country
 * @package Customers\Services
 */
class CountryToCodeMapper implements CountryToCodeMapperInterface
{
    private const COUNTRY_MAPPING = [
        237 => "cameroon",
        212 => "morocco",
        258 => "mozambique",
        251 => "ethiopia",
        256 => "uganda"
    ];

    public function getCountry(string $code)
    {
        return Arr::get(self::COUNTRY_MAPPING, $code);
    }

    public function getCode(string $country)
    {
        return Arr::get(array_flip(self::COUNTRY_MAPPING), strtolower($country));
    }
}
