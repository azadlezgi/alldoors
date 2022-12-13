<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCategoryAddRequest;
use App\Http\Requests\Product\ProductCategoryEditRequest;
use App\Models\Language\Languages;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCategoryTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
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


        $productCategories= ProductCategory::where('language_id',  $this->defaultLanguage)
            ->with('getProductsCount')
            ->orderBy('id', 'DESC')
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->paginate(10);
        $defaultLanguage = $this->defaultLanguage;


        return view('admin.product.category.index', compact('productCategories','defaultLanguage'));
    }

    public function add(Request $request)
    {


        return view('admin.product.category.add',['defaultLanguage' => $this->defaultLanguage]);
    }

    public function store(ProductCategoryAddRequest $request)
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

        $parentID = ProductCategory::where('id',$parent)->first();



        $productCategory = ProductCategory::create([
            'status' => $status,
            'parent' => $parentID == null? 0 :$parentID->id,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Product\ProductCategory'):uniqueSlug($slug,'\App\Models\Product\ProductCategory'),
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            ProductCategoryTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'category_id' => $productCategory->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.product.category.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $productCategory = ProductCategory::where('id', $id)
            ->with('productsCategoriesTranslations')->first();


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.product.category.edit', compact('productCategory','defaultLanguage'));
    }

    public function update(ProductCategoryEditRequest $request)
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


        $parentID = ProductCategory::where('id',$parent)->first();

        if($id == $parent){
            $parentID = null;
        }



        $productCategory = ProductCategory::where('id', $id)->first();
        if($productCategory->slug != $slug){
            $productCategory->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Product\ProductCategory'):uniqueSlug($slug,'\App\Models\Product\ProductCategory');
        }
        $productCategory->parent = $parentID == null? 0 :$parentID->id;
        $productCategory->status = $status;
        $productCategory->image = str_replace(env('APP_URL'), '', $image);
        $productCategory->updated_at = date('Y-m-d H:i:s');
        $productCategory->save();


        foreach ($request->name as $key => $name):
            ProductCategoryTranslation::where('category_id', $id)
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
            $productCategoryTranslation = ProductCategoryTranslation::where('category_id', $id)
                ->where('language_id', $key)->first();

            if(!$productCategoryTranslation){
                ProductCategoryTranslation::create([
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
        $parentAndID = ProductCategory::where('id',$parent)
            ->where('parent',$id)
            ->first();

        if($parentAndID){
            $parentAndID->parent = 0;
            $parentAndID->save();
        }


        return redirect()->route('admin.product.category.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;


        $productCategories = ProductCategory::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('products_categories_translations','products_categories.id','=','products_categories_translations.category_id')
            ->orderBy('id', 'DESC')
            ->select(
                '*',
                'products_categories.updated_at as updated_at',
            )
            ->paginate(10);




        $defaultLanguage = $this->defaultLanguage;

        return view('admin.product.category.search', compact('productCategories','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $page = ProductCategory::where('id', $id)->first();
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
        $category = ProductCategory::where('language_id',  $this->defaultLanguage)
            ->where('products_categories.id',$id)
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->join('products_categories_lists','products_categories_lists.category_id','=','products_categories.id')
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

        ProductCategory::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }

    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            ProductCategory::where('id', $id)->delete();
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
