<?php

namespace App\Http\Controllers\Api\Interfaces;

use App\Http\Resources\ProductResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface FeatureControllerInterface
{
    /**
     * @OA\Post(
     *      path="/feature/new",
     *      summary="Create feature",
     *      @OA\PathItem (path="/api"),
     *      tags={"challenge"},
     *      security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *        required=true,
     *        description="Create a new feature",
     *        @OA\JsonContent(
     *            required={"featureName","description"},
     *            @OA\Property(property="featureName", type="string", example="Producto"),
     *            @OA\Property(property="description", type="string", example="Tipo de producto"),
     *        ),
     *      ),
     *      @OA\Response(
     *          response="404",
     *          description="Not found",
     *          @OA\JsonContent(
     *              @OA\Examples(
     *                  example="study",
     *                  value={"message": "The route api/feature/new could not be found."},
     *                  summary="Error message."
     *              ),
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created",
     *          @OA\JsonContent(ref="#/components/schemas/Feature")
     *      ),
     * )
     */
    public function createFeature(Request $request): JsonResponse;
}
