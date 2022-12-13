<?php


namespace App\Services;


use App\Models\Product\ProductManufacturer;

class ManufacturerService
{

    public static function getProductManufacturerName($id,$defaultLanguage)
    {

        return ProductManufacturer::where('id',$id)
            ->where('language_id', $defaultLanguage)
            ->join('products_manufacturers_translations', 'products_manufacturers_translations.manufacturer_id', '=', 'products_manufacturers.id')
            ->first();

    }

}
