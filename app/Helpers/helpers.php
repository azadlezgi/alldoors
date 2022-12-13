<?php


//Diller uchun
use App\Models\Language\LanguagePhrases;
use App\Models\Setting\Setting;
use Illuminate\Support\Facades\Cache;

function language($languageKey = null)
{


    if (!empty($languageKey)) {

        $languageID = app('request')->languageID;
        $currentLang = app('request')->currentLang;


        return Cache::rememberForever($currentLang . '.' . $languageKey, function () use ($languageKey, $languageID, $currentLang) {

            $data = LanguagePhrases::join('language_groups', 'language_groups.id', '=', 'language_phrases.language_group_id')
                ->join('language_phrase_translations', 'language_phrase_translations.phrase_id', '=', 'language_phrases.id')
                ->where('language_phrase_translations.language_id', $languageID)
                ->where('language_phrases.key', $languageKey)
                ->select('value', 'key')
                ->first();

            if ($data) {
                return !empty($data->value) ? $data->value : '';
            } else {
                return '';
            }


        });

    }


}

function setting($key, $param = false)
{

    if ($param == true) {


        $languageID = request('languageID');

        Cache::rememberForever('setting-' . $key . '-' . $languageID, function () use ($key, $languageID) {
            $setting = Setting::where('settings.key', $key)
                ->where('settings_translations.language_id', $languageID)
                ->join('settings_translations', 'settings.id', '=', 'settings_translations.setting_id')
                ->first();


            if (!is_null($setting)) {
                return !empty($setting->content) ? $setting->content : '';
            }

        });

        //Eger keshde bu varsa
        if (Cache::has('setting-' . $key . '-' . $languageID)) {
            return Cache::get('setting-' . $key . '-' . $languageID);
        }


    } else {

        Cache::rememberForever('setting-' . $key, function () use ($key) {
            $setting = Setting::where('key', $key)
                ->first();

            if ($setting) {
                return !empty($setting->content) ? $setting->content : '';
            }
        });

        //Eger keshde bu varsa
        if (Cache::has('setting-' . $key)) {
            return Cache::get('setting-' . $key);
        }


    }


}

function countryFlag($codeParam = null)
{
    $countries = countries();
    $flag = '';
    foreach ($countries as $country):
        $code = strtolower($country['iso_3166_1_alpha2']);

        if ($code == 'gb') {
            $code = 'en';
        } else {
            $code = $code;
        }

        if ($codeParam == $code) {
            $flag = asset('assets/images/flags') . '/' . $code . '.svg';
        }

    endforeach;

    return $flag;

}

function countryCode($codeParam = null, $codunEksi = false)
{
    $code = '';
    if (!$codunEksi) {
        if ($codeParam == 'gb') {
            $code = 'en';
        } else {
            $code = $codeParam;
        }
    } else {
        if ($codeParam == 'en') {
            $code = 'gb';
        } else {
            $code = $codeParam;
        }
    }


    return $code;

}

function countryNameChange($name)
{
    $languageName = '';
    if ($name == 'United Kingdom') {
        $languageName = 'English';
    } elseif ($name == 'Россия') {
        $languageName = 'Russia';
    } else {
        $languageName = $name;
    }

    return $languageName;
}

function is_base64($data)
{
    $base64Parcala = explode(',', $data);


    if ($base64Parcala[0] == 'data:image/jpeg;base64') {
        if (base64_encode(base64_decode($base64Parcala[1], true)) === $base64Parcala[1]) {
//            echo 'Ok';
            return true;

        } else {
//        echo 'bae64 degil';
            return false;
        }
    } else {
//            echo 'Foto formati sehvdir';
        return false;
    }


}

function compressImgFile($source, $destination, $quality)
{

    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);

    imagejpeg($image, $destination, $quality);

    return $destination;
}


