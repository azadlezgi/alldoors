<?php

namespace App\Services;

use App\Models\Product\Product;

class ProductService
{

    public static function getProductCategory($categoryID,$limit = 3)
    {

        return Product::with(array('productsTranslations' => function ($query) {
            $query->where('language_id', cache('language-defaultID'));

        }))
            ->with('productsCategoriesCheck')
            ->join('products_categories_lists', 'products_categories_lists.product_id', '=', 'products.id')
            ->join('products_categories', function ($join) use ($categoryID) {
                $join->on('products_categories_lists.category_id', '=', 'products_categories.id')
                    ->where('products_categories.id', $categoryID) //En cox satilanlar ID
                    ->where('products_categories.status', 1);
            })
            ->where('products.status', 1)
            ->select(
                'products.id as id',
                'products.image as image',
                'products.images as images',
                'products.slug as slug',
                'products.price as price',
                'products.status as status',
                'products.created_at as created_at',
                'products.updated_at as updated_at',
            )
            ->orderBy('products.id', 'DESC')
            ->groupBy('products_categories_lists.product_id')
            ->limit($limit)
            ->get();

    }



    public static function getParent($parentID)
    {
        return Product::with(array('productsTranslations' => function ($query) {
            $query->where('language_id', cache('language-defaultID'));
        }))
            ->where('id',$parentID)
            ->first();
    }


}
