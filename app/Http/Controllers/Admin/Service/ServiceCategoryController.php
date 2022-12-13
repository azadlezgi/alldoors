<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceCategoryAddRequest;
use App\Http\Requests\Service\ServiceCategoryEditRequest;
use App\Models\Language\Languages;
use App\Models\Service\ServiceCategory;
use App\Models\Service\ServiceCategoryTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
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


        $serviceCategories= ServiceCategory::where('language_id',  $this->defaultLanguage)
            ->with('getServicesCount')
            ->orderBy('id', 'DESC')
            ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
            ->paginate(10);
        $defaultLanguage = $this->defaultLanguage;


        return view('admin.service.category.index', compact('serviceCategories','defaultLanguage'));
    }

    public function add(Request $request)
    {


        return view('admin.service.category.add',['defaultLanguage' => $this->defaultLanguage]);
    }

    public function store(ServiceCategoryAddRequest $request)
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

        $parentID = ServiceCategory::where('id',$parent)->first();



        $serviceCategory = ServiceCategory::create([
            'status' => $status,
            'parent' => $parentID == null? 0 :$parentID->id,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Service\ServiceCategory'):uniqueSlug($slug,'\App\Models\Service\ServiceCategory'),
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            ServiceCategoryTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'category_id' => $serviceCategory->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.service.category.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $serviceCategory = ServiceCategory::where('id', $id)
            ->with('servicesCategoriesTranslations')->first();


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.service.category.edit', compact('serviceCategory','defaultLanguage'));
    }

    public function update(ServiceCategoryEditRequest $request)
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


        $parentID = ServiceCategory::where('id',$parent)->first();

        if($id == $parent){
            $parentID = null;
        }





        $serviceCategory = ServiceCategory::where('id', $id)->first();
        if($serviceCategory->slug != $slug){
            $serviceCategory->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Service\ServiceCategory'):uniqueSlug($slug,'\App\Models\Service\ServiceCategory');
        }
        $serviceCategory->parent = $parentID == null? 0 :$parentID->id;
        $serviceCategory->status = $status;
        $serviceCategory->image = str_replace(env('APP_URL'), '', $image);
        $serviceCategory->updated_at = date('Y-m-d H:i:s');
        $serviceCategory->save();


        foreach ($request->name as $key => $name):
            ServiceCategoryTranslation::where('category_id', $id)
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
            $serviceCategoryTranslation = ServiceCategoryTranslation::where('category_id', $id)
                ->where('language_id', $key)->first();

            if(!$serviceCategoryTranslation){
                ServiceCategoryTranslation::create([
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
        $parentAndID = ServiceCategory::where('id',$parent)
            ->where('parent',$id)
            ->first();

        if($parentAndID){
            $parentAndID->parent = 0;
            $parentAndID->save();
        }


        return redirect()->route('admin.service.category.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;


        $serviceCategories = ServiceCategory::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('services_categories_translations','services_categories.id','=','services_categories_translations.category_id')
            ->orderBy('id', 'DESC')
            ->select(
                '*',
                'services_categories.updated_at as updated_at',
            )
            ->paginate(10);


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.service.category.search', compact('serviceCategories','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $page = ServiceCategory::where('id', $id)->first();
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
        $category = ServiceCategory::where('language_id',  $this->defaultLanguage)
            ->where('services_categories.id',$id)
            ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
            ->join('services_categories_lists','services_categories_lists.category_id','=','services_categories.id')
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

        ServiceCategory::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }

    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            ServiceCategory::where('id', $id)->delete();
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
