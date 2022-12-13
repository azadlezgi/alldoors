<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\GalleryAddRequest;
use App\Http\Requests\Gallery\GalleryEditRequest;
use App\Models\Gallery\GalleryCategory;
use App\Models\Gallery\GalleryCategoryList;
use App\Models\Language\Languages;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\GalleryTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryController extends Controller
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

        $galleries = Gallery::with(array('galleriesTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->with('galleriesCategories')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $defaultLanguage = $this->defaultLanguage;


        return view('admin.gallery.index', compact('galleries','defaultLanguage'));
    }

    public function categories(Request $request)
    {

        $id = $request->id;

        $galleries = Gallery::with(array('galleriesTranslations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->where('galleries_categories_lists.category_id',$id)
            ->join('galleries_categories_lists','galleries_categories_lists.gallery_id','=','galleries.id')
            ->orderBy('galleries.id', 'DESC')
            ->select('*','galleries.id as id')
            ->paginate(10);

        $category = GalleryCategory::where('language_id',  $this->defaultLanguage)
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->where('id',$id)
            ->first();



        $defaultLanguage = $this->defaultLanguage;


        return view('admin.gallery.category', compact('galleries','defaultLanguage','category'));

    }

    public function add(Request $request)
    {

        $defaultLanguage = $this->defaultLanguage;

        return view('admin.gallery.add',compact('defaultLanguage'));
    }

    public function store(GalleryAddRequest $request)
    {

        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;
        $categories = $request->categories;


        $filesArr = $request->input('files');

        $files = '';
        if($filesArr != null){
            $filesArr = array_map(
                function($str) {
                    return str_replace(env('APP_URL'), '',$str);
                },
                $filesArr
            );

            $files = json_encode($filesArr, JSON_FORCE_OBJECT);



            if ($files == '""') {
                $files = trim($files, '""');
            }
        }







        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();


        $gallery = Gallery::create([
            'status' => $status,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Gallery\Gallery'):uniqueSlug($slug,'\App\Models\Gallery\Gallery'),
            'image' => str_replace(env('APP_URL'), '', $image),
            'images' => $files,
        ]);

        foreach ($categories as $category):
            GalleryCategoryList::create([
               'gallery_id' => $gallery->id,
               'category_id' => $category
            ]);
        endforeach;


        foreach ($request->name as $key => $name):

            GalleryTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'gallery_id' => $gallery->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.gallery.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $gallery = Gallery::where('id', $id)
            ->with('galleriesTranslations')
            ->with('galleriesCategories')
            ->first();

        $defaultLanguage = $this->defaultLanguage;


        $selectCategories = [];
        foreach ($gallery->galleriesCategories as $galleriesCategory):
            $selectCategories[]= $galleriesCategory->category_id;
        endforeach;



        return view('admin.gallery.edit', compact('gallery','defaultLanguage','selectCategories'));
    }

    public function update(GalleryEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;
        $categories = $request->categories;



        $filesArr = $request->input('files');

        $files = '';
        if($filesArr != null){
            $filesArr = array_map(
                function($str) {
                    return str_replace(env('APP_URL'), '',$str);
                },
                $filesArr
            );

            $files = json_encode($filesArr, JSON_FORCE_OBJECT);



            if ($files == '""') {
                $files = trim($files, '""');
            }
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


        $gallery = Gallery::where('id', $id)->first();
        if($gallery->slug != $slug){
            $gallery->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Gallery\Gallery'):uniqueSlug($slug,'\App\Models\Gallery\Gallery');
        }
        $gallery->status = $status;
        $gallery->image = str_replace(env('APP_URL'), '', $image);
        $gallery->images = $files;
        $gallery->updated_at = date('Y-m-d H:i:s');
        $gallery->save();


        //once sil sonra yeniden kateqoriyalari elave et
        GalleryCategoryList::where('gallery_id',$id)
            ->delete();

        foreach ($categories as $category):
            GalleryCategoryList::create([
                'gallery_id' => $gallery->id,
                'category_id' => $category
            ]);
        endforeach;



        foreach ($request->name as $key => $name):
            GalleryTranslation::where('gallery_id', $id)
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
            $galleryTranslation = GalleryTranslation::where('gallery_id', $id)
                ->where('language_id', $key)->first();

            if(!$galleryTranslation){
                GalleryTranslation::create([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'gallery_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        return redirect()->route('admin.gallery.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;

        $galleries = Gallery::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('galleries_translations','galleries.id','=','galleries_translations.gallery_id')
            ->orderBy('id', 'DESC')
            ->with('galleriesCategories')
            ->select(
                '*',
                'galleries.updated_at as updated_at',
            )
            ->paginate(10);

        $defaultLanguage = $this->defaultLanguage;


        return view('admin.gallery.search', compact('galleries','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $gallery = Gallery::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($gallery) {
            $gallery->status = $statusActive;
            $gallery->save();

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
        Gallery::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        Gallery::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            Gallery::where('id', $id)->delete();
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
