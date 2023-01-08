<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Option\Option;
use App\Models\Option\OptionValue;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCollection;
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {


    }


    public function search(Request $request)
    {

        $sort = stripinput($request->sort);
        $filter_word = stripinput($request->q);
        $filter_price_min = stripinput($request->price_min);
        $filter_price_max = stripinput($request->price_max);
        $filter_category = stripinput($request->category);
        $filter_category_arr = explode(",", $filter_category);
        $filter_collection = stripinput($request->collection);
        $filter_collection_arr = explode(",", $filter_collection);
        $filter_option = $request->option;
        $filter_option_arr = [];
        if ($filter_option) {
            foreach ($filter_option as $filter_option_index => $filter_option_value) {
                $filter_option[$filter_option_index] = stripinput($filter_option_value);
                $filter_option_arr[$filter_option_index] = explode(",", $filter_option[$filter_option_index]);
            }
        }

//        dd($filter_option_arr);


        $filter_url = "";
        if ($filter_word) {
            $filter_url .= "&q=" . $filter_word;
        }
        if ($filter_price_min) {
            $filter_url .= "&price_min=" . $filter_price_min;
        }
        if ($filter_price_max) {
            $filter_url .= "&price_max=" . $filter_price_max;
        }
        if ($filter_category) {
            $filter_url .= "&category=" . $filter_category;
        }
        if ($filter_collection) {
            $filter_url .= "&collection=" . $filter_collection;
        }
//        if ($filter_option) {
//            $filter_url .= "&filter_options=" . $filter_option;
//        }
        if ($filter_url) {
            $filter_url = "?filter=1" . $filter_url;
        }


        $filter_categories = [];
        $categoriesQuery = ProductCategory::select(
            'products_categories.id',
            'products_categories_translations.name'
        )
            ->join('products_categories_translations', function ($q) use ($request) {
                $q->on('products_categories.id', '=', 'products_categories_translations.category_id')
                    ->where('products_categories_translations.language_id', '=', $request->languageID);
            })
            ->where('products_categories.status', 1)
            ->orderBy('products_categories_translations.name', 'ASC')
            ->get();
        if ($categoriesQuery) {
            foreach ($categoriesQuery as $category) {
                $filter_categories[$category->id]['id'] = $category->id;
                $filter_categories[$category->id]['name'] = $category->name;
                $filter_categories[$category->id]['selected'] = (in_array($category->id, $filter_category_arr) ? true : false);
            }
        }

        $filter_collections = [];
        $collectionsQuery = ProductCollection::select(
            'products_collections.id',
            'products_collections_translations.name'
        )
            ->join('products_collections_translations', function ($q) use ($request) {
                $q->on('products_collections.id', '=', 'products_collections_translations.collection_id')
                    ->where('products_collections_translations.language_id', '=', $request->languageID);
            })
            ->where('products_collections.status', 1)
            ->orderBy('products_collections_translations.name', 'ASC')
            ->get();
        if ($collectionsQuery) {
            foreach ($collectionsQuery as $collection) {
                $filter_collections[$collection->id]['id'] = $collection->id;
                $filter_collections[$collection->id]['name'] = $collection->name;
                $filter_collections[$collection->id]['selected'] = (in_array($collection->id, $filter_collection_arr) ? true : false);
            }
        }

//        dd($filter_collections);


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
                        $filter_options[$option->id]['values'][$optionsValue->id]['selected'] = (isset($filter_option_arr[$option->id]) && in_array($optionsValue->id, $filter_option_arr[$option->id]) ? true : false);
                    }
                }
            }
        }

//        dd($filter_options);


        $product_min_max_price = [];
        $min_max_priceQuery = Product::select(
            'products.id',
            'products.price',
            'products_specials_prices_lists.special_price'
        )
            ->leftJoin('products_specials_prices_lists', 'products.id', '=', 'products_specials_prices_lists.product_id')
            ->get();
        if ($min_max_priceQuery) {

            $min_max_price_arr = [];
            $min_max_special_price_arr = [];

            foreach ($min_max_priceQuery as $min_max_price) {
                $min_max_price_arr[(string)$min_max_price->price] = $min_max_price->price;
                $min_max_special_price_arr[(string)$min_max_price->special_price] = $min_max_price->special_price;
            }
            ksort($min_max_price_arr);
            ksort($min_max_special_price_arr);

            $product_min_max_price = [
                'min_price' => (int)floor(reset($min_max_special_price_arr)),
                'max_price' => (int)ceil(end($min_max_price_arr))
            ];
        }

