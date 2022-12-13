<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Services\CategoriesService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request, $categorySlug = null)
    {
        $fullCategorySlug = $categorySlug;


        if (!is_null($categorySlug) && strpos($categorySlug, "/")) {
            $slug_array = explode("/", $categorySlug);
            $categorySlug = $slug_array[(count($slug_array) - 1)];
        }

        $categories = "";
        $products = '';
        $productcCount = '';
        $category = '';
        if ($categorySlug != null) {

            $category = ProductCategory::where('language_id',  $request->languageID)
                ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
                ->where('slug', $categorySlug)
                ->with('getProductsCount')
                ->where('status', 1)
                ->first();



            if ($category) {
                $categories = ProductCategory::where('language_id', $request->languageID)
                    ->with('getProductsCount')
                    ->orderBy('id', 'DESC')
                    ->where('status', 1)
                    ->where('parent', $category->id)
                    ->join('products_categories_translations', 'products_categories_translations.category_id', '=', 'products_categories.id')
                    ->get();



                $products = Product::with(array('productsTranlations' => function ($query) use($request) {
                    $query->where('language_id', $request->languageID);

                })) ->with('productsCategoriesCheck')
                    ->where('products_categories_lists.category_id', $category->id)
                    ->join('products_categories_lists', 'products_categories_lists.product_id', '=', 'products.id')
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


        $categoryName = $category->name;



        return view('frontend.product.category.index', compact(
            'categories',
            'fullCategorySlug',
            'products',
            'category',
            'categoryName',
        ));


    }



    public function detail(Request $request,$categorySlug = null)
    {

        $fullCategorySlug = $categorySlug;

        if (!is_null($categorySlug) && strpos($categorySlug, "/")) {
            $slug_array = explode("/", $categorySlug);
            $lastSlug = $slug_array[(count($slug_array) - 1)];

        }else{
            $lastSlug = $categorySlug;
        }


        $slug = $lastSlug;
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->with(['productsTranlations' => function ($query) use ($request) {
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


        return view('frontend.product.category.detail', compact(
            'product',
            'attributes',
            'attributeGroups',
            'checkAttributeGroupList',
            'fullCategorySlug'
        ));



    }

}
