<?php

namespace App\Models;

use App\Entities\Feature as FeatureEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $table      = 'features';
    protected $primaryKey = 'id';
    protected $keyType    = 'integer';


    /**
     * @return FeatureEntity
     */
    public function toEntity(): FeatureEntity
    {
        $featureEntity = new FeatureEntity();
        $featureEntity
            ->setId($this->id)
            ->setFeatureName($this->feature_name)
            ->setFeatureDescription($this->description)
        ;

        return $featureEntity;
    }
}
