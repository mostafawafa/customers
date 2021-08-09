<?php

namespace Customers\Contracts;

interface CountryToCodeMapperInterface
{
    public function getCountry(string $code);

    public function getCode(string $country);
}
