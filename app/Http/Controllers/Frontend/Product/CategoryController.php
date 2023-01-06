<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Option\Option;
use App\Models\Option\OptionValue;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Services\CategoriesService;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request, $categorySlug = null)
    {




    }


    public function detail(Request $request)
    {

//        dd($request->sort);

        $slug = stripinput($request->slug);
        $sort = stripinput($request->sort);

        $category = ProductCategory::where('slug', $slug)
            ->join('products_categories_translations', 'products_categories.id', '=', 'products_categories_translations.category_id')
            ->first();


        if ($category == null) {
            abort(404);
        }


        $filter_options = [];
        $optionsQuery = Option::select(
                '*'
            )
            ->join('options_translations', function ($q) use ($request) {
                $q->on('options.id', '=', 'options_translations.option_id')
                    ->where('options_translations.language_id', '=', $request->languageID);
            })
            ->where('options.status', 1)
            ->whereIn('options.id', [147, 148, 149, 150, 151, 152])
            ->orderBy('options.sort', 'ASC')
            ->get();
        if ($optionsQuery) {
            foreach ($optionsQuery as $option) {
                $filter_options[$option->id]['id'] = $option->id;
                $filter_options[$option->id]['type'] = $option->type;
                $filter_options[$option->id]['name'] = $option->name;
                $filter_options[$option->id]['values'] = [];

                $optionsValuesQuery = OptionValue::select(
                        '*'
                    )
                    ->leftJoin('options_values_translations', function ($q) use ($request) {
                        $q->on('options_values.id', '=', 'options_values_translations.option_value_id')
                            ->where('options_values_translations.language_id', '=', $request->languageID);
                    })
                    ->orderBy('options_values.sort', 'ASC')
                    ->where('options_values.option_id', $option->id)
//                    ->limit(5)
                    ->get();
                if ($optionsValuesQuery) {
                    foreach ($optionsValuesQuery as $optionsValue) {
                        $filter_options[$option->id]['values'][$optionsValue->id]['id'] = $optionsValue->id;
                        $filter_options[$option->id]['values'][$optionsValue->id]['text'] = $optionsValue->text;
                        if ($option->type == 1) {
//                            $optionsValue->image = $optionsValue->image ? $optionsValue->image : '/storage/no-image.png';
//                            $optionsValue->image = ImageService::customImageSize($optionsValue->image, 50, 50, 100);
                            $filter_options[$option->id]['values'][$optionsValue->id]['image'] = $optionsValue->image ? $optionsValue->image : '';
                        } else {
                            $filter_options[$option->id]['values'][$optionsValue->id]['image'] = "";
                        }
                    }
                }
            }
        }


        $products = Product::select(
            'products.id',
            'products_translations.name',
            'products.image',
            'products.price',
            'products_specials_prices_lists.special_price',
            'products.slug'
        )
            ->join('products_translations', 'products.id', '=', 'products_translations.product_id')
            ->join('products_categories_lists', 'products.id', '=', 'products_categories_lists.product_id')
            ->leftJoin('products_specials_prices_lists', 'products.id', '=', 'products_specials_prices_lists.product_id');


        if ($sort && $sort == "popular") {
            $products = $products->leftJoin('products_options_lists', 'products.id', '=', 'products_options_lists.product_id')
                ->where('products_options_lists.option_value_id', 645);
        }

        $products = $products->where('products.status', 1);
        $products = $products->where('products_categories_lists.category_id', (int)$category->id);
        $products = $products->groupBy('products.id');
        if ($sort) {
            if ($sort == "price_asc") {
                $products = $products->orderBy('products.price', 'ASC');
            } elseif ($sort == "price_desc") {
                $products = $products->orderBy('products.price', 'DESC');
            }
        } else {
            $products = $products->orderBy('products.id', 'DESC');
        }

        $products = $products->paginate(24);

//        dd($products);


        if ($products) {
            foreach ($products as $product_index => $product) {

                $product->image = $product->image ? $product->image : '/storage/no-image.png';
                $product->image = ImageService::customImageSize($product->image, 204, 305, 100);
                $product->price = price_view($product->price);
                $product->special_price = price_view($product->special_price);

                $product->attributes = [];
//                $attributes = Attribute::where('attributes_translations.language_id', $request->languageID)
//                    ->where('status', 1)
//                    ->join('attributes_translations', 'attributes.id', '=', 'attributes_translations.attribute_id')
//                    ->join('products_attributes_lists', 'attributes.id', '=', 'products_attributes_lists.attribute_id')
//                    ->orderBy('attributes.sort', 'ASC')
//                    ->where('products_attributes_lists.product_id', $product->id)
//                    ->where('products_attributes_lists.language_id', $request->languageID)
//                    ->select('*', 'attributes_translations.name as attributes_translations_name')
//                    ->get();
//                if ($attributes) {
//                    $product->attributes = $attributes;
//                }


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
            'products',
            'sort',
            'filter_options'
        ));


    }

}
