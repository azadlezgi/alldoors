<?php

namespace App\Services;

use App\Models\Option\OptionValue;

class OptionService
{

    public static function getOptionValues($optionID,$languageID)
    {
        $optionValues = OptionValue::where('language_id', $languageID)
            ->where('option_id',$optionID)
            ->join('options_values_translations','options_values.id','=','options_values_translations.option_value_id')
            ->orderBy('sort', 'ASC')
            ->get();

        return $optionValues;
    }




}
