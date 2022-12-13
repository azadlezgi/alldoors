<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductModelAddRequest;
use App\Http\Requests\Product\ProductModelEditRequest;
use App\Models\Language\Languages;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductModelTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductModelController extends Controller
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


        $productModels= ProductModel::where('language_id',  $this->defaultLanguage)
            ->with('getProductsCount')
            ->orderBy('id', 'DESC')
            ->join('products_models_translations', 'products_models_translations.model_id', '=', 'products_models.id')
            ->paginate(10);
        $defaultLanguage = $this->defaultLanguage;


        return view('admin.product.model.index', compact('productModels','defaultLanguage'));
    }

    public function add(Request $request)
    {


        return view('admin.product.model.add',['defaultLanguage' => $this->defaultLanguage]);
    }

    public function store(ProductModelAddRequest $request)
    {

        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;



        //CUSTOM VALIDATE START
        $this->validatorCheck = Validator::make(request()->all(), []);

        if (!in_array($status, [0, 1])) {
            $this->validateCheck('status', 'Səhv status.');
        }

        $this->validatorCheck->validate();




        $productModel = ProductModel::create([
            'status' => $status,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Product\ProductModel'):uniqueSlug($slug,'\App\Models\Product\ProductModel'),
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            ProductModelTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'model_id' => $productModel->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.product.model.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $productModel = ProductModel::where('id', $id)
            ->with('productsModelsTranslations')->first();


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.product.model.edit', compact('productModel','defaultLanguage'));
    }

    public function update(ProductModelEditRequest $request)
    {
        $id = $request->id;
        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;

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




        $productModel = ProductModel::where('id', $id)->first();
        if($productModel->slug != $slug){
            $productModel->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Product\ProductModel'):uniqueSlug($slug,'\App\Models\Product\ProductModel');
        }

        $productModel->status = $status;
        $productModel->image = str_replace(env('APP_URL'), '', $image);
        $productModel->updated_at = date('Y-m-d H:i:s');
        $productModel->save();


        foreach ($request->name as $key => $name):
            ProductModelTranslation::where('model_id', $id)
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
            $productModelTranslation = ProductModelTranslation::where('model_id', $id)
                ->where('language_id', $key)->first();

            if(!$productModelTranslation){
                ProductModelTranslation::create([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'model_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;


        return redirect()->route('admin.product.model.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;


        $productModels = ProductModel::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('products_models_translations','products_models.id','=','products_models_translations.model_id')
            ->orderBy('id', 'DESC')
            ->select(
                '*',
                'products_models.updated_at as updated_at',
            )
            ->paginate(10);




        $defaultLanguage = $this->defaultLanguage;

        return view('admin.product.model.search', compact('productModels','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $page = ProductModel::where('id', $id)->first();
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
        $model = ProductModel::where('language_id',  $this->defaultLanguage)
            ->where('products_models.id',$id)
            ->join('products_models_translations', 'products_models_translations.model_id', '=', 'products_models.id')
            ->join('products_models_lists','products_models_lists.model_id','=','products_models.id')
            ->first();


        $error = '';
        $name = '';
        if(is_null($model)){
            $error = null;
        }else{
            $name = $model->name;
        }


        return response()->json(['success' => true,'error' => $error,'name' => $name], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        ProductModel::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            ProductModel::where('id', $id)->delete();
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
