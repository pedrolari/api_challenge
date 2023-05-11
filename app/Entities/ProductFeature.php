<?php

namespace App\Entities;

use ReflectionException;

/**
 * @OA\Schema(
 *     title="ProductFeature",
 *     description="ProductFeature entity model",
 * )
 */
class ProductFeature
{
    /**
     * @OA\Property(
     *     title="ProductFeature product ID",
     *     description="ProductFeature product ID",
     *     type="integer",
     *     example="123"
     * )
     */
    private int $productId;
    /**
     * @OA\Property(
     *     title="ProductFeature feature ID",
     *     description="ProductFeature feature ID",
     *     type="integer",
     *     example="123"
     * )
     */
    private int $featuretId;

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     *
     * @return $this
     */
    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * @return int
     */
    public function getFeaturetId(): int
    {
        return $this->featuretId;
    }

    /**
     * @param int $featuretId
     *
     * @return $this
     */
    public function setFeaturetId(int $featuretId): self
    {
        $this->featuretId = $featuretId;

        return $this;
    }


}
