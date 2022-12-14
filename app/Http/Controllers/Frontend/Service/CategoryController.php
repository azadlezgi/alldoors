<?php

namespace App\Http\Controllers\Frontend\Service;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Service\Service;
use App\Models\Service\ServiceCategory;
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
        $services = '';
        $servicecCount = '';
        $category = '';
        if ($categorySlug != null) {

            $category = ServiceCategory::where('language_id',  $request->languageID)
                ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
                ->where('slug', $categorySlug)
                ->with('getServicesCount')
                ->where('status', 1)
                ->first();



            if ($category) {
                $categories = ServiceCategory::where('language_id', $request->languageID)
                    ->with('getServicesCount')
                    ->orderBy('id', 'DESC')
                    ->where('status', 1)
                    ->where('parent', $category->id)
                    ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
                    ->get();



                $services = Service::with(array('servicesTranslations' => function ($query) use($request) {
                    $query->where('language_id', $request->languageID);

                })) ->with('servicesCategoriesCheck')
                    ->where('services_categories_lists.category_id', $category->id)
                    ->join('services_categories_lists', 'services_categories_lists.service_id', '=', 'services.id')
                    ->orderBy('services.id', 'DESC')
                    ->select('*', 'services.id as id')
                    ->where('status', 1)
                    ->paginate(10);




            }else{
                abort(404);
            }


        } else {
            abort(404);
        }

        $servicecCount = $category->getServicesCount->count();
        $categoryName = $category->name;


        return view('frontend.service.category.index', compact(
            'categories',
            'fullCategorySlug',
            'services',
            'servicecCount',
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
        $service = Service::where('slug', $slug)
            ->where('status', 1)
            ->with(['servicesTranslations' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }])
            ->with('servicesCategoriesCheck')
            ->first();







        if (!$service || count($service->servicesCategoriesCheck) == 0) {
            abort(404);
        }


        /*   ATTRIBUTES START   */





        return view('frontend.service.category.detail', compact(
            'service',
            'fullCategorySlug'
        ));



    }

}
