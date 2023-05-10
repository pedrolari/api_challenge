<?php

namespace App\Models;

use App\Entities\Product as ProductEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table      = 'product';
    protected $primaryKey = 'id';
    protected $keyType    = 'integer';


    /**
     * @return ProductEntity
     */
    public function toEntity(): ProductEntity
    {
        $productEntity = new ProductEntity();
        $productEntity
            ->setId($this->id)
            ->setName($this->name)
            ->setOnSale($this->on_sale)
        ;

        return $productEntity;
    }
}
