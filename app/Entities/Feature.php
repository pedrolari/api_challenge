<?php

namespace App\Entities;

use ReflectionException;

/**
 * @OA\Schema(
 *     title="Feature",
 *     description="Feature entity model",
 * )
 */
class Feature
{
    /**
     * @OA\Property(
     *     title="Feature ID",
     *     description="Feature ID",
     *     type="integer",
     *     example="123"
     * )
     */
    private int $id;


    /**
     * @OA\Property(
     *     title="Feature name",
     *     description="Feature name",
     *     type="string",
     *     example="De Bolsillo"
     * )
     */
    private string $featureName;

    /**
     * @OA\Property(
     *     title="Feature description",
     *     description="Feature description",
     *     type="string",
     *     example="Libro de bolsillo para leer"
     * )
     */
    private string $featureDescription;


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
    public function getFeatureName(): string
    {
        return $this->featureName;
    }

    /**
     * @param string $featureName
     *
     * @return $this
     */
    public function setFeatureName(string $featureName): self
    {
        $this->featureName = $featureName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFeatureDescription(): string
    {
        return $this->featureDescription;
    }

    /**
     * @param string $featureDescription
     *
     * @return $this
     */
    public function setFeatureDescription(string $featureDescription): self
    {
        $this->featureDescription = $featureDescription;

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
