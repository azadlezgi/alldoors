<?php


namespace App\Services;


use App\Models\Gallery\GalleryCategory;
use App\Models\Product\ProductCategory;
use Illuminate\Support\Str;

class CategoriesService
{

    /***
     * Galleries Categories START
     */
    public static function getTreeIndex($defaultLanguage, $categoryID, $parent_id, $sub_mark = '')
    {


        $categories = GalleryCategory::where('id', $categoryID)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->get();


        foreach ($categories as $category):
            if ($sub_mark == '') {
                echo $sub_mark . '<b><a href="' . route('admin.gallery.category.edit', $category->id) . '">' . $category->name . '</a></b>';
            } else {
                echo $sub_mark . '<a href="' . route('admin.gallery.category.edit', $category->id) . '">' . $category->name . '</a>';
            }

            self::getTreeIndex($defaultLanguage, $category->parent, $parent_id, ' -> ');
        endforeach;

    }


    public static function getTree($defaultLanguage, $parent_id = 0, $sub_mark = '')
    {


        $categories = GalleryCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->get();


        foreach ($categories as $category):
            ?>
            <option
                value="<?= $category->id ?>" <?= old('parent') == $category->id ? 'selected' : '' ?>><?= $sub_mark . $category->name ?></option> <?php
            self::getTree($defaultLanguage, $category->id, $sub_mark . ' - ');
        endforeach;

    }


    public static function getEditTree($defaultLanguage, $categoryID, $parent_id = 0, $sub_mark = '')
    {


        $categories = GalleryCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->get();


        foreach ($categories as $category):
            ?>
            <option
                value="<?= $category->id ?>" <?= old('parent', $categoryID) == $category->id ? 'selected' : '' ?>><?= $sub_mark . $category->name ?></option> <?php
            self::getEditTree($defaultLanguage, $categoryID, $category->id, $sub_mark . ' - ');
        endforeach;

    }


    public static function getTreeGalleryCategories($defaultLanguage, $parent_id = 0, $sub_mark = 20)
    {


        $categories = GalleryCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->where('status', 1)
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->get();


        static $say = 0;
        static $say2 = 0;
        foreach ($categories as $key => $category):
            $old = old("categories." . $category->id) == $category->id ? "checked" : "";
            ?>
            <?= '<label style="margin-left:' . $sub_mark . 'px" class="checkbox checkbox-success">
                <input  form="submit-form" ' . $old . '  value="' . $category->id . '"  type="checkbox" name="categories[' . $category->id . ']"/>
                <span></span>' . $category->name . '

            </label>' ?>


            <?php

            self::getTreeGalleryCategories($defaultLanguage, $category->id, $sub_mark + 20);
        endforeach;

    }


    public static function getTreeEditGalleryCategories($defaultLanguage, $parent_id = 0, $selectCategories = [], $sub_mark = 20)
    {


        $categories = GalleryCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->where('status', 1)
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->get();


        static $say = 0;
        static $say2 = 0;
        foreach ($categories as $key => $category):

            if (old("categories") != null) {
                $old = old("categories." . $category->id) == $category->id ? "checked" : "";
            } else {
                $old = in_array($category->id, $selectCategories) ? "checked" : "";
            }


            ?>
            <?= '<label style="margin-left:' . $sub_mark . 'px" class="checkbox checkbox-success">
                <input  form="submit-form" ' . $old . '  value="' . $category->id . '"  type="checkbox" name="categories[' . $category->id . ']"/>
                <span></span>' . $category->name . '

            </label>' ?>


            <?php

            self::getTreeEditGalleryCategories($defaultLanguage, $category->id, $selectCategories, $sub_mark + 20);
        endforeach;

    }


    public static function getCategoryName($id, $defaultLanguage)
    {

        return GalleryCategory::where('id', $id)
            ->where('language_id', $defaultLanguage)
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->first();

    }
    /***
     * Galleries Categories END
     */


    /***
     * Products Categories START
     */
    public static function getTreeProductIndex($defaultLanguage, $categoryID, $parent_id, $sub_mark = '')
    {


        $categories = ProductCategory::where('id', $categoryID)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->get();


        foreach ($categories as $category):
            if ($sub_mark == '') {
                echo $sub_mark . '<b><a href="' . route('admin.product.category.edit', $category->id) . '">' . $category->name . '</a></b>';
            } else {
                echo $sub_mark . '<a href="' . route('admin.product.category.edit', $category->id) . '">' . $category->name . '</a>';
            }

            self::getTreeProductIndex($defaultLanguage, $category->parent, $parent_id, ' -> ');
        endforeach;

    }


