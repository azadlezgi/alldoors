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
            foreach ($posts as $post_index => $post) {
                $post->image = $post->image ? $post->image : '/storage/no-image.png';
                $post->image = ImageService::customImageSize($post->image, 410, 230, 100);
                $post->date = Carbon::parse($post->created_at)->format('d.m.Y');
                $posts[$post_index] = $post;
            }
        }


        return view('frontend.post.index', compact(
            'posts'
        ));
    }


    public function detail(Request $request)
    {

        $slug = stripinput($request->slug);

        $post = Post::where('slug', $slug)
            ->where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('posts_translations', 'posts.id', '=', 'posts_translations.post_id')
            ->first();


        if ($post == null) {
            abort(404);
        }


        $post->image = $post->image ? $post->image : '/storage/no-image.png';
        $post->image = ImageService::customImageSize($post->image, 1312, 736, 80);
        $post->date = Carbon::parse($post->created_at)->format('d.m.Y');

//        dd($post);


        $posts = Post::select(
                'posts.id as id',
                'posts_translations.name as name',
                'posts.image as image',
                'posts.slug as slug',
                'posts.status as status',
                'posts.created_at as created_at',
            )
            ->join('posts_translations', 'posts.id', '=', 'posts_translations.post_id')
            ->where('posts.status', 1)
            ->where('language_id', $request->languageID)
            ->where('posts.id', '<', $post->id)
            ->groupBy('posts.id')
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();


        return view('frontend.post.detail', compact(
            'posts',
            'post',
        ));

    }


}
