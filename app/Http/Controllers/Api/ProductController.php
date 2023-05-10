<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\Interfaces\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller implements Interfaces\ProductControllerInterface
{
    private const PRODUCT_RULES = [
        'name' => 'required|string|min:3',
        'onSale' => 'boolean',
    ];

    /**
     * @param ProductServiceInterface $productService
     */
    public function __construct(
        private ProductServiceInterface $productService,
    ) {}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createProduct(Request $request): JsonResponse
    {
        $validateFields = $request->validate(self::PRODUCT_RULES);

        return (new ProductResource($this->productService->createProduct($validateFields)))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }


    /**
     * @param int $id
     * @param Request $request
     * @return ProductResource
     */
    public function getProduct(int $id, Request $request): ProductResource
    {
        return new ProductResource($this->productService->getProduct($id));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return ProductResource
     */
    public function updateProduct(int $id, Request $request): ProductResource
    {
        $productEntity = $this->productService->getProduct($id);
        $validateFields = $request->validate(self::PRODUCT_RULES);

        return new ProductResource($this->productService->updateProduct($productEntity, $validateFields));
    }


}
