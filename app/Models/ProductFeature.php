<?php

namespace App\Models;

use App\Entities\ProductFeature as ProductFeatureEntity;
use App\Traits\HasCompositePrimaryKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;
    use HasCompositePrimaryKeyTrait;

    protected $table      = 'product_features';
    protected $primaryKey = 'product_id';
    protected $keyType    = 'integer';


    /**
     * @return ProductFeatureEntity
     */
    public function toEntity(): ProductFeatureEntity
    {
        $productFeatureEntity = new ProductFeatureEntity();
        $productFeatureEntity
            ->setProductId($this->product_id)
            ->setFeaturetId($this->feature_id)
        ;

        return $productFeatureEntity;
    }
}
