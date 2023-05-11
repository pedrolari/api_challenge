<?php

namespace App\Http\Resources;

use App\Entities\Feature;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class FeatureResource extends JsonResource
{
    public static $wrap = null;


    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    #[ArrayShape([
        'id' => 'string',
        'featureName' => 'string',
        'description' => 'string'
    ])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        /** @var Feature $this */
        return [
            'id' => $this->getId(),
            'featureName' => $this->getFeatureName(),
            'description' => $this->getFeatureDescription()
        ];
    }
}
