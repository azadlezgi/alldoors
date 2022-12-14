<?php

namespace App\Http\Controllers\Frontend\Post;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request, $categorySlug = null)
    {
        $fullCategorySlug = $categorySlug;


        if (!is_null($categorySlug) && strpos($categorySlug, "/")) {
            $slug_array = explode("/", $categorySlug);
            $categorySlug = $slug_array[(count($slug_array) - 1)];
        }

        $categories = "";
        $posts = '';
        $postcCount = '';
        $category = '';
        if ($categorySlug != null) {

            $category = PostCategory::where('language_id',  $request->languageID)
                ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
                ->where('slug', $categorySlug)
                ->with('getPostsCount')
                ->where('status', 1)
                ->first();



            if ($category) {
                $categories = PostCategory::where('language_id', $request->languageID)
                    ->with('getPostsCount')
                    ->orderBy('id', 'DESC')
                    ->where('status', 1)
                    ->where('parent', $category->id)
                    ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
                    ->get();



                $posts = Post::with(array('postsTranslations' => function ($query) use($request) {
                    $query->where('language_id', $request->languageID);

                })) ->with('postsCategoriesCheck')
                    ->where('posts_categories_lists.category_id', $category->id)
                    ->join('posts_categories_lists', 'posts_categories_lists.post_id', '=', 'posts.id')
                    ->orderBy('posts.id', 'DESC')
                    ->select('*', 'posts.id as id')
                    ->where('status', 1)
                    ->paginate(10);




            }else{
                abort(404);
            }


        } else {
            abort(404);
        }

        $postcCount = $category->getPostsCount->count();
        $categoryName = $category->name;


        return view('frontend.post.category.index', compact(
            'categories',
            'fullCategorySlug',
            'posts',
            'postcCount',
            'category',
            'categoryName',
        ));


    }



    public function detail(Request $request,$categorySlug = null)
    {

        $fullCategorySlug = $categorySlug;

        if (!is_null($categorySlug) && strpos($categorySlug, "/")) {
            $slug_array = explode("/", $categorySlug);
            $lastSlug = $slug_array[(count($slug_array) - 1)];

        }else{
            $lastSlug = $categorySlug;
        }


        $slug = $lastSlug;
        $post = Post::where('slug', $slug)
            ->where('status', 1)
            ->with(['postsTranslations' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }])
            ->with('postsCategoriesCheck')
            ->first();







        if (!$post || count($post->postsCategoriesCheck) == 0) {
            abort(404);
        }


        /*   ATTRIBUTES START   */





        return view('frontend.post.category.detail', compact(
            'post',
            'fullCategorySlug'
        ));



    }

}