//        dd($product_min_max_price);


        $products = Product::select(
            'products.id',
            'products_translations.name',
            'products.image',
            'products.price',
            'products_specials_prices_lists.special_price',
            'products.slug'
        )
            ->join('products_translations', 'products.id', '=', 'products_translations.product_id')
            ->leftJoin('products_specials_prices_lists', 'products.id', '=', 'products_specials_prices_lists.product_id');


        $products = $products->where('products.status', 1);


        if ($filter_category) {
            ;
            $products = $products->leftJoin('products_categories_lists', 'products.id', '=', 'products_categories_lists.product_id')
                ->whereIn('products_categories_lists.category_id', explode(",", $filter_category));
        }

        if ($filter_collection) {
            ;
            $products = $products->leftJoin('products_collections_lists', 'products.id', '=', 'products_collections_lists.product_id')
                ->whereIn('products_collections_lists.collection_id', explode(",", $filter_collection));
        }

        if ($filter_option_arr || $sort && $sort == "popular") {
            $products = $products->leftJoin('products_options_lists', 'products.id', '=', 'products_options_lists.product_id');

            if ($sort && $sort == "popular") {
                $products = $products->where('products_options_lists.option_value_id', 645);
            }

            foreach ($filter_option_arr as $filter_option_val) {
                $products = $products->whereIn('products_options_lists.option_value_id', $filter_option_val);
            }
        }

        if ($filter_word) {
            $products = $products->where(function ($q) use ($filter_word) {
                $q->where('products_translations.name', 'LIKE', "%" . $filter_word . "%")
                    ->orWhere('products_translations.text', 'LIKE', "%" . $filter_word . "%");
            });
        }

        if ($filter_price_min || $filter_price_max) {
            $products = $products->where(function ($q) use ($filter_price_min, $filter_price_max) {
                $q->where('products.price', '>', (int)$filter_price_min)
                    ->where('products.price', '<', (int)$filter_price_max);
            });
        }


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


        $sorts_by = [
            [
                'url' => route('frontend.product.search') . ($filter_url ? $filter_url : ""),
                'name' => language('frontend.catalog.sort_last')
            ],
            [
                'url' => route('frontend.product.search') . ($filter_url ? $filter_url . "&" : "?") . "sort=popular",
                'name' => language('frontend.catalog.sort_popular')
            ],
            [
                'url' => route('frontend.product.search') . ($filter_url ? $filter_url . "&" : "?") . "sort=price_asc",
                'name' => language('frontend.catalog.sort_cheap')
            ],
            [
                'url' => route('frontend.product.search') . ($filter_url ? $filter_url . "&" : "?") . "sort=price_desc",
                'name' => language('frontend.catalog.sort_expensive')
            ]
        ];

