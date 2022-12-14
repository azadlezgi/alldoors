<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductCollection extends Model
{
    use HasFactory;

    protected $table = 'products_collections';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function productsCollectionsTranslations()
    {
        return $this->hasMany('App\Models\Product\ProductCollectionTranslation','collection_id','id');
    }


    public function getProductsCount()
    {
        return $this->hasMany('App\Models\Product\ProductCollectionList','collection_id','id');
    }


    /**
     * TEST UCUNDUR BURASI
     */
//    public function products(): BelongsToMany
//    {
//        return $this->belongsToMany(Product::class, 'products_collections_lists', 'collection_id', 'product_id');
//    }

}
