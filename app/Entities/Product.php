<?php

namespace App\Entities;

class Product
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var ProductTypeEnum|null
     */
    private $type;

    /**
     * @var string[]|null
     */
    private $suppliers;

    public function __construct(string $name, string $description, ?ProductTypeEnum $type, ?array $suppliers)
    {
        $this->name = $name;
        $this->description = $description;
        $this->type = $type;
        $this->suppliers = $suppliers;
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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|null
     */
    public function getType(): ?ProductTypeEnum
    {
        return $this->type;
    }

    /**
     * @return string[]|null
     */
    public function getSuppliers(): ?array
    {
        return $this->suppliers;
    }

    /**
     * @param string[]|null $suppliers
     */
    public function setSuppliers(?array $suppliers): void
    {
        $this->suppliers = $suppliers;
    }
}