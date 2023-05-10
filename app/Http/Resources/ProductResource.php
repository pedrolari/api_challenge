<?php

namespace App\Http\Resources;

use App\Entities\Product;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use JsonSerializable;

class ProductResource extends JsonResource
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
        'name' => 'string',
        'onSale' => 'bool'
    ])]
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        /** @var Product $this */
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'onSale' => $this->getOnSale()
        ];
    }
}
