<?php

namespace App\Services;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;

class PostsService
{


    public static function getTreeIndex($defaultLanguage, $categoryID, $parent_id, $sub_mark = '')
    {


        $categories = PostCategory::where('id', $categoryID)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
            ->get();


        foreach ($categories as $category):
            if ($sub_mark == '') {
                echo $sub_mark . '<b><a href="' . route('admin.post.category.edit', $category->id) . '">' . $category->name . '</a></b>';
            } else {
                echo $sub_mark . '<a href="' . route('admin.post.category.edit', $category->id) . '">' . $category->name . '</a>';
            }

            self::getTreeIndex($defaultLanguage, $category->parent, $parent_id, ' -> ');
        endforeach;

    }


    public static function getTree($defaultLanguage, $parent_id = 0, $sub_mark = '')
    {


        $categories = PostCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
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


        $categories = PostCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
            ->get();


        foreach ($categories as $category):
            ?>
            <option
                value="<?= $category->id ?>" <?= old('parent', $categoryID) == $category->id ? 'selected' : '' ?>><?= $sub_mark . $category->name ?></option> <?php
            self::getEditTree($defaultLanguage, $categoryID, $category->id, $sub_mark . ' - ');
        endforeach;

    }


    public static function getTreePostCategories($defaultLanguage, $parent_id = 0, $sub_mark = 20)
    {


        $categories = PostCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->where('status', 1)
            ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
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

            self::getTreePostCategories($defaultLanguage, $category->id, $sub_mark + 20);
        endforeach;

    }


    public static function getTreeEditPostCategories($defaultLanguage, $parent_id = 0, $selectCategories = [], $sub_mark = 20)
    {


        $categories = PostCategory::where('parent', $parent_id)
            ->where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->where('status', 1)
            ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
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

            self::getTreeEditPostCategories($defaultLanguage, $category->id, $selectCategories, $sub_mark + 20);
        endforeach;

    }


    public static function getCategoryName($id, $defaultLanguage)
    {

        return PostCategory::where('id', $id)
            ->where('language_id', $defaultLanguage)
            ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
            ->first();

    }

    public static function getPosts($languageID,$limit)
    {

        return Post::with(array('postsTranslations' => function ($query) use ($languageID) {
            $query->where('language_id', $languageID);

        }))
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->limit($limit)
            ->get();

    }


}
