<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCollectionAddRequest;
use App\Http\Requests\Product\ProductCollectionEditRequest;
use App\Models\Language\Languages;
use App\Models\Product\ProductCollection;
use App\Models\Product\ProductCollectionTranslation;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductCollectionController extends Controller
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


        $productCollections= ProductCollection::where('language_id',  $this->defaultLanguage)
            ->with('getProductsCount')
            ->orderBy('id', 'DESC')
            ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
            ->paginate(10);
        $defaultLanguage = $this->defaultLanguage;


        return view('admin.product.collection.index', compact('productCollections','defaultLanguage'));
    }

    public function add(Request $request)
    {


        return view('admin.product.collection.add',['defaultLanguage' => $this->defaultLanguage]);
    }

    public function store(ProductCollectionAddRequest $request)
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

        $parentID = ProductCollection::where('id',$parent)->first();



        $productCollection = ProductCollection::create([
            'status' => $status,
            'parent' => $parentID == null? 0 :$parentID->id,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Product\ProductCollection'):uniqueSlug($slug,'\App\Models\Product\ProductCollection'),
            'image' => str_replace(env('APP_URL'), '', $image),
        ]);


        foreach ($request->name as $key => $name):

            ProductCollectionTranslation::create([
                'name' => $name,
                'text' => $request->text[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'collection_id' => $productCollection->id,
                'language_id' => $key,
            ]);

        endforeach;

        return redirect()->route('admin.product.collection.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $productCollection = ProductCollection::where('id', $id)
            ->with('productsCollectionsTranslations')->first();


        $defaultLanguage = $this->defaultLanguage;

        return view('admin.product.collection.edit', compact('productCollection','defaultLanguage'));
    }

    public function update(ProductCollectionEditRequest $request)
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


        $parentID = ProductCollection::where('id',$parent)->first();

        if($id == $parent){
            $parentID = null;
        }



        $productCollection = ProductCollection::where('id', $id)->first();
        if($productCollection->slug != $slug){
            $productCollection->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')],'\App\Models\Product\ProductCollection'):uniqueSlug($slug,'\App\Models\Product\ProductCollection');
        }
        $productCollection->parent = $parentID == null? 0 :$parentID->id;
        $productCollection->status = $status;
        $productCollection->image = str_replace(env('APP_URL'), '', $image);
        $productCollection->updated_at = date('Y-m-d H:i:s');
        $productCollection->save();


        foreach ($request->name as $key => $name):
            ProductCollectionTranslation::where('collection_id', $id)
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
            $productCollectionTranslation = ProductCollectionTranslation::where('collection_id', $id)
                ->where('language_id', $key)->first();

            if(!$productCollectionTranslation){
                ProductCollectionTranslation::create([
                    'name' => $name,
                    'text' => $request->text[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'collection_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;

        //Eger parent ve id bir birine beraberdirse
        // mes: Electronic -> Notebook deyishib Notebook -> Electronic olursa
        $parentAndID = ProductCollection::where('id',$parent)
            ->where('parent',$id)
            ->first();

        if($parentAndID){
            $parentAndID->parent = 0;
            $parentAndID->save();
        }


        return redirect()->route('admin.product.collection.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;


        $productCollections = ProductCollection::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('products_collections_translations','products_collections.id','=','products_collections_translations.collection_id')
            ->orderBy('id', 'DESC')
            ->select(
                '*',
                'products_collections.updated_at as updated_at',
            )
            ->paginate(10);




        $defaultLanguage = $this->defaultLanguage;

        return view('admin.product.collection.search', compact('productCollections','defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $page = ProductCollection::where('id', $id)->first();
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
        $collection = ProductCollection::where('language_id',  $this->defaultLanguage)
            ->where('products_collections.id',$id)
            ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
            ->join('products_collections_lists','products_collections_lists.collection_id','=','products_collections.id')
            ->first();


        $error = '';
        $name = '';
        if(is_null($collection)){
            $error = null;
        }else{
            $name = $collection->name;
        }


        return response()->json(['success' => true,'error' => $error,'name' => $name], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        ProductCollection::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function allDeleteAjax(Request $request)
    {
        $ids = $request->IDs;
        foreach ($ids as $id):
            ProductCollection::where('id', $id)->delete();
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
