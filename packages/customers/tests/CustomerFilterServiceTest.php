<?php

namespace Customers\Tests;

use Customers\Contracts\CustomersRepositoryInterface;
use Customers\Entities\Customer;
use Customers\Services\CustomersFilterService;
use PHPUnit\Framework\TestCase;

class CustomerFilterServiceTest extends TestCase
{

    private $customersRepoMock;

    public function setUp(): void
    {
        $this->customersRepoMock = $this->createMock(CustomersRepositoryInterface::class);
    }

    public function testCustomersFilterServiceReturnFilteredPhoneCountry()
    {
        // Given
        $validEntity = new Customer();
        $validEntity->setPhoneCountry('mozambique');

        $notValidEntity = new Customer();
        $notValidEntity->setPhoneCountry('cameron');

        $this->customersRepoMock->method('getAll')->willReturn([$validEntity, $notValidEntity]);
        $customersFilterService = new CustomersFilterService();

        // When
        $validCustomers = $customersFilterService->execute([$validEntity, $notValidEntity], ['phoneCountry' => 'mozambique']);

        // Then
        $this->assertCount(1, $validCustomers);
    }

    public function testCustomersFilterServiceReturnFilteredValidPhone()
    {
        // Given
        $validEntity = new Customer();
        $validEntity->setIsValidPhone(true);

        $notValidEntity = new Customer();
        $notValidEntity->setIsValidPhone(false);

        $this->customersRepoMock->method('getAll')->willReturn([$validEntity, $notValidEntity]);
        $customersFilterService = new CustomersFilterService();

        // When
        $validCustomers = $customersFilterService->execute([$validEntity, $notValidEntity], ['isValidPhone' => true]);

        // Then
        $this->assertCount(1, $validCustomers);
    }

}
