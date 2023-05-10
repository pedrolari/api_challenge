<?php

namespace App\Services;


use App\Entities\Product as ProductEntity;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationErrorException;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Validators\Base\Validator;
use App\Validators\ProductValidator;


class ProductService implements ProductServiceInterface
{
    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {
    }

    /**
     * @param array $productFields
     * @return ProductEntity
     * @throws ValidationErrorException
     */
    public function createProduct(array $productFields): ProductEntity
    {
        $productEntity = new ProductEntity();
        $productEntity->setName($productFields['name']);
        $productEntity->setOnSale($productFields['on_sale']);

        $productValidator = new ProductValidator(
            $productEntity,
            ProductValidator::ACTION_CREATE
        );

        $validator = new Validator($productValidator);
        $validator->validate();

        return $this->productRepository->save($productEntity, true);
    }


    /**
     * @param int $id
     * @return ProductEntity
     * @throws NotFoundException
     */
    public function getProduct(int $id): ProductEntity
    {
        if (!$product = $this->productRepository->findById($id)) {
            throw new NotFoundException('Product');
        }

        return $product;
    }


    /**
     * @param ProductEntity $productEntity
     * @param array $validateFields
     * @return ProductEntity
     * @throws NotFoundException
     * @throws ValidationErrorException
     * @throws \ReflectionException
     */
    public function updateProduct(ProductEntity $productEntity, array $validateFields): ProductEntity
    {
        if (!$productEntity = $this->productRepository->findById($productEntity->getId())) {
            throw new NotFoundException('Product');
        }
        $productValidator = new ProductValidator(
            $productEntity,
            ProductValidator::ACTION_UPDATE,
            $validateFields
        );

        $validator = new Validator($productValidator);
        $validator->validate();

        $productEntity->deserialize($validateFields);

        return $this->productRepository->save($productEntity);
    }
}
