<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function index(Request $request)
    {
        $products = Product::with(array('productsTranslations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('productsCategoriesCheck')
            ->join('products_categories_lists', 'products_categories_lists.product_id', '=', 'products.id')
            ->join('products_categories', function ($join) {
                $join->on('products_categories_lists.category_id', '=', 'products_categories.id')->where('products_categories.status', 1);
            })
            ->select(
                'products.id as id',
                'products.image as image',
                'products.images as images',
                'products.slug as slug',
                'products.price as price',
                'products.status as status',
                'products.created_at as created_at',
                'products.updated_at as updated_at',
            )
            ->where('products.status', 1)
            ->groupBy('products_categories_lists.product_id')
            ->orderBy('id', 'DESC')
            ->paginate(10);





        $categories = ProductCategory::where('language_id', $request->languageID)
//            ->with('getProductsCount')
            ->orderBy('id', 'DESC')
            ->where('parent', 0)
            ->where('status', 1)
            ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
            ->get();




        return view('frontend.product.index', compact(
            'products',
            'categories',
        ));
    }


    public function search(Request $request)
    {
        $products = Product::with('productsCategoriesCheck')
            ->join('products_translations', function ($join) use($request){
                $join->on('products_translations.product_id', '=', 'products.id')
                ->where('language_id', $request->languageID)
                    ->where('name', 'like', '%' . $request->search . '%');;
            })
            ->join('products_categories_lists', 'products_categories_lists.product_id', '=', 'products.id')
            ->join('products_categories', function ($join) {
                $join->on('products_categories_lists.category_id', '=', 'products_categories.id')->where('products_categories.status', 1);
            })
            ->select(
                'products.id as id',
                'products.image as image',
                'products.images as images',
                'products.slug as slug',
                'products.price as price',
                'products.status as status',
                'products.created_at as created_at',
                'products.updated_at as updated_at',
            )
            ->where('products.status', 1)
            ->groupBy('products_categories_lists.product_id')
            ->orderBy('id', 'DESC')
            ->paginate(10);




        return view('frontend.product.search', compact(
            'products',
        ));
    }



    public function detail(Request $request)
    {

        $slug = $request->slug;
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->with(['productsTranslations' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }])
            ->with('productsCategoriesCheck')
            ->with('getProductModel')
            ->with('getProductDestination')
            ->with(['getProductAttributeList' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }])
            ->with('getProductAttributeListAll')
            ->first();

        if (!$product || count($product->productsCategoriesCheck) == 0) {
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




        return view('frontend.product.detail', compact(
            'product',
            'attributes',
            'attributeGroups',
            'checkAttributeGroupList',
        ));

    }


}
