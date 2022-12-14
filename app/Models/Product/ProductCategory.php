<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'products_categories';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function productsCategoriesTranslations()
    {
        return $this->hasMany('App\Models\Product\ProductCategoryTranslation','category_id','id');
    }


    public function getProductsCount()
    {
        return $this->hasMany('App\Models\Product\ProductCategoryList','category_id','id');
    }


    /**
     * TEST UCUNDUR BURASI
     */
//    public function products(): BelongsToMany
//    {
//        return $this->belongsToMany(Product::class, 'products_categories_lists', 'category_id', 'product_id');
//    }

}
