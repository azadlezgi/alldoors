<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slide\ContactSendRequest;
use App\Mail\Frontend\SendMail;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeTranslation;
use App\Models\Option\Option;
use App\Models\Option\OptionTranslation;
use App\Models\Option\OptionValue;
use App\Models\Option\OptionValueTranslation;
use App\Models\Page\Page;
use App\Models\Partner\Partner;
use App\Models\Post\Post;
use App\Models\Product\Product;
use App\Models\Product\ProductAttributeList;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCategoryList;
use App\Models\Product\ProductCategoryTranslation;
use App\Models\Product\ProductManufacturer;
use App\Models\Product\ProductManufacturerList;
use App\Models\Product\ProductManufacturerTranslation;
use App\Models\Product\ProductModel;
use App\Models\Product\ProductModelList;
use App\Models\Product\ProductModelTranslation;
use App\Models\Product\ProductOptionList;
use App\Models\Product\ProductSpecialPriceList;
use App\Models\Product\ProductTranslation;
use App\Models\Review\Review;
use App\Models\Service\Service;
use App\Models\Slide\Slide;
use App\Models\Team\Team;
use App\Services\ImageService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Orchestra\Parser\Xml\Facade as XmlParser;

class HomeController extends Controller
{


    public function index(Request $request)
    {


        $slides = Slide::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('slides_translations', 'slides.id', '=', 'slides_translations.slide_id')
            ->orderBy('sort', 'ASC')
            ->get();


        $products_categories = [];
        $products_categories_query = ProductCategory::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('products_categories_translations', 'products_categories.id', '=', 'products_categories_translations.category_id')
            ->orderBy('id', 'DESC')
            ->limit(4)
            ->get();
        if ($products_categories_query) {
            foreach ($products_categories_query as $products_category) {
                $products_category->image = $products_category->image ? $products_category->image : '/storage/no-image.png';
                $products_category->image = ImageService::customImageSize($products_category->image, 300, 220, 100);
                $products_categories[] = $products_category;
            }
        }


//        {{  \App\Services\ImageService::customImageSize($products_category->image ? $products_category->image : 'storage/no-image.png',300,220,100) }}

//
//        $partners = Partner::where('language_id', $request->languageID)
//            ->where('status', 1)
//            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
//            ->orderBy('sort', 'ASC')
//            ->get();
//
//
//
//        $services = Service::with(array('servicesTranslations' => function ($query) use ($request) {
//            $query->where('language_id', $request->languageID);
//
//        }))
//            ->with('servicesCategoriesCheck')
//            ->join('services_categories_lists', 'services_categories_lists.service_id', '=', 'services.id')
//            ->join('services_categories', function ($join) {
//                $join->on('services_categories_lists.category_id', '=', 'services_categories.id')->where('services_categories.status', 1);
//            })
//            ->select(
//                'services.id as id',
//                'services.image as image',
//                'services.images as images',
//                'services.slug as slug',
//
//                'services.status as status',
//                'services.created_at as created_at',
//                'services.updated_at as updated_at',
//            )
//            ->where('services.status', 1)
//            ->groupBy('services_categories_lists.service_id')
//            ->orderBy('id', 'DESC')
//            ->limit(10)
//            ->get();
//
//
//        $teams = Team::with(array('teamsTranslations' => function ($query) use ($request) {
//            $query->where('language_id', $request->languageID);
//
//        }))->where('status', 1)
//            ->orderBy('sort', 'ASC')
//            ->limit(4)
//            ->get();
//
//
//        $reviews = Review::with(array('reviewsTranslations' => function ($query) use ($request) {
//            $query->where('language_id', $request->languageID);
//
//        }))->where('status', 1)
//            ->orderBy('sort', 'ASC')
//            ->get();
//
//
//        $posts = Post::with(array('postsTranslations' => function ($query) use ($request) {
//            $query->where('language_id', $request->languageID);
//
//        }))
//            ->with('postsCategoriesCheck')
//            ->join('posts_categories_lists', 'posts_categories_lists.post_id', '=', 'posts.id')
//            ->join('posts_categories', function ($join) {
//                $join->on('posts_categories_lists.category_id', '=', 'posts_categories.id')->where('posts_categories.status', 1);
//            })
//            ->select(
//                'posts.id as id',
//                'posts.image as image',
//                'posts.images as images',
//                'posts.slug as slug',
//
//                'posts.status as status',
//                'posts.created_at as created_at',
//                'posts.updated_at as updated_at',
//            )
//            ->where('posts.status', 1)
//            ->groupBy('posts_categories_lists.post_id')
//            ->orderBy('id', 'DESC')
//            ->limit(9)
//            ->get();

        return view('frontend.home.index', compact(
            'slides',
            'products_categories'

        ));
    }


