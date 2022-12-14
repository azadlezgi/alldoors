<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductManufacturer extends Model
{
    use HasFactory;


    protected $table = 'products_manufacturers';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function productsManufacturersTranslations()
    {
        return $this->hasMany('App\Models\Product\ProductManufacturerTranslation','manufacturer_id','id');
    }


    public function getProductsCount()
    {
        return $this->hasMany('App\Models\Product\ProductManufacturerList','manufacturer_id','id');
    }

}
