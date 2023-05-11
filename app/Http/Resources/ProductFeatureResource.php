<?php

namespace App\Http\Resources;

use App\Entities\ProductFeature;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class ProductFeatureResource extends JsonResource
{
    public static $wrap = null;


    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape([
        'productId' => 'integer',
        'featureId' => 'integer'
    ])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        /** @var ProductFeature $this */
        return [
            'productId' => $this->getProductId(),
            'featureId' => $this->getFeaturetId(),
        ];
    }
}
