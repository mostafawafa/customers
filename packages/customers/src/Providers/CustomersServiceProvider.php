<?php

namespace Customers\Providers;

use Customers\Contracts\CacheInterface;
use Customers\Contracts\CountryToCodeMapperInterface;
use Customers\Contracts\CustomersFilterServiceInterface;
use Customers\Contracts\CustomersGetterInterface;
use Customers\Contracts\CustomersRepositoryInterface;
use Customers\Contracts\PhoneNumbersValidatorInterface;
use Customers\Infrastructure\CacheAdapter;
use Customers\Infrastructure\Repositories\CustomersRepository;
use Customers\Services\CountryToCodeMapper;
use Customers\Services\CustomersFilterService;
use Customers\Services\PhoneNumbersRegexValidator;
use Illuminate\Support\ServiceProvider;


class CustomersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CustomersRepositoryInterface::class, CustomersRepository::class);
        $this->app->bind(CountryToCodeMapperInterface::class, CountryToCodeMapper::class);
        $this->app->bind(PhoneNumbersValidatorInterface::class, PhoneNumbersRegexValidator::class);
        $this->app->bind(CustomersFilterServiceInterface::class, CustomersFilterService::class);
        $this->app->bind(CacheInterface::class, CacheAdapter::class);

    }

}
