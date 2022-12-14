<?php


namespace App\Services;


use App\Models\Attribute\Attribute;

class AttributeService
{


    public static function getAttributeName($attributeID)
    {
        if(isset($attributeID)){
            $attribute = Attribute::where('id', $attributeID)
                ->with('attributesTranslations')->first();
            return $attribute->attributesTranslations[0]->name;
        }


    }

}
