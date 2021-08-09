<?php

namespace Customers\Tests;

use Customers\Contracts\CacheInterface;
use Customers\Contracts\CustomersFilterServiceInterface;
use Customers\Contracts\CustomersRepositoryInterface;
use Customers\Services\CustomersGetter;
use PHPUnit\Framework\TestCase;

class CustomersGetterTest extends TestCase
{

    public function testCustomersGetterNotCallingDatabaseIfThereIsCacheAvailable()
    {
        $customerRepositoryMock = $this->createMock(CustomersRepositoryInterface::class);
        $filtersService = $this->createMock(CustomersFilterServiceInterface::class);
        $cacheMock = $this->createStub(CacheInterface::class);

        $customerGetter = new CustomersGetter(
            $customerRepositoryMock,
            $filtersService,
            $cacheMock
        );

        $cacheMock->method('has')->willReturn(true);

        $customerRepositoryMock->expects($this->never())->method('getAll');

        $customerGetter->getAll(['phoneCountry' => 'morocco']);

    }


    public function testCustomersGetterCallingDatabaseIfThereIsNoCacheAvailable()
    {
        $customerRepositoryMock = $this->createMock(CustomersRepositoryInterface::class);
        $filtersService = $this->createMock(CustomersFilterServiceInterface::class);
        $cacheMock = $this->createStub(CacheInterface::class);
        $customerGetter = new CustomersGetter($customerRepositoryMock, $filtersService, $cacheMock);

        $customerRepositoryMock->expects($this->once())->method('getAll');

        $cacheMock->method('has')->willReturn(false);

        $customerGetter->getAll(['phoneCountry' => 'morocco']);
    }


    public function testCustomersGetterNotCallingFilterServiceIfNotNeeded()
    {
        $customerRepositoryMock = $this->createMock(CustomersRepositoryInterface::class);
        $filtersService = $this->createMock(CustomersFilterServiceInterface::class);
        $cacheMock = $this->createMock(CacheInterface::class);
        $customerGetter = new CustomersGetter($customerRepositoryMock, $filtersService, $cacheMock);
        $cacheMock->method('has')->willReturn(false);

        $filtersService->expects($this->once())->method('execute');

        $customerGetter->getAll(['phoneCountry' => 'morocco']);
    }

}
