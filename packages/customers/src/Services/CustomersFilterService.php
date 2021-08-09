<?php

namespace Customers\Services;

use Customers\Contracts\CustomersFilterServiceInterface;
use Customers\Entities\Customer;
use Illuminate\Support\Arr;

class CustomersFilterService implements CustomersFilterServiceInterface
{
    /** Filter customers by removing customers that don't match the conditions
     * @param $customers
     * @param $filters
     * @return array
     */
    public function execute($customers, $filters)
    {
        return array_filter($customers, function (Customer $customer) use ($filters) {
            $phoneCountryFilter = Arr::get($filters, 'phoneCountry');
            if (!empty($phoneCountryFilter) && $customer->getPhoneCountry() != $phoneCountryFilter) {
                return false;
            }
            $isValidPhoneFilter = Arr::get($filters, 'isValidPhone') != '' ? Arr::get($filters, 'isValidPhone'): null;
            if (isset($isValidPhoneFilter) && $customer->isValidPhone() != (bool)$isValidPhoneFilter) {
                return false;
            }
            return true;
        });
    }

}

