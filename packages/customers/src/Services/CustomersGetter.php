<?php

namespace Customers\Services;

use Customers\Contracts\CacheInterface;
use Customers\Contracts\CustomersFilterServiceInterface;
use Customers\Contracts\CustomersRepositoryInterface;

class CustomersGetter
{
    private CustomersRepositoryInterface $customersRepository;

    private CustomersFilterServiceInterface $customersFilterService;

    private CacheInterface $cacheDriver;

    /**
     * CustomersGetter constructor.
     * @param CustomersRepositoryInterface $customersRepository
     * @param CustomersFilterServiceInterface $customersFilterService
     * @param CacheInterface $cacheDriver
     */
    public function __construct(
        CustomersRepositoryInterface $customersRepository,
        CustomersFilterServiceInterface $customersFilterService,
        CacheInterface $cacheDriver
    )
    {
        $this->customersRepository = $customersRepository;
        $this->customersFilterService = $customersFilterService;
        $this->cacheDriver = $cacheDriver;
    }

    function getAll(array $filters = [])
    {
        $cacheKey = md5(implode('-', $filters));

        if ($this->cacheDriver->has($cacheKey)) {
            return $this->cacheDriver->get($cacheKey);
        }

        $customers = $this->customersRepository->getAll();

        if ($filters) {
            $customers = $this->customersFilterService->execute($customers, $filters);
        }

        $this->cacheDriver->put($cacheKey, $customers, 3600);

        return $customers;
    }
}