    public function contact(Request $request)
    {
        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->get();

        return view('frontend.home.contact', compact('partners'));
    }

    public function contactSendAjax(Request $request)
    {
        $name = $request->name;
        $subject = $request->subject;
        $email = $request->email;
        $mobil = $request->mobil;
        $text = $request->text;


        $data = [
            'name' => $name,
            'subject' => $subject,
            'email' => $email,
            'mobil' => $mobil,
            'text' => $text,
        ];

        $responseData = [];

        if (empty($data['name'])) {
            array_push($responseData, language('frontend.contact.form_error_name'));

        }

        if (empty($data['email'])) {
            array_push($responseData, language('frontend.contact.form_error_email'));
        } else {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                array_push($responseData, language('frontend.contact.form_error_email_invalid'));
            }
        }


        if (empty($data['mobil'])) {
            array_push($responseData, language('frontend.contact.form_error_tel'));
        }

        if (empty($data['text'])) {
            array_push($responseData, language('frontend.contact.form_error_text'));
        }


        if (!empty($data['name']) && !empty($data['email']) && !empty($data['mobil']) && !empty($data['text']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {

            $toMail = setting('email');


            Mail::to($toMail)
                ->send(new SendMail($data));

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true, 'data' => $responseData]);
        }


    }


    public function pars(Request $request)
    {

        $local_currency = 0.026;

        $url = "https://www.velldoris.net/bitrix/catalog_export/yml_russia_spb_with_filters.php";

//        $jsonData = file_get_contents($url);
        $xml = simplexml_load_file($url);
//        $xml = new \SimpleXMLElement($jsonData);
//        $xml = simplexml_load_string($jsonData);

//        dd($xml);

        $categories = [];
        foreach ($xml->shop->categories->category as $category) {
            $category_name = (string)$category;

            $product_category_query = ProductCategoryTranslation::where('name', $category_name)->first();
            if ($product_category_query == null) {

                $category_slug = uniqueSlug($category_name, '\App\Models\Product\ProductCategory');

                $product_category_insert = ProductCategory::create([
                    'slug' => $category_slug,
                    'status' => 1,
                ]);

                if ($product_category_insert) {
                    foreach (cache('key-all-languages') as $key => $language) {

                        $product_category_translation_insert = ProductCategoryTranslation::create([
                            'category_id' => $product_category_insert->id,
                            'language_id' => $language->id,
                            'name' => $category_name
                        ]);

                    }
                }
                $category_id = $product_category_insert->id;
            } else {
                $category_id = $product_category_query->category_id;
            }

            $categories[(int)$category->attributes()['id']] = [
                'id' => (int)$category_id,
                'name' => (string)$category_name
            ];

        }

//        dd($categories);


        $products = [];
        $product = [];
        foreach ($xml->shop->offers->offer as $offer) {

            $veldoris_product_id = (int)$offer->attributes()['id'];

//            if ($veldoris_product_id != 20705) {
//                continue;
//            }

            $product_query = Product::where('veldoris_id', $veldoris_product_id)
                ->first();
            if ($product_query != null) {
                continue;
            }

            $price = (float)$offer->price * (float)$local_currency;
            $oldprice = (float)$offer->oldprice * (float)$local_currency;

            $slug = uniqueSlug((string)$offer->name, '\App\Models\Product\Product');

            $image_url = (string)$offer->picture;
            $image_patchinfo = pathinfo($image_url);
            $image_patch = "filemanager/images/products/" . autocrateseourls((string)$categories[(int)$offer->categoryId]['name']) . "/";
            $image_name = $image_patch . $slug . "." . $image_patchinfo['extension'];

            if (file_exists(public_path() . "/storage/" . $image_name)) {
                $image = "/storage/" . $image_name;
            } else {

                $image_status_code = get_image_status_code($image_url);

                if ($image_status_code == 200 && Storage::disk('public')->put($image_name, file_get_contents($image_url))) {
                    $image = "/storage/" . $image_name;
                } else {
                    $image = "";
                }
            }


            $filters = [];
            foreach ($offer->filters->filter as $filter) {

                $values = [];
//                $option_type = 2;
                $option_type = 1;
                foreach ($filter->values->value as $value) {


                    if ($value->iconPicture) {

                        $iconPicture_url = (string)$value->iconPicture;
                        $iconPicture_patchinfo = pathinfo($iconPicture_url);

                        $iconPicture_name = "filemanager/images/Label_pictures/" . $iconPicture_patchinfo['basename'];

                        if (file_exists(public_path() . "/storage/" . $iconPicture_name)) {
                            $iconPicture = "/storage/" . $iconPicture_name;
                        } else {

                            $iconPicture_status_code = get_image_status_code($iconPicture_url);

                            if ($iconPicture_status_code == 200 && Storage::disk('public')->put($iconPicture_name, file_get_contents($iconPicture_url))) {
                                $iconPicture = "/storage/" . $iconPicture_name;
                            } else {
                                $iconPicture = "";
                            }
                        }
                    } else {
                        $iconPicture = "";
                    }


                    if ($value->labelPicture) {

                        $labelPicture_url = (string)$value->labelPicture;
                        $labelPicture_patchinfo = pathinfo($labelPicture_url);

                        $labelPicture_name = "filemanager/images/Label_pictures/" . $labelPicture_patchinfo['basename'];

                        if (file_exists(public_path() . "/storage/" . $labelPicture_name)) {
                            $labelPicture = "/storage/" . $labelPicture_name;
                        } else {

                            $labelPicture_status_code = get_image_status_code($labelPicture_url);

                            if ($labelPicture_status_code == 200 && Storage::disk('public')->put($labelPicture_name, file_get_contents($labelPicture_url))) {
                                $labelPicture = "/storage/" . $labelPicture_name;
                            } else {
                                $labelPicture = "";
                            }
                        }
                    } else {
                        $labelPicture = "";
                    }

                    if ($value->detailLabelPicture) {

                        $detailLabelPicture_url = (string)$value->detailLabelPicture;
                        $detailLabelPicture_patchinfo = pathinfo($detailLabelPicture_url);

                        $detailLabelPicture_name = "filemanager/images/Label_pictures/" . $detailLabelPicture_patchinfo['basename'];

                        if (file_exists(public_path() . "/storage/" . $detailLabelPicture_name)) {
                            $detailLabelPicture = "/storage/" . $detailLabelPicture_name;
                        } else {

                            $detailLabelPicture_status_code = get_image_status_code($detailLabelPicture_url);

                            if ($detailLabelPicture_status_code == 200 && Storage::disk('public')->put($detailLabelPicture_name, file_get_contents($detailLabelPicture_url))) {
                                $detailLabelPicture = "/storage/" . $detailLabelPicture_name;
                            } else {
                                $detailLabelPicture = "";
                            }
                        }
                    } else {
                        $detailLabelPicture = "";
                    }

                    if($labelPicture != "" || $detailLabelPicture != "" || $option_type == 1) {
                        $option_type = 1;
                    }

                    $values[] = [
                        'name' => (string)$value->name,
                        'iconPicture' => $iconPicture,
                        'labelPicture' => $labelPicture,
                        'detailLabelPicture' => $detailLabelPicture,
                    ];
                }
                $filters[] = [
                    'name' => (string)$filter->name,
                    'type' => $option_type,
                    'values' => $values
                ];
            }
//            dd($filters);


            $params = [];
            foreach ($offer->param as $param) {
//                dd($param);
                $params[] = [
                    'name' => (string)$param->attributes()['name'],
                    'unit' => (string)$param->attributes()['unit'],
                    'value' => (string)$param
                ];
            }

            $product = [
                'id' => $veldoris_product_id,
                'available' => (boolean)$offer->attributes()['available'],
                'price' => (float)$price,
                'oldprice' => (float)$oldprice,
                'category' => [
                    'id' => (int)$categories[(int)$offer->categoryId]['id'],
                    'name' => (string)$categories[(int)$offer->categoryId]['name'],
                ],
                'image' => $image,
                'name' => (string)$offer->name,
                'slug' => $slug,
                'description' => (string)$offer->description,
                'model' => (string)$offer->model,
                'vendor' => (string)$offer->vendor,
                'params' => $params,
                'filters' => $filters,
            ];

//            dd($product);

            $products[] = $product;


            $product_insert = Product::create([
                'veldoris_id' => $product['id'],
                'image' => $product['image'],
                'slug' => $product['slug'],
                'price' => $product['oldprice'] > 0 ? $product['oldprice'] : $product['price'],
                'status' => $product['available'] == true ? 1 : 0,
            ]);


            if ($product_insert) {

                foreach (cache('key-all-languages') as $key => $language) {

                    $product_translation_insert = ProductTranslation::create([
                        'product_id' => $product_insert->id,
                        'language_id' => $language->id,
                        'name' => $product['name'],
                        'text' => $product['description']
                    ]);

                }

                $product_category_list_insert = ProductCategoryList::create([
                    'product_id' => $product_insert->id,
                    'category_id' => $product['category']['id']
                ]);

                if ($product['oldprice'] > 0) {
                    $product_special_insert = ProductSpecialPriceList::create([
                        'product_id' => $product_insert->id,
                        'special_price' => $product['price']
                    ]);
                }


                if ($product['model']) {
                    $product_model_name = $product['model'];

                    $product_model_query = ProductModelTranslation::where('name', $product_model_name)->first();
                    if ($product_model_query == null) {

                        $product_model_slug = uniqueSlug($product_model_name, '\App\Models\Product\ProductModel');

                        $product_product_model_insert = ProductModel::create([
                            'slug' => $product_model_slug,
                            'status' => 1,
                        ]);

                        if ($product_product_model_insert) {
                            foreach (cache('key-all-languages') as $key => $language) {

                                $product_product_model_translation_insert = ProductModelTranslation::create([
                                    'model_id' => $product_product_model_insert->id,
                                    'language_id' => $language->id,
                                    'name' => $product_model_name
                                ]);

                            }
                        }
                        $product_model_id = $product_product_model_insert->id;
                    } else {
                        $product_model_id = $product_model_query->model_id;
                    }


                    $product_model_list_insert = ProductModelList::create([
                        'product_id' => $product_insert->id,
                        'model_id' => $product_model_id
                    ]);

                }


                if ($product['vendor']) {
                    $product_vendor_name = $product['vendor'];

                    $product_vendor_query = ProductManufacturerTranslation::where('name', $product_vendor_name)->first();
                    if ($product_vendor_query == null) {

                        $product_vendor_slug = uniqueSlug($product_vendor_name, '\App\Models\Product\ProductManufacturer');

                        $product_product_vendor_insert = ProductManufacturer::create([
                            'slug' => $product_vendor_slug,
                            'status' => 1,
                        ]);

                        if ($product_product_vendor_insert) {
                            foreach (cache('key-all-languages') as $key => $language) {

                                $product_product_vendor_translation_insert = ProductManufacturerTranslation::create([
                                    'manufacturer_id' => $product_product_vendor_insert->id,
                                    'language_id' => $language->id,
                                    'name' => $product_vendor_name
                                ]);

                            }
                        }
                        $product_vendor_id = $product_product_vendor_insert->id;
                    } else {
                        $product_vendor_id = $product_vendor_query->manufacturer_id;
                    }


                    $product_vendor_list_insert = ProductManufacturerList::create([
                        'product_id' => $product_insert->id,
                        'manufacturer_id' => $product_vendor_id
                    ]);

                }


                if ($product['params']) {
                    foreach ($product['params'] as $param_index => $param) {

//                        dd($param);
                        $product_param_name = $param['name'];

                        $product_param_query = AttributeTranslation::where('name', $product_param_name)->first();
                        if ($product_param_query == null) {

                            $product_product_param_insert = Attribute::create([
                                'attribute_group_id' => 12,
                                'sort' => $param_index,
                                'status' => 1
                            ]);

                            if ($product_product_param_insert) {
                                foreach (cache('key-all-languages') as $key => $language) {

                                    $product_product_param_translation_insert = AttributeTranslation::create([
                                        'attribute_id' => $product_product_param_insert->id,
                                        'language_id' => $language->id,
                                        'name' => $product_param_name
                                    ]);

                                }
                            }
                            $product_param_id = $product_product_param_insert->id;
                        } else {
                            $product_param_id = $product_param_query->attribute_id;
                        }


                        foreach (cache('key-all-languages') as $key => $language) {
                            $product_param_list_insert = ProductAttributeList::create([
                                'product_id' => $product_insert->id,
                                'attribute_id' => $product_param_id,
                                'language_id' => $language->id,
                                'name' => $param['value'] . ($param['unit'] ? " ". $param['unit'] : "")
                            ]);
                        }

                    }
                }


                if ($product['filters']) {
                    foreach ($product['filters'] as $filter_index => $filter) {

                        $product_filter_name = $filter['name'];

                        $product_filter_query = OptionTranslation::where('name', $product_filter_name)->first();
                        if ($product_filter_query == null) {



                            $product_product_filter_insert = Option::create([
                                'option_group_id' => 4,
                                'type' => $filter['type'],
                                'sort' => $filter_index,
                                'status' => 1
                            ]);

                            if ($product_product_filter_insert) {
                                foreach (cache('key-all-languages') as $key => $language) {

                                    $product_product_filter_translation_insert = OptionTranslation::create([
                                        'option_id' => $product_product_filter_insert->id,
                                        'language_id' => $language->id,
                                        'name' => $product_filter_name
                                    ]);

                                }
                            }
                            $product_filter_id = $product_product_filter_insert->id;
                        } else {
                            $product_filter_id = $product_filter_query->option_id;
                        }


                        if ($filter['values']) {
                            foreach ($filter['values'] as $filter_value_index => $filter_value) {

                                $product_filter_value_name = $filter_value['name'];

                                $product_filter_value_query = OptionValue::leftJoin('options_values_translations', 'options_values_translations.option_value_id', '=', 'options_values.id')
                                    ->where('option_id', $product_filter_id)
                                    ->where('text', $product_filter_value_name)
                                    ->first();
                                if ($product_filter_value_query == null) {

                                    if (!empty($filter_value['labelPicture'])) {
                                        $option_value_image = $filter_value['labelPicture'];
                                    } elseif (!empty($filter_value['detailLabelPicture'])) {
                                        $option_value_image = $filter_value['detailLabelPicture'];
                                    } elseif (!empty($filter_value['iconPicture'])) {
                                        $option_value_image = $filter_value['iconPicture'];
                                    } else {
                                        $option_value_image = "";
                                    }

                                    $product_product_filter_value_insert = OptionValue::create([
                                        'option_id' => $product_filter_id,
                                        'image' => $option_value_image,
                                        'sort' => $filter_value_index
                                    ]);

                                    if ($product_product_filter_value_insert) {
                                        foreach (cache('key-all-languages') as $key => $language) {

                                            $product_product_filter_value_translation_insert = OptionValueTranslation::create([
                                                'option_value_id' => $product_product_filter_value_insert->id,
                                                'language_id' => $language->id,
                                                'text' => $product_filter_value_name
                                            ]);

                                        }
                                    }
                                    $product_filter_value_id = $product_product_filter_value_insert->id;
                                } else {
                                    $product_filter_value_id = $product_filter_value_query->option_value_id;
                                }


                                $product_option_list_insert = ProductOptionList::create([
                                    'product_id' => $product_insert->id,
                                    'option_id' => $product_filter_id,
                                    'option_value_id' => $product_filter_value_id
                                ]);

                            }
                        }

                    }
                }


            }
//            dd($product_translation_insert);


        }


        dd($products);


//        $xml = XmlParser::load('https://www.velldoris.net/bitrix/catalog_export/yml_russia_spb_with_filters.php');
//
////        dd($xml);
//        $array = $xml->parse([
//            'azad' => ['uses' => 'shop.offers[offer]'],
//        ]);
//
//
//        dd($array);

    }


}
