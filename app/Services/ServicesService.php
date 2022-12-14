<?php


namespace App\Services;


use App\Models\Service\Service;
use App\Models\Service\ServiceCategory;
use App\Models\Product\ProductCategory;
use Illuminate\Support\Str;

class ServicesService
{


    public static function getTreeIndex($defaultLanguage, $categoryID, $parent_id, $sub_mark = '')
    {


        $categories = ServiceCategory::where('id', $categoryID)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
            ->get();


        foreach ($categories as $category):
            if ($sub_mark == '') {
                echo $sub_mark . '<b><a href="' . route('admin.service.category.edit', $category->id) . '">' . $category->name . '</a></b>';
            } else {
                echo $sub_mark . '<a href="' . route('admin.service.category.edit', $category->id) . '">' . $category->name . '</a>';
            }

            self::getTreeIndex($defaultLanguage, $category->parent, $parent_id, ' -> ');
        endforeach;

    }


    public static function getTree($defaultLanguage, $parent_id = 0, $sub_mark = '')
    {


        $categories = ServiceCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
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


        $categories = ServiceCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
            ->get();


        foreach ($categories as $category):
            ?>
            <option
                value="<?= $category->id ?>" <?= old('parent', $categoryID) == $category->id ? 'selected' : '' ?>><?= $sub_mark . $category->name ?></option> <?php
            self::getEditTree($defaultLanguage, $categoryID, $category->id, $sub_mark . ' - ');
        endforeach;

    }


    public static function getTreeServiceCategories($defaultLanguage, $parent_id = 0, $sub_mark = 20)
    {


        $categories = ServiceCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->where('status', 1)
            ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
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

            self::getTreeServiceCategories($defaultLanguage, $category->id, $sub_mark + 20);
        endforeach;

    }


    public static function getTreeEditServiceCategories($defaultLanguage, $parent_id = 0, $selectCategories = [], $sub_mark = 20)
    {


        $categories = ServiceCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->where('status', 1)
            ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
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

            self::getTreeEditServiceCategories($defaultLanguage, $category->id, $selectCategories, $sub_mark + 20);
        endforeach;

    }


    public static function getCategoryName($id, $defaultLanguage)
    {

        return ServiceCategory::where('id', $id)
            ->where('language_id', $defaultLanguage)
            ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
            ->first();

    }

    public static function getServices($languageID,$limit)
    {

        return Service::with(array('servicesTranslations' => function ($query) use ($languageID) {
            $query->where('language_id', $languageID);

        }))
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit($limit)
            ->get();

    }






}
