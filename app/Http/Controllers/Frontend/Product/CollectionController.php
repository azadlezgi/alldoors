<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Product\Product;
use App\Models\Product\ProductCollection;
use App\Services\CollectionsService;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public function index(Request $request, $collectionSlug = null)
    {
        $fullCollectionSlug = $collectionSlug;


        if (!is_null($collectionSlug) && strpos($collectionSlug, "/")) {
            $slug_array = explode("/", $collectionSlug);
            $collectionSlug = $slug_array[(count($slug_array) - 1)];
        }

        $collections = "";
        $products = '';
        $productcCount = '';
        $collection = '';
        if ($collectionSlug != null) {

            $collection = ProductCollection::where('language_id',  $request->languageID)
                ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
                ->where('slug', $collectionSlug)
                ->with('getProductsCount')
                ->where('status', 1)
                ->first();



            if ($collection) {
                $collections = ProductCollection::where('language_id', $request->languageID)
                    ->with('getProductsCount')
                    ->orderBy('id', 'DESC')
                    ->where('status', 1)
                    ->where('parent', $collection->id)
                    ->join('products_collections_translations', 'products_collections_translations.collection_id', '=', 'products_collections.id')
                    ->get();



                $products = Product::with(array('productsTranslations' => function ($query) use($request) {
                    $query->where('language_id', $request->languageID);

                })) ->with('productsCollectionsCheck')
                    ->where('products_collections_lists.collection_id', $collection->id)
                    ->join('products_collections_lists', 'products_collections_lists.product_id', '=', 'products.id')
                    ->orderBy('products.id', 'DESC')
                    ->select('*', 'products.id as id')
                    ->where('status', 1)
                    ->paginate(10);



            }else{
                abort(404);
            }


        } else {
            abort(404);
        }


        $collectionName = $collection->name;



        return view('frontend.product.collection.index', compact(
            'collections',
            'fullCollectionSlug',
            'products',
            'collection',
            'collectionName',
        ));


    }



    public function detail(Request $request,$collectionSlug = null)
    {

        $fullCollectionSlug = $collectionSlug;

        if (!is_null($collectionSlug) && strpos($collectionSlug, "/")) {
            $slug_array = explode("/", $collectionSlug);
            $lastSlug = $slug_array[(count($slug_array) - 1)];

        }else{
            $lastSlug = $collectionSlug;
        }


        $slug = $lastSlug;
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->with(['productsTranslations' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }])
            ->with('productsCollectionsCheck')
            ->with('getProductModel')
            ->with('getProductDestination')
            ->with(['getProductAttributeList' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }])
            ->with('getProductAttributeListAll')
            ->first();





        if (!$product || count($product->productsCollectionsCheck) == 0) {
            abort(404);
        }


        /*   ATTRIBUTES START   */


        $attributes = Attribute::where('attributes_translations.language_id', $request->languageID)
            ->where('status', 1)
            ->join('attributes_translations', 'attributes.id', '=', 'attributes_translations.attribute_id')
            ->join('products_attributes_lists', 'attributes.id', '=', 'products_attributes_lists.attribute_id')
            ->orderBy('attributes.sort', 'ASC')
            ->where('products_attributes_lists.product_id', $product->id)
            ->where('products_attributes_lists.language_id', $request->languageID)
            ->select('*', 'attributes_translations.name as attributes_translations_name')
            ->get();


        $attributeGroups = AttributeGroup::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('attributes_groups_translations', 'attributes_groups.id', '=', 'attributes_groups_translations.attribute_group_id')
            ->orderBy('attributes_groups.sort', 'ASC')
            ->get();


        $checkAttributeGroupList = [];
        foreach ($attributes as $item):
            $checkAttributeGroupList[] = $item->attribute_group_id;
        endforeach;

        /*   ATTRIBUTES END   */


        return view('frontend.product.collection.detail', compact(
            'product',
            'attributes',
            'attributeGroups',
            'checkAttributeGroupList',
            'fullCollectionSlug'
        ));



    }

}
