<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function productsTranlations()
    {
        return $this->hasMany('App\Models\Product\ProductTranslation','product_id','id');
    }

    public function getProductModel()
    {
        return $this->hasOne('App\Models\Product\ProductModelList','product_id','id');
    }

    public function getProductCollection()
    {
        return $this->hasOne('App\Models\Product\ProductCollectionList','product_id','id');
    }

    public function getProductGallery()
    {
        return $this->hasOne('App\Models\Product\ProductGalleryList','product_id','id');
    }

    public function getProductManufacturer()
    {
        return $this->hasOne('App\Models\Product\ProductManufacturerList','product_id','id');
    }


    public function productsCategories()
    {
        return $this->hasMany('App\Models\Product\ProductCategoryList','product_id','id');
    }

    public function productsCollections()
    {
        return $this->hasMany('App\Models\Product\ProductCollectionList','product_id','id');
    }


    public function productsCategoriesCheck()
    {
        return $this->hasMany('App\Models\Product\ProductCategoryList','product_id','id')
            ->join('products_categories','products_categories.id','=','products_categories_lists.category_id')
            ->join('products_categories_translations','products_categories.id','=','products_categories_translations.category_id')
            ->where('status',1)
            ->where('products_categories_translations.language_id',cache('language-defaultID'));
    }

    public function productSpecialPriceList()
    {
        return $this->hasOne('App\Models\Product\ProductSpecialPriceList','product_id','id');
    }

    public function getProductAttributeList()
    {
        return $this->hasMany('App\Models\Product\ProductAttributeList','product_id','id');
    }

    public function getProductAttributeListAll()
    {
        return $this->hasMany('App\Models\Product\ProductAttributeList','product_id','id');
    }




}
