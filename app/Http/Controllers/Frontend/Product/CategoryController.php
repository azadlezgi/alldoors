<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Option\Option;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Services\CategoriesService;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request, $categorySlug = null)
    {


        return view('frontend.product.category.index', compact());


    }


    public function detail(Request $request)
    {

        $slug = stripinput($request->slug);

        $category = ProductCategory::where('slug', $slug)
            ->join('products_categories_translations', 'products_categories.id', '=', 'products_categories_translations.category_id')
            ->first();


        if ($category == null) {
            abort(404);
        }


        $products = Product::where('products_categories_lists.category_id', (int)$category->id)
            ->join('products_translations', 'products.id', '=', 'products_translations.product_id')
            ->join('products_categories_lists', 'products.id', '=', 'products_categories_lists.product_id')
            ->where('products.status', 1)
            ->groupBy('products.id')
            ->orderBy('products.id', 'DESC')
            ->paginate(12);
        if ($products) {
            foreach ($products as $product_index => $product) {

                $product->image = $product->image ? $product->image : '/storage/no-image.png';
                $product->image = ImageService::customImageSize($product->image, 204, 305, 100);

                $product->attributes = [];
                $attributes = Attribute::where('attributes_translations.language_id', $request->languageID)
                    ->where('status', 1)
                    ->join('attributes_translations', 'attributes.id', '=', 'attributes_translations.attribute_id')
                    ->join('products_attributes_lists', 'attributes.id', '=', 'products_attributes_lists.attribute_id')
                    ->orderBy('attributes.sort', 'ASC')
                    ->where('products_attributes_lists.product_id', $product->id)
                    ->where('products_attributes_lists.language_id', $request->languageID)
                    ->select('*', 'attributes_translations.name as attributes_translations_name')
                    ->get();
                if ($attributes) {
                    $product->attributes = $attributes;
                }


                $product->options = [];
                $options = Option::select(
                        'options.id as option_id',
                        'options_translations.name as option_name',
                        'options.type as option_type',
                        'options_values.id as option_value_id',
                        'options_values.image as option_value_image',
                        'options_values_translations.text as option_value_text'
                    )
                    ->join('options_translations', function ($q) use ($request) {
                        $q->on('options.id', '=', 'options_translations.option_id')
                            ->where('options_translations.language_id', '=', $request->languageID);
                    })
                    ->join('products_options_lists', function ($q) use ($product) {
                        $q->on('options.id', '=', 'products_options_lists.option_id')
                            ->where('products_options_lists.product_id', '=', $product->id);
                    })
                    ->leftJoin('options_values', 'options_values.id', '=', 'products_options_lists.option_value_id')
                    ->leftJoin('options_values_translations', function ($q) use ($request) {
                        $q->on('options_values.id', '=', 'options_values_translations.option_value_id')
                            ->where('options_values_translations.language_id', '=', $request->languageID);
                    })
                    ->where('options.status', 1)
//                    ->groupBy('options.id')
                    ->orderBy('options.sort', 'ASC')
                    ->get();

                if ($options) {
                    foreach ($options as $option_index => $option) {
                        if ($option->image) {
                            $option->image = ImageService::customImageSize($option->image, 50, 50, 100);
                        } else {
                            $option->image = "";
                        }
                        $options[$option_index] = $option;
                    }
                    $product->options = $options;
                }

                $products[$product_index] = $product;
            }
        }


//        dd($products);


        return view('frontend.product.category', compact(
            'category',
            'products'
        ));


    }

}
