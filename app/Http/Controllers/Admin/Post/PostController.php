<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostAddRequest;
use App\Http\Requests\Post\PostEditRequest;
use App\Models\Post\PostCategory;
use App\Models\Post\PostCategoryList;
use App\Models\Language\Languages;
use App\Models\Post\Post;
use App\Models\Post\PostTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public $defaultLanguage;
    public $validatorCheck;


    public function __construct()
    {

        //Hansi dil defaultdursa onu caqir
        $this->defaultLanguage = cache('language-defaultID') == null ? Languages::where('default', 1)
            ->first()->id : cache('language-defaultID');

    }

    public function index(Request $request)
    {

        $posts = Post::with(array('postsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->with('postsCategories')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $defaultLanguage = $this->defaultLanguage;


        return view('admin.post.index', compact('posts','defaultLanguage'));
    }

    public function categories(Request $request)
    {

        $id = $request->id;

        $posts = Post::with(array('postsTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->where('posts_categories_lists.category_id',$id)
            ->join('posts_categories_lists','posts_categories_lists.post_id','=','posts.id')
            ->orderBy('posts.id', 'DESC')
            ->select('*','posts.id as id')
            ->paginate(10);

        $category = PostCategory::where('language_id',  $this->defaultLanguage)
            ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
            ->where('id',$id)
            ->first();



        $defaultLanguage = $this->defaultLanguage;


        return view('admin.post.category', compact('posts','defaultLanguage','category'));

    }

    public function add(Request $request)
    {

        $defaultLanguage = $this->defaultLanguage;

        return view('admin.post.add',compact('defaultLanguage'));
    }

    public function store(PostAddRequest $request)
    {

        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;
        $categories = $request->categories;
        $images = str_replace(env('APP_URL'), '', $request->images);
        $images = json_encode($images, JSON_FORCE_OBJECT);

        if ($images == '""') {
            $images = trim($images, '""');
        }



        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $post = Post::create([
            'status' => $status,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Post\Post'):uniqueSlug($slug,'\App\Models\Post\Post'),
            'image' => str_replace(env('APP_URL'), '', $image),
            'images' => $images,
        ]);

        foreach ($categories as $category):
            PostCategoryList::create([
               'post_id' => $post->id,
               'category_id' => $category
            ]);
        endforeach;


        foreach ($request->name as $key => $name):

            PostTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'post_id' => $post->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.post.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $post = Post::where('id', $id)
            ->with('postsTranslations')
            ->with('postsCategories')
            ->first();

        $defaultLanguage = $this->defaultLanguage;


        $selectCategories = [];
        foreach ($post->postsCategories as $postsCategory):
            $selectCategories[]= $postsCategory->category_id;
        endforeach;



        return view('admin.post.edit', compact('post','defaultLanguage','selectCategories'));
    }

    public function update(PostEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;
        $categories = $request->categories;
        $images = str_replace(env('APP_URL'), '', $request->images);
        $images = json_encode($images, JSON_FORCE_OBJECT);

        if ($images == '""') {
            $images = trim($images, '""');
        }

        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        //Eger gonderilen ID sehfdirse
        $refererError = CommonService::refererError($id);
        if ($refererError) {
            $this->validateCheck('refererID', 'Səhf ID istifadə etdiniz!');
        }


        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $post = Post::where('id', $id)->first();
        if($post->slug != $slug){
            $post->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Post\Post'):uniqueSlug($slug,'\App\Models\Post\Post');
        }
        $post->status = $status;
        $post->image = str_replace(env('APP_URL'), '', $image);
        $post->images = $images;
        $post->updated_at = date('Y-m-d H:i:s');
        $post->save();


        //once sil sonra yeniden kateqoriyalari elave et
        PostCategoryList::where('post_id',$id)
            ->delete();

        foreach ($categories as $category):
            PostCategoryList::create([
                'post_id' => $post->id,
                'category_id' => $category
            ]);
        endforeach;



        foreach ($request->name as $key => $name):
            PostTranslation::where('post_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'language_id' => $key,
                ]);



            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $postTranslation = PostTranslation::where('post_id', $id)
                ->where('language_id', $key)->first();

            if(!$postTranslation){
                PostTranslation::create([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'post_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.post.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('posts_translations','posts.id','=','posts_translations.post_id')
            ->orderBy('id', 'DESC')
            ->with('postsCategories')
            ->select(
                '*',
                'posts.updated_at as updated_at',
            )
            ->paginate(10);

        $defaultLanguage = $this->defaultLanguage;


        return view('admin.post.search', compact('posts','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $post = Post::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($post) {
            $post->status = $statusActive;
            $post->save();

            if ($statusActive == 1) {
                $data = 1;
            } else {
                $data = 0;
            }

            $success = true;
        } else {
            $success = false;

        }


        return response()->json(['success' => $success, 'data' => $data]);
    }

    public function deleteAjax(Request $request)
    {
        $id = $request->id;
        Post::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        Post::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }

    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            Post::where('id', $id)->delete();
        endforeach;

        return response()->json(['success' => true], 200);

    }


    public function validateCheck($inputName, $text)
    {
        $this->validatorCheck->after(function ($validator) use ($inputName, $text) {
            $validator->errors()->add($inputName, $text);
        });
    }
}
