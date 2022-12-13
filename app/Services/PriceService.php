<?php


namespace App\Services;


class PriceService
{

    public static function price($price)
    {
        if(!empty($price) || $price >= 0){
            return str_replace(',','.',$price);
        }

    }

}