function myErrors($errors)
{
    if ($errors->any()):
        ?>
        <div class="alert alert-my-danger"> <?php
            ?>
            <ul> <?php
                foreach ($errors->all() as $key => $error) {
                    ?>
                    <li> <?php
                        preg_match('@<span>\[\[\@(.*?).(.*?)\@\]\]</span>@', $error, $fotolar);
                        //Eger array boshdursa dil yoxdur
                        if (!in_array('', $fotolar)) {
                            echo $error;
                        } else {
                            //dil id sini almaqcun parchaladim
                            $parchala = explode('.', $fotolar[2])[1];
                            foreach (cache('key-all-languages') as $item):
                                if ($parchala == $item->id) {
                                    $photo = preg_replace('@<span>\[\[\@(.*?).(.*?)\@\]\]</span>@', '(' . mb_strtolower($item->short_name) . ')', $error);
                                    echo $photo;
                                }

                            endforeach;

                        }

                        ?>  </li> <?php
                }

                ?>
            </ul>
        </div>
    <?php

    endif;
}

function myError($error)
{


    preg_match('@<span>\[\[\@(.*?).(.*?)\@\]\]</span>@', $error, $fotolar);
    //Eger array boshdursa dil yoxdur
    if (!in_array('', $fotolar)) {
        echo $error;
    } else {
        //dil id sini almaqcun parchaladim
        $parchala = explode('.', $fotolar[2])[1];
        foreach (cache('key-all-languages') as $item):
            if ($parchala == $item->id) {
                $photo = preg_replace('@<span>\[\[\@(.*?).(.*?)\@\]\]</span>@', '(' . mb_strtolower($item->short_name) . ')', $error);
                echo $photo;
            }

        endforeach;

    }


}

function uniqueSlug($title = '', $model)
{
    $slug = \Illuminate\Support\Str::slug($title);
    //get unique slug...
    $nSlug = $slug;
    $i = 0;


    $model = str_replace(' ', '', $model);
    while (($model::whereSlug($nSlug)->count()) > 0) {
        $i++;
        $nSlug = $slug . '-' . $i;
    }
    if ($i > 0) {
        $newSlug = substr($nSlug, 0, strlen($slug)) . '-' . $i;
    } else {
        $newSlug = $slug;
    }
    return $newSlug;
}

function getTranslateData($array,$languageID,$field)
{
    /**
     * Bu function databaseden gelen datalarin blade
     * icersinde duzgun inputlara yazilmaqi uchundur
     */

    foreach ($array as $tranlationData):
        if ($tranlationData->language_id == $languageID):
            return $tranlationData->$field;
        endif;
    endforeach;

}

function getTranslateAttributeData($array,$languageID,$attributeID,$field)
{
    /**
     * Bu function databaseden gelen datalarin blade
     * icersinde duzgun inputlara yazilmaqi uchundur
     */


    foreach ($array as $tranlationData):
        if($attributeID == $tranlationData->attribute_id){
            if ($tranlationData->language_id == $languageID):
                return $tranlationData->$field;
            endif;
        }

    endforeach;

}

function getTranslateOptionData($array,$languageID,$attributeID,$field)
{
    /**
     * Bu function databaseden gelen datalarin blade
     * icersinde duzgun inputlara yazilmaqi uchundur
     */


    foreach ($array as $tranlationData):
        if($attributeID == $tranlationData->option_value_id){
            if ($tranlationData->language_id == $languageID):
                return $tranlationData->$field;
            endif;
        }

    endforeach;

}

function updateDate($updateDate,$translateUpdateDate){
    $updateAt = '';
    foreach ($translateUpdateDate as $item):
        if($updateDate > $item->updated_at){
            $updateAt = $updateDate;
        }else{
            $updateAt = $item->updated_at;
        }
    endforeach;

    return \Illuminate\Support\Carbon::parse($updateAt)->format('Y-m-d H:i');

}

function str_limit($text,$limit = 100,$delimiter = '...'){

    $textLan  = mb_strlen($text);
    if($textLan > $limit){
        $text = mb_substr($text,0,$limit).' '.$delimiter;
    }


    return $text;

}


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function product_price($price,$specialPrice = '', $startDate = '', $endDate = ''){
    if(empty($specialPrice)){
        if(!empty($price)){
            return "<div class='product-price'>".$price . " AZN</div>";
        }else{
            return '';
        }
    }else{
        return "<div class='product-price'>".$specialPrice . " AZN<sup><del>(". $price." AZN)</del></sup></div>";
    }
}



