<?php

namespace App\Repositories;

use App\Entities\Product as ProductEntity;
use App\Models\Product;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @param int $id
     * @return ProductEntity
     */
    public function findById(int $id): ProductEntity
    {
        /** @var Product $config */
        $product = Product::where('id', $id)->first();

        return $product->toEntity();
    }


    /**
     * @param ProductEntity $productEntity
     * @param bool $isNewProduct
     *
     * @return ProductEntity
     */
    public function save(ProductEntity $productEntity, bool $isNewProduct = false): ProductEntity
    {
        $productModel = $isNewProduct ? new Product() : Product::find($productEntity->getId());
        $productModel->name = $productEntity->getName();
        $productModel->on_sale = $productEntity->getOnSale();
        $productModel->save();

        return $isNewProduct ? $productModel->refresh()->toEntity() : $productModel->toEntity();
    }
}
