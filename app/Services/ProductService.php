<?php

namespace App\Services;


use App\Entities\Feature as FeatureEntity;
use App\Entities\Product as ProductEntity;
use App\Entities\ProductFeature as ProductFeatureEntity;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationErrorException;
use App\Repositories\Interfaces\FeatureRepositoryInterface;
use App\Repositories\Interfaces\ProductFeatureRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Validators\Base\Validator;
use App\Validators\ProductValidator;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;


class ProductService implements ProductServiceInterface
{
    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private FeatureRepositoryInterface $featureRepository,
        private ProductFeatureRepositoryInterface $productFeatureRepository
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
        $productEntity->setOnSale($productFields['onSale']);

        $productValidator = new ProductValidator(
            ProductValidator::ACTION_CREATE,
            $productEntity,
            null,
            null
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
            ProductValidator::ACTION_UPDATE,
            $productEntity,
            null,
            $validateFields
        );

        $validator = new Validator($productValidator);
        $validator->validate();

        $productEntity->deserialize($validateFields);

        return $this->productRepository->save($productEntity);
    }

    /**
     * @param ProductEntity $productEntity
     * @param FeatureEntity $featureEntity
     * @return ProductFeatureEntity
     * @throws NotFoundException
     */
    public function associateProduct(
        ProductEntity $productEntity,
        FeatureEntity $featureEntity
    ): ProductFeatureEntity
    {
        if (!$productEntity = $this->productRepository->findById($productEntity->getId())) {
            throw new NotFoundException('Product');
        }

        if (!$featureEntity = $this->featureRepository->findById($featureEntity->getId())) {
            throw new NotFoundException('Feature');
        }

        $productFeature = $this->productFeatureRepository->findById(
            $productEntity->getId(),
            $featureEntity->getId()
        );

        if (is_null($productFeature)) {
            return $this->productFeatureRepository->save($productEntity, $featureEntity, true);
        } else {
            throw new ConflictHttpException('ProductFeature exist');
        }
    }
}
