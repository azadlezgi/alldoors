<?php

namespace App\Http\Controllers\Frontend\Post;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Partner\Partner;
use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function index(Request $request)
    {

        $posts = Post::select(
            'posts.id as id',
            'posts_translations.name as name',
            'posts.image as image',
            'posts.slug as slug',
            'posts.status as status',
            'posts.created_at as created_at',
        )
        ->where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('posts_translations', 'posts.id', '=', 'posts_translations.post_id')
            ->orderBy('id', 'DESC')
            ->paginate(12);

        if ($posts) {
            foreach ($posts as $post) {
                $post->image = $post->image ? $post->image : '/storage/no-image.png';
                $post->image = ImageService::customImageSize($post->image, 410, 230, 100);
                $post->date = Carbon::parse($post->created_at)->format('d.m.Y');
                $posts[] = $post;
            }
        }

//        dd($posts);




//        $categories = PostCategory::where('language_id', $request->languageID)
////            ->with('getPostsCount')
//            ->orderBy('id', 'DESC')
//            ->where('parent', 0)
//            ->where('status', 1)
//            ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
//            ->get();






        return view('frontend.post.index', compact(
            'posts'
        ));
    }


    public function detail(Request $request)
    {

        $slug = $request->slug;
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

        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->get();

        $posts = Post::with(array('postsTranslations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('postsCategoriesCheck')
            ->join('posts_categories_lists', 'posts_categories_lists.post_id', '=', 'posts.id')
            ->join('posts_categories', function ($join) {
                $join->on('posts_categories_lists.category_id', '=', 'posts_categories.id')->where('posts_categories.status', 1);
            })
            ->select(
                'posts.id as id',
                'posts.image as image',
                'posts.images as images',
                'posts.slug as slug',

                'posts.status as status',
                'posts.created_at as created_at',
                'posts.updated_at as updated_at',
            )
            ->where('posts.status', 1)
            ->groupBy('posts_categories_lists.post_id')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();


        return view('frontend.post.detail', compact(
            'posts',
            'post',
            'partners',
        ));

    }


}
