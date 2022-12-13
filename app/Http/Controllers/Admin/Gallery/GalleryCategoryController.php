<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\GalleryCategoryAddRequest;
use App\Http\Requests\Gallery\GalleryCategoryEditRequest;
use App\Models\Language\Languages;
use App\Models\Gallery\GalleryCategory;
use App\Models\Gallery\GalleryCategoryTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
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


        $galleryCategories= GalleryCategory::where('language_id',  $this->defaultLanguage)
            ->with('getGalleriesCount')
            ->orderBy('id', 'DESC')
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->paginate(10);
        $defaultLanguage = $this->defaultLanguage;


        return view('admin.gallery.category.index', compact('galleryCategories','defaultLanguage'));
    }

    public function add(Request $request)
    {


        return view('admin.gallery.category.add',['defaultLanguage' => $this->defaultLanguage]);
    }

    public function store(GalleryCategoryAddRequest $request)
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

        $parentID = GalleryCategory::where('id',$parent)->first();



        $galleryCategory = GalleryCategory::create([
            'status' => $status,
            'parent' => $parentID == null? 0 :$parentID->id,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Gallery\GalleryCategory'):uniqueSlug($slug,'\App\Models\Gallery\GalleryCategory'),
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            GalleryCategoryTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'category_id' => $galleryCategory->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.gallery.category.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $galleryCategory = GalleryCategory::where('id', $id)
            ->with('galleriesCategoriesTranslations')->first();


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.gallery.category.edit', compact('galleryCategory','defaultLanguage'));
    }

    public function update(GalleryCategoryEditRequest $request)
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


        $parentID = GalleryCategory::where('id',$parent)->first();

        if($id == $parent){
            $parentID = null;
        }





        $galleryCategory = GalleryCategory::where('id', $id)->first();
        if($galleryCategory->slug != $slug){
            $galleryCategory->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Gallery\GalleryCategory'):uniqueSlug($slug,'\App\Models\Gallery\GalleryCategory');
        }
        $galleryCategory->parent = $parentID == null? 0 :$parentID->id;
        $galleryCategory->status = $status;
        $galleryCategory->image = str_replace(env('APP_URL'), '', $image);
        $galleryCategory->updated_at = date('Y-m-d H:i:s');
        $galleryCategory->save();


        foreach ($request->name as $key => $name):
            GalleryCategoryTranslation::where('category_id', $id)
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
            $galleryCategoryTranslation = GalleryCategoryTranslation::where('category_id', $id)
                ->where('language_id', $key)->first();

            if(!$galleryCategoryTranslation){
                GalleryCategoryTranslation::create([
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
        $parentAndID = GalleryCategory::where('id',$parent)
            ->where('parent',$id)
            ->first();

        if($parentAndID){
            $parentAndID->parent = 0;
            $parentAndID->save();
        }


        return redirect()->route('admin.gallery.category.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;


        $galleryCategories = GalleryCategory::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('galleries_categories_translations','galleries_categories.id','=','galleries_categories_translations.category_id')
            ->orderBy('id', 'DESC')
            ->select(
                '*',
                'galleries_categories.updated_at as updated_at',
            )
            ->paginate(10);


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.gallery.category.search', compact('galleryCategories','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $page = GalleryCategory::where('id', $id)->first();
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
        $category = GalleryCategory::where('language_id',  $this->defaultLanguage)
            ->where('galleries_categories.id',$id)
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->join('galleries_categories_lists','galleries_categories_lists.category_id','=','galleries_categories.id')
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

        GalleryCategory::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            GalleryCategory::where('id', $id)->delete();
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
