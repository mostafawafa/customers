<?php

namespace Customers\Infrastructure\Repositories;

use Customers\Contracts\CountryToCodeMapperInterface;
use Customers\Contracts\CustomersRepositoryInterface;
use Customers\Contracts\PhoneNumbersValidatorInterface;
use Customers\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;

class CustomersRepository implements CustomersRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    private CountryToCodeMapperInterface $codeMapper;

    private PhoneNumbersValidatorInterface $phoneNumberValidator;

    public function __construct(
        EntityManagerInterface $entityManager,
        CountryToCodeMapperInterface $codeMapper,
        PhoneNumbersValidatorInterface $phoneNumberValidator
    )
    {
        $this->entityManager = $entityManager;
        $this->codeMapper = $codeMapper;
        $this->phoneNumberValidator = $phoneNumberValidator;
    }

    /**
     * Return array of all customers entities
     */
    public function getAll()
    {
        $qb = $this->entityManager->createQueryBuilder()
            ->select('customer')
            ->from(Customer::class, 'customer');

        /** @var $customers Customer[] */
        $customers = $qb->getQuery()->getResult();

        /**
         * Add needed attributes to entities to return complete entities
         */
        foreach ($customers as $customer) {
            $customer->setIsValidPhone($this->phoneNumberValidator->execute($customer->getPhoneNumber(), $customer->getPhoneCode()));
            $customer->setPhoneCountry($this->codeMapper->getCountry($customer->getPhoneCode()));
        }

        return $customers;
    }


}
