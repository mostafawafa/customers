<?php

namespace Customers\Contracts;

interface CustomersFilterServiceInterface
{
    public function execute($customers, $filters);
}
