<?php

namespace App\Representations;

use Customers\Entities\Customer;

class CustomerRepresentation implements RepresentationInterface
{
    private $customersEntities;

    public function __construct($customers)
    {
        $this->customersEntities = $customers;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function toArray()
    {
        $customers = [];
        /** @var  $customer Customer */
        foreach ($this->customersEntities as $customer) {
            $customers[] = [
                'id' => $customer->getId(),
                'name' => $customer->getName(),
                'isValidPhone' => $customer->isValidPhone(),
                'phone' => $customer->getLocalNumber(),
                'code' => $customer->getPhoneCode(),
                'country' => $customer->getPhoneCountry()
            ];
        }

        return $customers;
    }
}
