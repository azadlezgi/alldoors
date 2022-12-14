<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products_models';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function productsModelsTranslations()
    {
        return $this->hasMany('App\Models\Product\ProductModelTranslation','model_id','id');
    }


    public function getProductsCount()
    {
        return $this->hasMany('App\Models\Product\ProductModelList','model_id','id');
    }
}
