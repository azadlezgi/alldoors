<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductManufacturerAddRequest;
use App\Http\Requests\Product\ProductManufacturerEditRequest;
use App\Models\Language\Languages;
use App\Models\Product\ProductManufacturer;
use App\Models\Product\ProductManufacturerTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductManufacturerController extends Controller
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


        $productManufacturers= ProductManufacturer::where('language_id',  $this->defaultLanguage)
            ->with('getProductsCount')
            ->orderBy('id', 'DESC')
            ->join('products_manufacturers_translations', 'products_manufacturers_translations.manufacturer_id', '=', 'products_manufacturers.id')
            ->paginate(10);
        $defaultLanguage = $this->defaultLanguage;


        return view('admin.product.manufacturer.index', compact('productManufacturers','defaultLanguage'));
    }

    public function add(Request $request)
    {


        return view('admin.product.manufacturer.add',['defaultLanguage' => $this->defaultLanguage]);
    }

    public function store(ProductManufacturerAddRequest $request)
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




        $productManufacturer = ProductManufacturer::create([
            'status' => $status,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Product\ProductManufacturer'):uniqueSlug($slug,'\App\Models\Product\ProductManufacturer'),
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            ProductManufacturerTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'manufacturer_id' => $productManufacturer->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.product.manufacturer.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $productManufacturer = ProductManufacturer::where('id', $id)
            ->with('productsManufacturersTranslations')->first();


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.product.manufacturer.edit', compact('productManufacturer','defaultLanguage'));
    }

    public function update(ProductManufacturerEditRequest $request)
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




        $productManufacturer = ProductManufacturer::where('id', $id)->first();
        if($productManufacturer->slug != $slug){
            $productManufacturer->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Product\ProductManufacturer'):uniqueSlug($slug,'\App\Models\Product\ProductManufacturer');
        }

        $productManufacturer->status = $status;
        $productManufacturer->image = str_replace(env('APP_URL'), '', $image);
        $productManufacturer->updated_at = date('Y-m-d H:i:s');
        $productManufacturer->save();


        foreach ($request->name as $key => $name):
            ProductManufacturerTranslation::where('manufacturer_id', $id)
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
            $productManufacturerTranslation = ProductManufacturerTranslation::where('manufacturer_id', $id)
                ->where('language_id', $key)->first();

            if(!$productManufacturerTranslation){
                ProductManufacturerTranslation::create([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'manufacturer_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;


        return redirect()->route('admin.product.manufacturer.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;


        $productManufacturers = ProductManufacturer::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('products_manufacturers_translations','products_manufacturers.id','=','products_manufacturers_translations.manufacturer_id')
            ->orderBy('id', 'DESC')
            ->select(
                '*',
                'products_manufacturers.updated_at as updated_at',
            )
            ->paginate(10);




        $defaultLanguage = $this->defaultLanguage;

        return view('admin.product.manufacturer.search', compact('productManufacturers','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $page = ProductManufacturer::where('id', $id)->first();
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
        $manufacturer = ProductManufacturer::where('language_id',  $this->defaultLanguage)
            ->where('products_manufacturers.id',$id)
            ->join('products_manufacturers_translations', 'products_manufacturers_translations.manufacturer_id', '=', 'products_manufacturers.id')
            ->join('products_manufacturers_lists','products_manufacturers_lists.manufacturer_id','=','products_manufacturers.id')
            ->first();


        $error = '';
        $name = '';
        if(is_null($manufacturer)){
            $error = null;
        }else{
            $name = $manufacturer->name;
        }


        return response()->json(['success' => true,'error' => $error,'name' => $name], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        ProductManufacturer::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            ProductManufacturer::where('id', $id)->delete();
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
