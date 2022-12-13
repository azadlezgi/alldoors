<?php


namespace App\Services;


use App\Models\Product\ProductCollection;
use Illuminate\Support\Str;

class CollectionsService
{


    /***
     * Products Collections START
     */
    public static function getTreeProductIndex($defaultLanguage, $collectionID, $parent_id, $sub_mark = '')
    {


        $collections = ProductCollection::where('id', $collectionID)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
            ->get();


        foreach ($collections as $collection):
            if ($sub_mark == '') {
                echo $sub_mark . '<b><a href="' . route('admin.product.collection.edit', $collection->id) . '">' . $collection->name . '</a></b>';
            } else {
                echo $sub_mark . '<a href="' . route('admin.product.collection.edit', $collection->id) . '">' . $collection->name . '</a>';
            }

            self::getTreeProductIndex($defaultLanguage, $collection->parent, $parent_id, ' -> ');
        endforeach;

    }


    public static function getTreeProduct($defaultLanguage, $parent_id = 0, $sub_mark = '')
    {


        $collections = ProductCollection::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
            ->get();


        foreach ($collections as $collection):
            ?>
            <option
                value="<?= $collection->id ?>" <?= old('parent') == $collection->id ? 'selected' : '' ?>><?= $sub_mark . $collection->name ?></option> <?php
            self::getTreeProduct($defaultLanguage, $collection->id, $sub_mark . ' - ');
        endforeach;

    }


    public static function getEditTreeProduct($defaultLanguage, $collectionID, $parent_id = 0, $sub_mark = '')
    {


        $collections = ProductCollection::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
            ->get();


        foreach ($collections as $collection):
            ?>
            <option
                value="<?= $collection->id ?>" <?= old('parent', $collectionID) == $collection->id ? 'selected' : '' ?>><?= $sub_mark . $collection->name ?></option> <?php
            self::getEditTreeProduct($defaultLanguage, $collectionID, $collection->id, $sub_mark . ' - ');
        endforeach;

    }


    public static function getTreeProductCollections($defaultLanguage, $parent_id = 0, $sub_mark = 20)
    {


        $collections = ProductCollection::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
            ->get();


        static $say = 0;
        static $say2 = 0;
        foreach ($collections as $key => $collection):
            $old = old("collections." . $collection->id) == $collection->id ? "checked" : "";
            ?>
            <?= '<label style="margin-left:' . $sub_mark . 'px" class="checkbox checkbox-success">
                <input  form="submit-form" ' . $old . '  value="' . $collection->id . '"  type="checkbox" name="collections[' . $collection->id . ']"/>
                <span></span>' . $collection->name . '

            </label>' ?>


            <?php

            self::getTreeProductCollections($defaultLanguage, $collection->id, $sub_mark + 20);
        endforeach;

    }


    public static function getTreeEditProductCollections($defaultLanguage, $parent_id = 0, $selectCollections = [], $sub_mark = 20)
    {


        $collections = ProductCollection::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
            ->get();


        static $say = 0;
        static $say2 = 0;
        foreach ($collections as $key => $collection):

            if (old("collections") != null) {
                $old = old("collections." . $collection->id) == $collection->id ? "checked" : "";
            } else {
                $old = in_array($collection->id, $selectCollections) ? "checked" : "";
            }


            ?>
            <?= '<label style="margin-left:' . $sub_mark . 'px" class="checkbox checkbox-success">
                <input  form="submit-form" ' . $old . '  value="' . $collection->id . '"  type="checkbox" name="collections[' . $collection->id . ']"/>
                <span></span>' . $collection->name . '

            </label>' ?>


            <?php

            self::getTreeEditProductCollections($defaultLanguage, $collection->id, $selectCollections, $sub_mark + 20);
        endforeach;

    }


    public static function getCollectionProductName($id, $defaultLanguage)
    {

        return ProductCollection::where('id', $id)
            ->where('language_id', $defaultLanguage)
            ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
            ->first();

    }

    /***
     * Products Collections END
     */


    /**
     *
     * Frontend Collections START
     *
     */


    public static function breadcrumbCollections($slug,$languageID,$dataName = null)
    {

        $parchala = explode('/', $slug);
        $arr = [];
        $lastSlug = '';
        $html = '';


        $say = count($parchala);
        foreach ($parchala as $key => $item):
            $beforeSlug = Str::before($slug, $item);
            if ($key != $say - 1) {
                $arr[] = $beforeSlug . $item;
            }
        endforeach;



        if (!is_null($slug) && strpos($slug, "/")) {
            $slug_array = explode("/", $slug);
            $lastSlug = $slug_array[(count($slug_array) - 1)];

        }else{
            $lastSlug = $slug;
        }



        foreach ($arr as $item):

            $afterSlug = Str::afterLast($item,'/');


            $collection = ProductCollection::where('language_id',  $languageID)
                ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
                ->where('slug', $afterSlug)
                ->where('status', 1)
                ->first();


            $html .= '<li class="breadcrumb-item"><a href="'.route('frontend.product.collection.index',$item).'">'.$collection->name.'</a></li>';

        endforeach;

        $collectionLast = ProductCollection::where('language_id',  $languageID)
            ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
            ->where('slug', $lastSlug)
            ->where('status', 1)
            ->first();

        if($collectionLast != null){
            $html .= '<li class="breadcrumb-item active" aria-current="page">'.$collectionLast->name.'</li>';
        }else{

            $html .= '<li class="breadcrumb-item active" aria-current="page">'.$dataName.'</li>';

        }



        return $html;



    }



    public static function bestsellerSlug($collectionID)
    {
        return ProductCollection::where('id',$collectionID)
            ->first()->slug;
    }

    /**
     *
     * Frontend Collections END
     *
     */


}
