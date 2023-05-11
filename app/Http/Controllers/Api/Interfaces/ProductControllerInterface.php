<?php

namespace App\Http\Controllers\Api\Interfaces;

use App\Http\Resources\ProductFeatureResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface ProductControllerInterface
{
    /**
     * @OA\Post(
     *      path="/product/new",
     *      summary="Create product",
     *      @OA\PathItem (path="/api"),
     *      tags={"challenge"},
     *      security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *        required=true,
     *        description="Create a new product",
     *        @OA\JsonContent(
     *            required={"name","on_sale"},
     *            @OA\Property(property="name", type="string", example="Producto"),
     *            @OA\Property(property="on_sale", type="boolean", example="true"),
     *        ),
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Not found",
     *          @OA\JsonContent(
     *              @OA\Examples(
     *                  example="study",
     *                  value={"message": "The route api/product/new could not be found."},
     *                  summary="Error message."
     *              ),
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created",
     *          @OA\JsonContent(ref="#/components/schemas/Product")
     *      ),
     * )
     */
    public function createProduct(Request $request): JsonResponse;

    public function getProduct(int $id, Request $request): ProductResource;

    public function updateProduct(int $id, Request $request): ProductResource;

    public function associateProduct(int $product_id, int $feature_id): ProductFeatureResource;
}