//        dd($sorts_by);


        return view('frontend.product.search', compact(
            'products',
            'sort',
            'filter_options',
            'filter_url',
            'sorts_by',
            'product_min_max_price',
            'filter_categories',
            'filter_collections'
        ));
    }


    public function detail(Request $request)
    {


        $slug = stripinput($request->slug);


        $product = Product::select(
            'products.*',
            'products_translations.*',
            'products_specials_prices_lists.special_price as special_price',

            'products_categories.id as category_id',
            'products_categories.slug as category_slug',
            'products_categories_translations.name as category_name',

            'products_manufacturers.id as manufacturer_id',
            'products_manufacturers.slug as manufacturer_slug',
            'products_manufacturers_translations.name as manufacturer_name',

        )
            ->join('products_translations', 'products.id', '=', 'products_translations.product_id')
            ->leftJoin('products_specials_prices_lists', 'products.id', '=', 'products_specials_prices_lists.product_id')
            ->leftJoin('products_categories_lists', 'products.id', '=', 'products_categories_lists.product_id')
            ->leftJoin('products_categories', 'products_categories_lists.category_id', '=', 'products_categories.id')
            ->leftJoin('products_categories_translations', 'products_categories.id', '=', 'products_categories_translations.category_id')
            ->leftJoin('products_manufacturers_lists', 'products.id', '=', 'products_manufacturers_lists.product_id')
            ->leftJoin('products_manufacturers', 'products_manufacturers_lists.manufacturer_id', '=', 'products_manufacturers.id')
            ->leftJoin('products_manufacturers_translations', 'products_manufacturers.id', '=', 'products_manufacturers_translations.manufacturer_id')
            ->where('products.status', 1)
            ->where('products.slug', $slug)
            ->first();

        if ($product == null) {
            abort(404);
        } else {

            $product->image = $product->image ? $product->image : '/storage/no-image.png';
            $product->image = ImageService::customImageSize($product->image, 416, 490, 100);
            $product->image_big = ImageService::customImageSize($product->image, 640, 742, 80);
            $product->price_view = price_view($product->price);
            $product->special_price_view = price_view($product->special_price);
            $product->date = Carbon::parse($product->created_at)->format('d.m.Y');

            $product_images_arr = [];
            $product_images_big_arr = [];
            if ($product->images) {
                $product->images = json_decode($product->images, true);
                foreach ($product->images as $product_images_index => $product_images) {
                    $product_images_arr[$product_images_index] = ImageService::customImageSize($product_images, 416, 490, 100);
                    $product_images_big_arr[$product_images_index] = ImageService::customImageSize($product_images, 640, 742, 80);
                }
            }
            $product->images = $product_images_arr;
            $product->images_big = $product_images_big_arr;


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
                'options.id as id',
                'options_translations.name as name',
                'options.type as type'
            )
                ->join('options_translations', function ($q) use ($request) {
                    $q->on('options.id', '=', 'options_translations.option_id')
                        ->where('options_translations.language_id', '=', $request->languageID);
                })
                ->join('products_options_lists', function ($q) use ($product) {
                    $q->on('options.id', '=', 'products_options_lists.option_id')
                        ->where('products_options_lists.product_id', '=', $product->id);
                })
                ->where('options.status', 1)
                ->where('products_options_lists.product_id', $product->id)
                ->orderBy('options.sort', 'ASC')
                ->groupBy('options.id')
                ->get();

            if ($options) {
                foreach ($options as $option_index => $option) {
                    if ($option->image) {
                        $option->image = ImageService::customImageSize($option->image, 50, 50, 100);
                    } else {
                        $option->image = "";
                    }

                    $option->values = OptionValue::select(
                        'options_values.id as id',
                        'options_values.image as image',
                        'options_values_translations.text as text'
                    )
                        ->join('options_values_translations', function ($q) use ($request) {
                            $q->on('options_values.id', '=', 'options_values_translations.option_value_id')
                                ->where('options_values_translations.language_id', '=', $request->languageID);
                        })
                        ->join('products_options_lists', function ($q) use ($product) {
                            $q->on('options_values.id', '=', 'products_options_lists.option_value_id')
                                ->where('products_options_lists.product_id', '=', $product->id);
                        })
                        ->where('options_values.option_id', $option->id)
                        ->where('products_options_lists.product_id', $product->id)
                        ->orderBy('options_values.sort', 'ASC')
                        ->groupBy('options_values.id')
                        ->get();


                    $options[$option_index] = $option;

                }
                $product->options = $options;
            }

        }

//        dd($product);


        $products = Product::select(
            'products.id',
            'products_translations.name',
            'products.image',
            'products.price',
            'products_specials_prices_lists.special_price',
            'products.slug'
        )
            ->join('products_translations', 'products.id', '=', 'products_translations.product_id')
            ->leftJoin('products_specials_prices_lists', 'products.id', '=', 'products_specials_prices_lists.product_id')
            ->where('products.status', 1)
            ->where('products.id', "!=", $product->id)
            ->where('products.id', "<", $product->id);


        if ($product->category_id) {
            $products = $products->leftJoin('products_categories_lists', 'products.id', '=', 'products_categories_lists.product_id')
                ->where('products_categories_lists.category_id', $product->category_id);
        }

        $products = $products->orderBy('products.id', 'DESC')
            ->groupBy('products.id')
            ->limit(4)
            ->get();

//        dd($products);


        if ($products) {
            foreach ($products as $product_index => $product_other) {

                $product_other->image = $product_other->image ? $product_other->image : '/storage/no-image.png';
                $product_other->image = ImageService::customImageSize($product_other->image, 281, 420, 100);
                $product_other->price = price_view($product_other->price);
                $product_other->special_price = price_view($product_other->special_price);

                $product_other->attributes = [];


                $product_other->options = [];
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
                    ->join('products_options_lists', function ($q) use ($product_other) {
                        $q->on('options.id', '=', 'products_options_lists.option_id')
                            ->where('products_options_lists.product_id', '=', $product_other->id);
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
                    $product_other->options = $options;
                }

                $products[$product_index] = $product_other;
            }
        }

//        dd($products);


        return view('frontend.product.detail', compact(
            'product',
            'products'
        ));

    }


}
