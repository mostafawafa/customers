<?php

namespace Customers\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;
    /**
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private string $phoneNumber;

    private bool $isValid;
    private string $phoneCountry;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getPhoneCode(): string
    {
        preg_match('/\((\d+)\)/', $this->phoneNumber, $code);
        return $code[1];
    }

    /**
     * @return bool
     */
    public function isValidPhone(): bool
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     */
    public function setIsValidPhone(bool $isValid): void
    {
        $this->isValid = $isValid;
    }

    /**
     * @return string
     */
    public function getPhoneCountry(): string
    {
        return $this->phoneCountry;
    }

    /**
     * @param string $phoneCountry
     */
    public function setPhoneCountry(string $phoneCountry): void
    {
        $this->phoneCountry = $phoneCountry;
    }

    public function getLocalNumber(): string
    {
        preg_match('/\(\d+\)(.*)/', $this->phoneNumber, $code);
        return trim($code[1]);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
