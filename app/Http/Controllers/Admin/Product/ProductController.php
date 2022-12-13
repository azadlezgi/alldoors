<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductAddRequest;
use App\Http\Requests\Product\ProductEditRequest;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Gallery\Gallery;
use App\Models\Option\Option;
use App\Models\Option\OptionGroup;
use App\Models\Option\OptionValue;
use App\Models\Product\ProductAttributeList;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCategoryList;
use App\Models\Language\Languages;
use App\Models\Product\Product;
use App\Models\Product\ProductCollection;
use App\Models\Product\ProductCollectionList;
use App\Models\Product\ProductManufacturer;
use App\Models\Product\ProductManufacturerList;
use App\Models\Product\ProductGalleryList;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductModelList;
use App\Models\Product\ProductOptionList;
use App\Models\Product\ProductSpecialPriceList;
use App\Models\Product\ProductTranslation;
use App\Services\CommonService;
use App\Services\PriceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
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

        $products = Product::with(array('productsTranlations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))
            ->with('productsCategories')
            ->with('productSpecialPriceList')
            ->where('parent', 0)
            ->orderBy('id', 'DESC')
            ->get();


        $product2 = [];
        foreach ($products as $key => $product):

            $product1 = Product::with(array('productsTranlations' => function ($query) {
                $query->where('language_id', $this->defaultLanguage);

            }))
                ->with('productsCategories')
                ->with('productSpecialPriceList')
                ->where('parent', $product['id'])
                ->orderBy('id', 'DESC')
                ->get();

            $product2[] = $products[$key];

            foreach ($product1 as $keyProduct => $item):
                $product2[] = $product1[$keyProduct];
            endforeach;


        endforeach;


        $products = $this->paginate($product2,3);



        $defaultLanguage = $this->defaultLanguage;


        return view('admin.product.index', compact('products', 'defaultLanguage'));
    }

    public function categories(Request $request)
    {

        $id = $request->id;

        $products = Product::with(array('productsTranlations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->where('products_categories_lists.category_id', $id)
            ->join('products_categories_lists', 'products_categories_lists.product_id', '=', 'products.id')
            ->orderBy('products.id', 'DESC')
            ->with('getProductModel')
            ->select('*', 'products.id as id')
            ->paginate(10);

        $category = ProductCategory::where('language_id', $this->defaultLanguage)
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->where('id', $id)
            ->first();


        $defaultLanguage = $this->defaultLanguage;


        return view('admin.product.category', compact('products', 'defaultLanguage', 'category'));

    }

    public function collections(Request $request)
    {

        $id = $request->id;

        $products = Product::with(array('productsTranlations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->where('products_collections_lists.collection_id', $id)
            ->join('products_collections_lists', 'products_collections_lists.product_id', '=', 'products.id')
            ->orderBy('products.id', 'DESC')
            ->with('getProductModel')
            ->select('*', 'products.id as id')
            ->paginate(10);

        $collection = ProductCollection::where('language_id', $this->defaultLanguage)
            ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
            ->where('id', $id)
            ->first();


        $defaultLanguage = $this->defaultLanguage;


        return view('admin.product.collection', compact('products', 'defaultLanguage', 'collection'));

    }

    public function models(Request $request)
    {

        $id = $request->id;

        $products = Product::with(array('productsTranlations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->where('products_models_lists.model_id', $id)
            ->join('products_models_lists', 'products_models_lists.product_id', '=', 'products.id')
            ->orderBy('products.id', 'DESC')
            ->with('productsCategories')
            ->select('*', 'products.id as id')
            ->paginate(10);

        $model = ProductModel::where('language_id', $this->defaultLanguage)
            ->join('products_models_translations', 'products_models_translations.model_id', '=', 'products_models.id')
            ->where('id', $id)
            ->first();


        $defaultLanguage = $this->defaultLanguage;


        return view('admin.product.model', compact('products', 'defaultLanguage', 'model'));

    }

    public function manufacturers(Request $request)
    {


        $id = $request->id;

        $products = Product::with(array('productsTranlations' => function ($query) {
            $query->where('language_id', $this->defaultLanguage);

        }))->where('products_manufacturers_lists.manufacturer_id', $id)
            ->join('products_manufacturers_lists', 'products_manufacturers_lists.product_id', '=', 'products.id')
            ->orderBy('products.id', 'DESC')
            ->with('productsCategories')
            ->with('getProductModel')
            ->select('*', 'products.id as id')
            ->paginate(10);


        $manufacturer = ProductManufacturer::where('language_id', $this->defaultLanguage)
            ->join('products_manufacturers_translations', 'products_manufacturers_translations.manufacturer_id', '=', 'products_manufacturers.id')
            ->where('id', $id)
            ->first();


        $defaultLanguage = $this->defaultLanguage;


        return view('admin.product.manufacturer', compact('products', 'defaultLanguage', 'manufacturer'));

    }

    public function add(Request $request)
    {

        $defaultLanguage = $this->defaultLanguage;

        $models = ProductModel::where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->where('status', 1)
            ->join('products_models_translations', 'products_models_translations.model_id', '=', 'products_models.id')
            ->get();

        $manufacturers = ProductManufacturer::where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->where('status', 1)
            ->join('products_manufacturers_translations', 'products_manufacturers_translations.manufacturer_id', '=', 'products_manufacturers.id')
            ->get();

        $productParent = Product::select(
            'id',
            'name',
        )
            ->join('products_translations', 'products.id', '=', 'products_translations.product_id')
            ->where('parent', 0)
            ->where('id', old('parent'))
            ->first();

        $productGallery = Gallery::select(
            'id',
            'name',
        )
            ->join('galleries_translations', 'galleries.id', '=', 'galleries_translations.gallery_id')
            ->where('id', old('gallery'))
            ->first();


        return view('admin.product.add', compact(
            'defaultLanguage',
            'models',
            'manufacturers',
            'productParent',
            'productGallery'
        ));
    }

    public function store(ProductAddRequest $request)
    {

        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;
        $parent = $request->parent;
        $model = $request->model;
        $gallery = $request->gallery;
        $price = $request->price;
        $length = $request->length;
        $width = $request->width;
        $height = $request->height;
        $specialPrice = $request->special_price;
        $startDate = $request->special_price_start_date;
        $endDate = $request->special_price_end_date;
        $manufacturer = $request->manufacturer;
        $categories = $request->categories;
        $collections = $request->collections;
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


        if (empty($specialPrice) && (!empty($startDate) || !empty($endDate))) {
            $this->validateCheck('error_status_special_price', 'Siz endirimli qiymət seçmədən başlama və ya bitmə tarixi seçdiniz.');
        }


        $this->validatorCheck->validate();


        $product = Product::create([
            'parent' => $parent,
            'status' => $status,
            'slug' => $slug == null ? uniqueSlug($request->name[cache('language-defaultID')], '\App\Models\Product\Product') : uniqueSlug($slug, '\App\Models\Product\Product'),
            'image' => str_replace(env('APP_URL'), '', $image),
            'images' => $images,
            'price' => PriceService::price($price),
            'length' => CommonService::doubleFormat($length),
            'width' => CommonService::doubleFormat($width),
            'height' => CommonService::doubleFormat($height),
        ]);


        if (!empty($specialPrice)) {

            $specialPriceStartDate = '';
            $specialPriceEndDate = '';

            if (!empty($endDate)) {
                $endDate = date_create($endDate);
                $specialPriceEndDate = date_format($endDate, "Y-m-d H:i:s");

            }

            if (!empty($startDate)) {
                $startDate = date_create($startDate);
                $specialPriceStartDate = date_format($startDate, "Y-m-d H:i:s");
            }


            ProductSpecialPriceList::create([
                'product_id' => $product->id,
                'special_price' => $specialPrice,
                'start_date' => $specialPriceStartDate,
                'end_date' => $specialPriceEndDate,
            ]);
        }


        /*   KATEQORIYA LIST   */
        foreach ($categories as $category):
            ProductCategoryList::create([
                'product_id' => $product->id,
                'category_id' => $category
            ]);
        endforeach;


        /*   KOLLEKSIYA LIST   */
        if (!empty($collections)) {
            foreach ($collections as $collection):
                ProductCollectionList::create([
                    'product_id' => $product->id,
                    'collection_id' => $collection
                ]);
            endforeach;
        }


        /*   MODEL LIST   */
        if (!empty($model)) {
            ProductModelList::create([
                'product_id' => $product->id,
                'model_id' => $model
            ]);
        }

        if (!empty($manufacturer)) {
            /*   DESTINATION LIST   */
            ProductManufacturerList::create([
                'product_id' => $product->id,
                'manufacturer_id' => $manufacturer
            ]);

        }

        /*   GALLERY LIST   */
        if (!empty($gallery)) {
            ProductGalleryList::create([
                'product_id' => $product->id,
                'gallery_id' => $gallery
            ]);
        }


        foreach ($request->name as $key => $name):

            ProductTranslation::create([
                'name' => $name,
                'sub_name' => $request->sub_name[$key],
                'text' => $request->text[$key],
                'short_text' => $request->short_text[$key],
                'price_table' => $request->price_table[$key],
                'title' => $request->title[$key],
                'keyword' => $request->keyword[$key],
                'description' => $request->description[$key],
                'product_id' => $product->id,
                'language_id' => $key,
            ]);

        endforeach;


        /*   PRODUCT ATTRIBUTE START   */
        if (!empty($request->attribute_list)) {


            $attributeID = '';
            foreach ($request->attribute_list as $item):
                foreach ($item as $attribute):

                    if (!is_array($attribute)) {
                        $attributeID = $attribute;
                    } else {
                        foreach ($attribute as $key => $item):


                            //Eger yoxdursa yaz
                            $checkProductList = ProductAttributeList::where('product_id', $product->id)
                                ->where('attribute_id', $attributeID)
                                ->where('language_id', $key)
                                ->first();


                            if (!$checkProductList) {

                                $checkLanguage = Languages::where('id', $key)->first();
                                $checkAttribute = Attribute::where('id', $attributeID)->first();

                                if ($checkLanguage && $checkAttribute) {
                                    ProductAttributeList::create([
                                        'product_id' => $product->id,
                                        'attribute_id' => $attributeID,
                                        'language_id' => $key,
                                        'name' => $item['text'],
                                    ]);
                                }

                            }


                        endforeach;
                    }
                endforeach;
            endforeach;
        }
        /*   PRODUCT ATTRIBUTE END   */


        /*   PRODUCT OPTION LIST START   */
        if ($request->option_list != null) {
            if (isset($request->option_list['option_value_id'])) {

                //IMAGE START
                if (isset($request->option_list['option_value_id']['image_and_text']) && $request->option_list['option_value_id']['image_and_text'] != null) {

                    //Option ID yalniz tipi bir olanlar ve array ichinde position (array hazirla)
                    foreach ($request->option_list['option_type'] as $key => $optionType):
                        if ($optionType == 1) {
                            $arrayOptionID[] = $request->option_list['option_id'][$key];
                        }
                    endforeach;


                    foreach ($arrayOptionID as $keyOption => $optionID):
                        //Position
                        $positionOption = array_search($optionID, $request->option_list['option_id']) + 1;


                        if (isset(array_values($request->option_list['option_value_id']['image_and_text'])[$keyOption])) {
                            $arrayOptionValueIDs = array_values($request->option_list['option_value_id']['image_and_text'])[$keyOption];
                            $arrayOptionImages = array_values($request->option_list['image']['image_and_text'])[$keyOption];
                            $arrayOptionPrice = array_values($request->option_list['price']['image_and_text'])[$keyOption];
                            $arrayOptionSort = array_values($request->option_list['sort']['image_and_text'])[$keyOption];


                            foreach ($arrayOptionValueIDs as $optionValueKey => $optionValueID):
                                $optionImage = $arrayOptionImages[$optionValueKey] == null ? '' : $arrayOptionImages[$optionValueKey];
                                $optionPrice = $arrayOptionPrice[$optionValueKey] == null ? '' : $arrayOptionPrice[$optionValueKey];
                                $optionSort = $arrayOptionSort[$optionValueKey] == null ? '' : $arrayOptionSort[$optionValueKey];

                                ProductOptionList::create([
                                    'product_id' => $product->id,
                                    'option_id' => $optionID,
                                    'option_value_id' => $optionValueID,
                                    'image' => str_replace(env('APP_URL'), '', $optionImage),
                                    'price' => $optionPrice,
                                    'option_sort' => $positionOption,
                                    'sort' => $optionSort,
                                ]);

                            endforeach;
                        }


                    endforeach;

                }
                //IMAGE END

                //TEXT START
                if (isset($request->option_list['option_value_id']['text']) && $request->option_list['option_value_id']['text'] != null) {

                    //Option ID yalniz tipi iki olanlar ve array ichinde position (array hazirla)
                    foreach ($request->option_list['option_type'] as $key => $optionType):
                        if ($optionType == 2) {
                            $arrayOptionIDs[] = $request->option_list['option_id'][$key];
                        }
                    endforeach;


                    foreach ($arrayOptionIDs as $keyOption => $optionID):
                        //Position
                        $positionOption = array_search($optionID, $request->option_list['option_id']) + 1;

                        if (isset(array_values($request->option_list['option_value_id']['text'])[$keyOption])) {
                            $arrayOptionValueIDs = array_values($request->option_list['option_value_id']['text'])[$keyOption];
                            $arrayOptionPrice = array_values($request->option_list['price']['text'])[$keyOption];
                            $arrayOptionSort = array_values($request->option_list['sort']['text'])[$keyOption];


                            foreach ($arrayOptionValueIDs as $optionValueKey => $optionValueID):
                                $optionPrice = $arrayOptionPrice[$optionValueKey] == null ? '' : $arrayOptionPrice[$optionValueKey];
                                $optionSort = $arrayOptionSort[$optionValueKey] == null ? '' : $arrayOptionSort[$optionValueKey];


                                ProductOptionList::create([
                                    'product_id' => $product->id,
                                    'option_id' => $optionID,
                                    'option_value_id' => $optionValueID,
                                    'image' => '',
                                    'price' => $optionPrice,
                                    'option_sort' => $positionOption,
                                    'sort' => $optionSort,
                                ]);


                            endforeach;
                        }


                    endforeach;


                }
                //TEXT END

            }
        }
        /*   PRODUCT OPTION LIST END   */

        return redirect()->route('admin.product.index');


    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $checkAttributes = [];
        $attributes = Attribute::join('attributes_groups', 'attributes_groups.id', '=', 'attributes.attribute_group_id')
            ->select(
                'attributes.id as attributesID',
            )
            ->where('attributes_groups.status', 1)
            ->where('attributes.status', 1)
            ->get();


        foreach ($attributes as $attribute):
            $checkAttributes[] = $attribute->attributesID;
        endforeach;


        $product = Product::where('id', $id)
            ->with('productsTranlations')
            ->with('productsCategories')
            ->with('productsCollections')
            ->with('getProductModel')
            ->with('getProductGallery')
            ->with('getProductManufacturer')
            ->with('productSpecialPriceList')
            ->with(['getProductAttributeList' => function ($query) use ($checkAttributes) {
                $query->where('language_id', $this->defaultLanguage);
                $query->whereIn('attribute_id', $checkAttributes);
            }])
            ->with('getProductAttributeListAll')
            ->first();

        if ($product->productSpecialPriceList != null) {

            if (!empty($product->productSpecialPriceList['special_price'])) {

                if (!empty($product->productSpecialPriceList['start_date'])) {
                    $startDate = date_create($product->productSpecialPriceList['start_date']);
                    $product->productSpecialPriceList['start_date'] = date_format($startDate, "d.m.Y H:i");
                }


                if (!empty($product->productSpecialPriceList['end_date'])) {
                    $endDate = date_create($product->productSpecialPriceList['end_date']);
                    $product->productSpecialPriceList['end_date'] = date_format($endDate, "d.m.Y H:i");
                }

            } else {
                $product->productSpecialPriceList['start_date'] = '';
                $product->productSpecialPriceList['end_date'] = '';

            }

        }


        $defaultLanguage = $this->defaultLanguage;


        $selectCategories = [];
        foreach ($product->productsCategories as $productsCategory):
            $selectCategories[] = $productsCategory->category_id;
        endforeach;


        $selectCollections = [];
        foreach ($product->productsCollections as $productsCollection):
            $selectCollections[] = $productsCollection->collection_id;
        endforeach;


        $models = ProductModel::where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->where('status', 1)
            ->join('products_models_translations', 'products_models_translations.model_id', '=', 'products_models.id')
            ->get();


        $manufacturers = ProductManufacturer::where('language_id', $defaultLanguage)
            ->orderBy('name', 'ASC')
            ->where('status', 1)
            ->join('products_manufacturers_translations', 'products_manufacturers_translations.manufacturer_id', '=', 'products_manufacturers.id')
            ->get();


        $options = ProductOptionList::where('product_id', $id)
            ->join('options', function ($join) {
                $join->on('options.id', '=', 'products_options_lists.option_id');
            })
            ->join('options_translations', function ($join) use ($defaultLanguage) {
                $join->on('options.id', '=', 'options_translations.option_id')
                    ->where('language_id', $defaultLanguage);
            })
            ->select(
                '*',
                'products_options_lists.id as product_option_list_id',
                'products_options_lists.sort as sort',
            )
            ->orderBy('products_options_lists.option_sort', 'ASC')
            ->groupBy('products_options_lists.option_id')
            ->get();


        $optionsValues = ProductOptionList::where('product_id', $id)
            ->join('options', function ($join) {
                $join->on('options.id', '=', 'products_options_lists.option_id');
            })
            ->join('options_translations', function ($join) use ($defaultLanguage) {
                $join->on('options.id', '=', 'options_translations.option_id')
                    ->where('language_id', $defaultLanguage);
            })
            ->select(
                '*',
                'products_options_lists.id as product_option_list_id',
                'products_options_lists.sort as sort',
            )
            ->orderBy('products_options_lists.option_sort', 'ASC')
            ->orderBy('products_options_lists.sort', 'ASC')
            ->get();


        $optionValuesData = OptionValue::where('language_id', $defaultLanguage)
            ->join('options_values_translations', 'options_values.id', '=', 'options_values_translations.option_value_id')
            ->orderBy('sort', 'ASC')
            ->get();

        $productParent = Product::select(
            'id',
            'name',
        )
            ->join('products_translations', 'products.id', '=', 'products_translations.product_id')
            ->where('parent', 0)
            ->where('id', old('parent', $product->parent))
            ->first();

        $productGallery = Gallery::select(
            'id',
            'name',
        )
            ->join('galleries_translations', 'galleries.id', '=', 'galleries_translations.gallery_id')
            ->where('id', old('gallery', $product->getProductGallery == null ? 0 : $product->getProductGallery['gallery_id']))
            ->first();


        return view('admin.product.edit', compact(
            'product',
            'defaultLanguage',
            'selectCategories',
            'selectCollections',
            'models',
            'manufacturers',
            'options',
            'optionsValues',
            'optionValuesData',
            'productParent',
            'productGallery',
        ));
    }

    public function update(ProductEditRequest $request)
    {
        $id = $request->id;
        $parent = $request->parent;
        $status = $request->status;
        $image = $request->image;
        $slug = $request->slug;
        $model = $request->model;
        $gallery = $request->gallery;
        $price = $request->price;
        $length = $request->length;
        $width = $request->width;
        $height = $request->height;
        $specialPrice = $request->special_price;
        $startDate = $request->special_price_start_date;
        $endDate = $request->special_price_end_date;
        $manufacturer = $request->manufacturer;
        $categories = $request->categories;
        $collections = $request->collections;
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


        if (empty($specialPrice) && (!empty($startDate) || !empty($endDate))) {
            $this->validateCheck('error_status_special_price', 'Siz endirimli qiymət seçmədən başlama və ya bitmə tarixi seçdiniz.');
        }


        $this->validatorCheck->validate();


        $product = Product::where('id', $id)->first();
        if ($product->slug != $slug) {
            $product->slug = $slug == null ? uniqueSlug($request->name[cache('language-defaultID')], '\App\Models\Product\Product') : uniqueSlug($slug, '\App\Models\Product\Product');
        }
        $product->parent = $parent;
        $product->status = $status;
        $product->image = str_replace(env('APP_URL'), '', $image);
        $product->images = $images;
        $product->price = PriceService::price($price);
        $product->length = CommonService::doubleFormat($length);
        $product->width = CommonService::doubleFormat($width);
        $product->height = CommonService::doubleFormat($height);
        $product->updated_at = date('Y-m-d H:i:s');
        $product->save();


        //once sil sonra yeniden kateqoriyalari elave et
        ProductCategoryList::where('product_id', $id)
            ->delete();

        foreach ($categories as $category):
            ProductCategoryList::create([
                'product_id' => $product->id,
                'category_id' => $category
            ]);
        endforeach;


        //once sil sonra yeniden special price elave et
        ProductSpecialPriceList::where('product_id', $id)
            ->delete();


        if (!empty($specialPrice)) {

            $specialPriceStartDate = '';
            $specialPriceEndDate = '';

            if (!empty($endDate)) {
                $endDate = date_create($endDate);
                $specialPriceEndDate = date_format($endDate, "Y-m-d H:i:s");

            }

            if (!empty($startDate)) {
                $startDate = date_create($startDate);
                $specialPriceStartDate = date_format($startDate, "Y-m-d H:i:s");
            }


            ProductSpecialPriceList::create([
                'product_id' => $product->id,
                'special_price' => $specialPrice,
                'start_date' => $specialPriceStartDate,
                'end_date' => $specialPriceEndDate,
            ]);
        }


        //once sil sonra yeniden kollekciyalari elave et
        ProductCollectionList::where('product_id', $id)
            ->delete();

        if (!empty($collections)) {
            foreach ($collections as $collection):
                ProductCollectionList::create([
                    'product_id' => $product->id,
                    'collection_id' => $collection
                ]);
            endforeach;
        }


        //once sil sonra yeniden model elave et
        ProductModelList::where('product_id', $id)
            ->delete();

        /*   MODEL LIST   */
        if (!empty($model)) {
            ProductModelList::create([
                'product_id' => $product->id,
                'model_id' => $model
            ]);
        }


        //once sil sonra yeniden manufacturer elave et
        ProductManufacturerList::where('product_id', $id)
            ->delete();

        if (!empty($manufacturer)) {
            /*   MODEL LIST   */
            ProductManufacturerList::create([
                'product_id' => $product->id,
                'manufacturer_id' => $manufacturer
            ]);
        }


        //once sil sonra yeniden gallery elave et
        ProductGalleryList::where('product_id', $id)
            ->delete();

        /*   GALLERY LIST   */
        if (!empty($gallery)) {
            ProductGalleryList::create([
                'product_id' => $product->id,
                'gallery_id' => $gallery
            ]);
        }


        foreach ($request->name as $key => $name):
            ProductTranslation::where('product_id', $id)
                ->where('language_id', $key)
                ->update([
                    'name' => $name,
                    'sub_name' => $request->sub_name[$key],
                    'text' => $request->text[$key],
                    'short_text' => $request->short_text[$key],
                    'price_table' => $request->price_table[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'language_id' => $key,
                ]);


            //Eger yeni dil elave olunubsa bura ishleyecek.
            //Cunki databasede hemen tablede bele bir dil yoxdur update etmediyi ucun create etmelidir
            $productTranslation = ProductTranslation::where('product_id', $id)
                ->where('language_id', $key)->first();

            if (!$productTranslation) {
                ProductTranslation::create([
                    'name' => $name,
                    'sub_name' => $request->sub_name[$key],
                    'text' => $request->text[$key],
                    'short_text' => $request->short_text[$key],
                    'price_table' => $request->price_table[$key],
                    'title' => $request->title[$key],
                    'keyword' => $request->keyword[$key],
                    'description' => $request->description[$key],
                    'product_id' => $id,
                    'language_id' => $key,
                ]);
            }

        endforeach;


        /*   PRODUCT ATTRIBUTE START   */

        //once sil sonra yeniden manufacturer elave et
        ProductAttributeList::where('product_id', $id)
            ->delete();

        if (!empty($request->attribute_list)) {


            $attributeID = '';
            foreach ($request->attribute_list as $item):
                foreach ($item as $attribute):

                    if (!is_array($attribute)) {
                        $attributeID = $attribute;
                    } else {
                        foreach ($attribute as $key => $item):


                            //Eger yoxdursa yaz
                            $checkProductList = ProductAttributeList::where('product_id', $product->id)
                                ->where('attribute_id', $attributeID)
                                ->where('language_id', $key)
                                ->first();

                            if (!$checkProductList) {

                                $checkLanguage = Languages::where('id', $key)->first();
                                $checkAttribute = Attribute::where('id', $attributeID)->first();

                                if ($checkLanguage && $checkAttribute) {
                                    ProductAttributeList::create([
                                        'product_id' => $product->id,
                                        'attribute_id' => $attributeID,
                                        'language_id' => $key,
                                        'name' => $item['text'],
                                    ]);
                                }

                            }


                        endforeach;
                    }
                endforeach;
            endforeach;
        }
        /*   PRODUCT ATTRIBUTE END   */


        /*   PRODUCT OPTION LIST START   */

        //Once sil sonra hamsini elave et
//        @dd($request->option_list);
        ProductOptionList::where('product_id', $id)
            ->delete();

        if ($request->option_list != null) {
            if (isset($request->option_list['option_value_id'])) {

                //IMAGE START
                if (isset($request->option_list['option_value_id']['image_and_text']) && $request->option_list['option_value_id']['image_and_text'] != null) {

                    //Option ID yalniz tipi bir olanlar ve array ichinde position (array hazirla)
                    foreach ($request->option_list['option_type'] as $key => $optionType):
                        if ($optionType == 1) {
                            $arrayOptionID[] = $request->option_list['option_id'][$key];
                        }
                    endforeach;


                    foreach ($arrayOptionID as $keyOption => $optionID):
                        //Position
                        $positionOption = array_search($optionID, $request->option_list['option_id']) + 1;


                        if (isset(array_values($request->option_list['option_value_id']['image_and_text'])[$keyOption])) {
                            $arrayOptionValueIDs = array_values($request->option_list['option_value_id']['image_and_text'])[$keyOption];
                            $arrayOptionImages = array_values($request->option_list['image']['image_and_text'])[$keyOption];
                            $arrayOptionPrice = array_values($request->option_list['price']['image_and_text'])[$keyOption];
                            $arrayOptionSort = array_values($request->option_list['sort']['image_and_text'])[$keyOption];


                            foreach ($arrayOptionValueIDs as $optionValueKey => $optionValueID):
                                $optionImage = $arrayOptionImages[$optionValueKey] == null ? '' : $arrayOptionImages[$optionValueKey];
                                $optionPrice = $arrayOptionPrice[$optionValueKey] == null ? '' : $arrayOptionPrice[$optionValueKey];
                                $optionSort = $arrayOptionSort[$optionValueKey] == null ? '' : $arrayOptionSort[$optionValueKey];

                                ProductOptionList::create([
                                    'product_id' => $product->id,
                                    'option_id' => $optionID,
                                    'option_value_id' => $optionValueID,
                                    'image' => str_replace(env('APP_URL'), '', $optionImage),
                                    'price' => $optionPrice,
                                    'option_sort' => $positionOption,
                                    'sort' => $optionSort,
                                ]);

                            endforeach;
                        }


                    endforeach;

                }
                //IMAGE END

                //TEXT START
                if (isset($request->option_list['option_value_id']['text']) && $request->option_list['option_value_id']['text'] != null) {

                    //Option ID yalniz tipi iki olanlar ve array ichinde position (array hazirla)
                    foreach ($request->option_list['option_type'] as $key => $optionType):
                        if ($optionType == 2) {
                            $arrayOptionIDs[] = $request->option_list['option_id'][$key];
                        }
                    endforeach;


                    foreach ($arrayOptionIDs as $keyOption => $optionID):
                        //Position
                        $positionOption = array_search($optionID, $request->option_list['option_id']) + 1;

                        if (isset(array_values($request->option_list['option_value_id']['text'])[$keyOption])) {
                            $arrayOptionValueIDs = array_values($request->option_list['option_value_id']['text'])[$keyOption];
                            $arrayOptionPrice = array_values($request->option_list['price']['text'])[$keyOption];
                            $arrayOptionSort = array_values($request->option_list['sort']['text'])[$keyOption];


                            foreach ($arrayOptionValueIDs as $optionValueKey => $optionValueID):
                                $optionPrice = $arrayOptionPrice[$optionValueKey] == null ? '' : $arrayOptionPrice[$optionValueKey];
                                $optionSort = $arrayOptionSort[$optionValueKey] == null ? '' : $arrayOptionSort[$optionValueKey];


                                ProductOptionList::create([
                                    'product_id' => $product->id,
                                    'option_id' => $optionID,
                                    'option_value_id' => $optionValueID,
                                    'image' => '',
                                    'price' => $optionPrice,
                                    'option_sort' => $positionOption,
                                    'sort' => $optionSort,
                                ]);


                            endforeach;
                        }


                    endforeach;


                }
                //TEXT END

            }
        }

        /*   PRODUCT OPTION LIST END   */


        return redirect()->route('admin.product.index');


    }

    public function search(Request $request)
    {
        $search = $request->search;

        $products = Product::where('language_id', $this->defaultLanguage)
            ->where('name', 'like', '%' . $search . '%')
            ->join('products_translations', 'products.id', '=', 'products_translations.product_id')
            ->orderBy('id', 'DESC')
            ->with('productsCategories')
            ->select(
                '*',
                'products.updated_at as updated_at',
            )
            ->paginate(10);

        $defaultLanguage = $this->defaultLanguage;


        return view('admin.product.search', compact('products', 'defaultLanguage'));
    }


    public function statusAjax(Request $request)
    {
        $id = intval($request->id);
        $statusActive = intval($request->statusActive);

        $product = Product::where('id', $id)->first();
        $data = '';
        $success = '';

        if ($product) {
            $product->status = $statusActive;
            $product->save();

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
        Product::where('id', $id)
            ->first();

        return response()->json(['success' => true], 200);

    }

    public function delete(Request $request)
    {

        $id = intval($request->id);

        Product::where('id', $id)->delete();

        return response()->json(['success' => true], 200);

    }


    public function getAttributeAjax(Request $request)
    {

        $search = $request->search;

        $attributes = Attribute::where('language_id', $this->defaultLanguage)
            ->where('status', 1)
            ->join('attributes_translations', 'attributes.id', '=', 'attributes_translations.attribute_id')
            ->orderBy('attributes.sort', 'ASC')
            ->where('attributes_translations.name', 'like', '%' . $search . '%')
            ->get();


        $attributeGroups = AttributeGroup::where('language_id', $this->defaultLanguage)
            ->where('status', 1)
            ->join('attributes_groups_translations', 'attributes_groups.id', '=', 'attributes_groups_translations.attribute_group_id')
            ->orderBy('attributes_groups.sort', 'ASC')
            ->get();


        $checkAttributeGroupList = [];
        foreach ($attributes as $item):
            $checkAttributeGroupList[] = $item->attribute_group_id;
        endforeach;


        $attributes = view('admin.product.attribute-add.attribute',
            compact(
                'attributes',
                'attributeGroups',
                'checkAttributeGroupList'
            ))->render();


        return response()->json(['success' => true, 'attributes' => $attributes], 200);

    }

    public function getAttributeAddAjax(Request $request)
    {

        $attributesAdd = view('admin.product.attribute-add.add-attribute')->render();

        return response()->json(['success' => true, 'attributes' => $attributesAdd], 200);

    }


    public function getOptionAjax(Request $request)
    {

        $search = $request->search;
        $optionsID = $request->optionInputValues;

        $options = Option::where('language_id', $this->defaultLanguage)
            ->where('status', 1)
            ->whereNotIn('id', $optionsID == null ? [] : $optionsID)
            ->join('options_translations', 'options.id', '=', 'options_translations.option_id')
            ->orderBy('options.sort', 'ASC')
            ->where('options_translations.name', 'like', '%' . $search . '%')
            ->get();


        $optionGroups = OptionGroup::where('language_id', $this->defaultLanguage)
            ->where('status', 1)
            ->join('options_groups_translations', 'options_groups.id', '=', 'options_groups_translations.option_group_id')
            ->orderBy('options_groups.sort', 'ASC')
            ->get();


        $checkOptionGroupList = [];
        foreach ($options as $item):
            $checkOptionGroupList[] = $item->option_group_id;
        endforeach;


        $options = view('admin.product.option-add.option',
            compact(
                'options',
                'optionGroups',
                'checkOptionGroupList'
            ))->render();


        return response()->json(['success' => true, 'options' => $options], 200);

    }


    public function getOptionAddAjax(Request $request)
    {
        $tabContentID = $request->tabContentID;

        $optionsValue = OptionValue::where('language_id', $this->defaultLanguage)
            ->where('option_id', $request->optionID)
            ->join('options_values_translations', 'options_values.id', '=', 'options_values_translations.option_value_id')
            ->orderBy('sort', 'ASC')
            ->get();

        $optionData = Option::where('id', $request->optionID)->first();

        $optionsAdd = view('admin.product.option-add.add-option', compact('optionsValue', 'optionData', 'tabContentID'))->render();

        return response()->json(['success' => true, 'options' => $optionsAdd], 200);

    }


    public function getProductParent(Request $request)
    {

        $q = $request->q ?? '';
        $productID = (int)$request->product_id ?? 0;
        $parentID = (int)$request->parent_id ?? 0;
        $json['results'][] = [
            'id' => 0,
            'text' => '-=Seç=-'
        ];

        if ($parentID > 0) {
            $parentProductOnly = Product::select(
                'id',
                'name',
            )
                ->join('products_translations', 'products.id', '=', 'products_translations.product_id')
                ->where('language_id', $this->defaultLanguage)
                ->where('id', $parentID)
                ->first();
            if ($parentProductOnly != null) {
                $json['results'][] = [
                    'id' => $parentProductOnly->id,
                    'text' => $parentProductOnly->name
                ];
            }
        }


        $productParent = Product::select(
            'id',
            'name',
        )
            ->join('products_translations', 'products.id', '=', 'products_translations.product_id')
            ->where('parent', 0)
            ->where('id', '!=', $productID)
            ->where('id', '!=', $parentID)
            ->where('language_id', $this->defaultLanguage)
            ->where('name', 'like', $q . '%')
            ->orderBy('name', 'ASC')
            ->limit(5)
            ->get();
        if ($productParent != null) {
            foreach ($productParent as $item):
                $json['results'][] = [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            endforeach;
        }


        return response()->json($json, 200);

    }


    public function getProductGallery(Request $request)
    {

        $q = $request->q ?? '';
        $galleryID = (int)$request->gallery_id ?? 0;
        $json['results'][] = [
            'id' => 0,
            'text' => '-=Seç=-'
        ];

        if ($galleryID > 0) {
            $galleryProductOnly = Gallery::select(
                'id',
                'name',
            )
                ->join('galleries_translations', 'galleries.id', '=', 'galleries_translations.gallery_id')
                ->where('language_id', $this->defaultLanguage)
                ->where('id', $galleryID)
                ->first();
            if ($galleryProductOnly != null) {
                $json['results'][] = [
                    'id' => $galleryProductOnly->id,
                    'text' => $galleryProductOnly->name
                ];
            }
        }


        $productGallery = Gallery::select(
            'id',
            'name',
        )
            ->join('galleries_translations', 'galleries.id', '=', 'galleries_translations.gallery_id')
            ->where('id', '!=', $galleryID)
            ->where('language_id', $this->defaultLanguage)
            ->where('name', 'like', $q . '%')
            ->orderBy('name', 'ASC')
            ->limit(5)
            ->get();
        if ($productGallery != null) {
            foreach ($productGallery as $item):
                $json['results'][] = [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            endforeach;
        }


        return response()->json($json, 200);

    }


    public function paginate($items, $perPage = 1, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    public function validateCheck($inputName, $text)
    {
        $this->validatorCheck->after(function ($validator) use ($inputName, $text) {
            $validator->errors()->add($inputName, $text);
        });
    }
}
