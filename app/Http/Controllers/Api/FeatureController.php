<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Interfaces\FeatureControllerInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\FeatureResource;
use App\Services\Interfaces\FeatureServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeatureController extends Controller implements FeatureControllerInterface
{
    private const FEATURE_RULES = [
        'featureName' => 'required|string|min:3',
        'description' => 'string|min:3',
    ];

    /**
     * @param FeatureServiceInterface $featureService
     */
    public function __construct(
        private FeatureServiceInterface $featureService,
    ) {}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function createFeature(Request $request): JsonResponse
    {
        $validateFields = $request->validate(self::FEATURE_RULES);

        return (new FeatureResource($this->featureService->createFeature($validateFields)))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