    public static function getTreeProduct($defaultLanguage, $parent_id = 0, $sub_mark = '')
    {


        $categories = ProductCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->get();


        foreach ($categories as $category):
            ?>
            <option
                value="<?= $category->id ?>" <?= old('parent') == $category->id ? 'selected' : '' ?>><?= $sub_mark . $category->name ?></option> <?php
            self::getTreeProduct($defaultLanguage, $category->id, $sub_mark . ' - ');
        endforeach;

    }


    public static function getEditTreeProduct($defaultLanguage, $categoryID, $parent_id = 0, $sub_mark = '')
    {


        $categories = ProductCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->get();


        foreach ($categories as $category):
            ?>
            <option
                value="<?= $category->id ?>" <?= old('parent', $categoryID) == $category->id ? 'selected' : '' ?>><?= $sub_mark . $category->name ?></option> <?php
            self::getEditTreeProduct($defaultLanguage, $categoryID, $category->id, $sub_mark . ' - ');
        endforeach;

    }


    public static function getTreeProductCategories($defaultLanguage, $parent_id = 0, $sub_mark = 20)
    {


        $categories = ProductCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->get();


        static $say = 0;
        static $say2 = 0;
        foreach ($categories as $key => $category):
            $old = old("categories." . $category->id) == $category->id ? "checked" : "";
            ?>
            <?= '<label style="margin-left:' . $sub_mark . 'px" class="checkbox checkbox-success">
                <input  form="submit-form" ' . $old . '  value="' . $category->id . '"  type="checkbox" name="categories[' . $category->id . ']"/>
                <span></span>' . $category->name . '

            </label>' ?>


            <?php

            self::getTreeProductCategories($defaultLanguage, $category->id, $sub_mark + 20);
        endforeach;

    }


    public static function getTreeEditProductCategories($defaultLanguage, $parent_id = 0, $selectCategories = [], $sub_mark = 20)
    {


        $categories = ProductCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->where('status', 1)
            ->orderBy('name', 'ASC')
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->get();


        static $say = 0;
        static $say2 = 0;
        foreach ($categories as $key => $category):

            if (old("categories") != null) {
                $old = old("categories." . $category->id) == $category->id ? "checked" : "";
            } else {
                $old = in_array($category->id, $selectCategories) ? "checked" : "";
            }


            ?>
            <?= '<label style="margin-left:' . $sub_mark . 'px" class="checkbox checkbox-success">
                <input  form="submit-form" ' . $old . '  value="' . $category->id . '"  type="checkbox" name="categories[' . $category->id . ']"/>
                <span></span>' . $category->name . '

            </label>' ?>


            <?php

            self::getTreeEditProductCategories($defaultLanguage, $category->id, $selectCategories, $sub_mark + 20);
        endforeach;

    }


    public static function getCategoryProductName($id, $defaultLanguage)
    {

        return ProductCategory::where('id', $id)
            ->where('language_id', $defaultLanguage)
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->first();

    }

    /***
     * Products Categories END
     */


    /**
     *
     * Frontend Categories START
     *
     */


    public static function breadcrumbCategories($slug,$languageID,$dataName = null)
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


            $category = ProductCategory::where('language_id',  $languageID)
                ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
                ->where('slug', $afterSlug)
                ->where('status', 1)
                ->first();


            $html .= '<li class="breadcrumb-item"><a href="'.route('frontend.product.category.index',$item).'">'.$category->name.'</a></li>';

        endforeach;

        $categoryLast = ProductCategory::where('language_id',  $languageID)
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->where('slug', $lastSlug)
            ->where('status', 1)
            ->first();

        if($categoryLast != null){
            $html .= '<li class="breadcrumb-item active" aria-current="page">'.$categoryLast->name.'</li>';
        }else{

            $html .= '<li class="breadcrumb-item active" aria-current="page">'.$dataName.'</li>';

        }



        return $html;



    }

    public static function breadcrumbGalleriesCategories($slug,$languageID,$dataName = null)
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


            $category = GalleryCategory::where('language_id',  $languageID)
                ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
                ->where('slug', $afterSlug)
                ->where('status', 1)
                ->first();

                if($category){
                    $html .= '<li class="breadcrumb-item"><a href="'.route('frontend.gallery.category.index',$item).'">'.$category->name.'</a></li>';
                }


        endforeach;

        $categoryLast = GalleryCategory::where('language_id',  $languageID)
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->where('slug', $lastSlug)
            ->where('status', 1)
            ->first();

        if($categoryLast != null){
            $html .= '<li class="breadcrumb-item active" aria-current="page">'.$categoryLast->name.'</li>';
        }else{

            $html .= '<li class="breadcrumb-item active" aria-current="page">'.$dataName.'</li>';

        }



        return $html;



    }


    public static function bestsellerSlug($categoryID)
    {
        return ProductCategory::where('id',$categoryID)
            ->first()->slug;
    }

    /**
     *
     * Frontend Categories END
     *
     */


}
