<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostCategoryAddRequest;
use App\Http\Requests\Post\PostCategoryEditRequest;
use App\Models\Language\Languages;
use App\Models\Post\PostCategory;
use App\Models\Post\PostCategoryTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
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


        $postCategories= PostCategory::where('language_id',  $this->defaultLanguage)
            ->with('getPostsCount')
            ->orderBy('id', 'DESC')
            ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
            ->paginate(10);
        $defaultLanguage = $this->defaultLanguage;


        return view('admin.post.category.index', compact('postCategories','defaultLanguage'));
    }

    public function add(Request $request)
    {


        return view('admin.post.category.add',['defaultLanguage' => $this->defaultLanguage]);
    }

    public function store(PostCategoryAddRequest $request)
    {

        $status = $request->status;
        $parent = $request->parent;
        $image = $request->image;
        $slug = $request->slug;




        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();

        $parentID = PostCategory::where('id',$parent)->first();



        $postCategory = PostCategory::create([
            'status' => $status,
            'parent' => $parentID == null? 0 :$parentID->id,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Post\PostCategory'):uniqueSlug($slug,'\App\Models\Post\PostCategory'),
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            PostCategoryTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'category_id' => $postCategory->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.post.category.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $postCategory = PostCategory::where('id', $id)
            ->with('postsCategoriesTranslations')->first();


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.post.category.edit', compact('postCategory','defaultLanguage'));
    }

    public function update(PostCategoryEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;
        $parent = $request->parent;

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

        if($parent == $id){
            $this->validateCheck('status', 'Eyni kateqoriyanı özünün alt kateqoriyası kimi göstərmək olmaz!');
        }



        $this->validatorCheck->validate();


        $parentID = PostCategory::where('id',$parent)->first();

        if($id == $parent){
            $parentID = null;
        }





        $postCategory = PostCategory::where('id', $id)->first();
        if($postCategory->slug != $slug){
            $postCategory->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Post\PostCategory'):uniqueSlug($slug,'\App\Models\Post\PostCategory');
        }
        $postCategory->parent = $parentID == null? 0 :$parentID->id;
        $postCategory->status = $status;
        $postCategory->image = str_replace(env('APP_URL'), '', $image);
        $postCategory->updated_at = date('Y-m-d H:i:s');
        $postCategory->save();


        foreach ($request->name as $key => $name):
            PostCategoryTranslation::where('category_id', $id)
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
            $postCategoryTranslation = PostCategoryTranslation::where('category_id', $id)
                ->where('language_id', $key)->first();

            if(!$postCategoryTranslation){
                PostCategoryTranslation::create([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'category_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;


        //Eger parent ve id bir birine beraberdirse
        // mes: Electronic -> Notebook deyishib Notebook -> Electronic olursa
        $parentAndID = PostCategory::where('id',$parent)
            ->where('parent',$id)
            ->first();

        if($parentAndID){
            $parentAndID->parent = 0;
            $parentAndID->save();
        }


        return redirect()->route('admin.post.category.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;


        $postCategories = PostCategory::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('posts_categories_translations','posts_categories.id','=','posts_categories_translations.category_id')
            ->orderBy('id', 'DESC')
            ->select(
                '*',
                'posts_categories.updated_at as updated_at',
            )
            ->paginate(10);


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.post.category.search', compact('postCategories','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $page = PostCategory::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($page) {
            $page->status = $statusActive;
            $page->save();

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
        $category = PostCategory::where('language_id',  $this->defaultLanguage)
            ->where('posts_categories.id',$id)
            ->join('posts_categories_translations', 'posts_categories_translations.category_id', '=', 'posts_categories.id')
            ->join('posts_categories_lists','posts_categories_lists.category_id','=','posts_categories.id')
            ->first();


        $error = '';
        $name = '';
        if(is_null($category)){
            $error = null;
        }else{
            $name = $category->name;
        }


        return response()->json(['success' => true,'error' => $error,'name' => $name], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        PostCategory::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            PostCategory::where('id', $id)->delete();
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
