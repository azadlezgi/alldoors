<?php


namespace App\Services;


use App\Models\Attribute\Attribute;

class AttributeService
{


    public static function getAttributeName($attributeID)
    {
        if(isset($attributeID)){
            $attribute = Attribute::where('id', $attributeID)
                ->with('attributesTranlations')->first();
            return $attribute->attributesTranlations[0]->name;
        }


    }

}
