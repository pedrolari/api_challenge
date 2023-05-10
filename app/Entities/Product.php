<?php

namespace App\Entities;

use ReflectionException;

/**
 * @OA\Schema(
 *     title="Product",
 *     description="Product entity model",
 * )
 */
class Product
{
    /**
     * @OA\Property(
     *     title="Product ID",
     *     description="Product ID",
     *     type="integer",
     *     example="123"
     * )
     */
    private int $id;


    /**
     * @OA\Property(
     *     title="Product name",
     *     description="Product name",
     *     type="string",
     *     example="Cuadro de pintura"
     * )
     */
    private string $name;

    /**
     * @OA\Property(
     *     title="Product On Sale",
     *     description="Product On Sale",
     *     type="boolean",
     *     example="True"
     * )
     */
    private bool $onSale;


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool
     */
    public function getOnSale(): bool
    {
        return $this->onSale;
    }

    /**
     * @param bool $onSale
     *
     * @return $this
     */
    public function setOnSale(bool $onSale): self
    {
        $this->onSale = $onSale;

        return $this;
    }

    /**
     * @param array $fields
     * @return $this
     * @throws ReflectionException
     */
    public function deserialize(array $fields): self
    {
        // Array to string conversion
        foreach ($fields as &$field) {
            if (is_array($field)) {
                $field = json_encode($field);
            }
        }

        $reflectionClass = new \ReflectionClass($this::class);
        $propertyNames = array_keys($fields);

        foreach ($reflectionClass->getProperties() as $property) {
            if (in_array($property->name, $propertyNames)) {
                $setterMethod = $reflectionClass->getMethod('set' . ucfirst($property->name));
                $setterMethod->invoke($this, $fields[$property->name]);
            }
        }

        return $this;
    }
}
