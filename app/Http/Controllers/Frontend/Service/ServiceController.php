<?php

namespace App\Http\Controllers\Frontend\Service;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Partner\Partner;
use App\Models\Post\Post;
use App\Models\Service\Service;
use App\Models\Service\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{


    public function index(Request $request)
    {
        $services = Service::with(array('servicesTranlations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('servicesCategoriesCheck')
            ->join('services_categories_lists', 'services_categories_lists.service_id', '=', 'services.id')
            ->join('services_categories', function ($join) {
                $join->on('services_categories_lists.category_id', '=', 'services_categories.id')->where('services_categories.status', 1);
            })
            ->select(
                'services.id as id',
                'services.image as image',
                'services.images as images',
                'services.slug as slug',

                'services.status as status',
                'services.created_at as created_at',
                'services.updated_at as updated_at',
            )
            ->where('services.status', 1)
            ->groupBy('services_categories_lists.service_id')
            ->orderBy('sort', 'ASC')
            ->paginate(12);





//        $categories = ServiceCategory::where('language_id', $request->languageID)
////            ->with('getServicesCount')
//            ->orderBy('id', 'DESC')
//            ->where('parent', 0)
//            ->where('status', 1)
//            ->join('services_categories_translations', 'services_categories_translations.category_id', '=', 'services_categories.id')
//            ->get();


        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->get();


        return view('frontend.service.index', compact('services', 'partners'));
    }


    public function detail(Request $request)
    {

        $slug = $request->slug;
        $service = Service::where('slug', $slug)
            ->where('status', 1)
            ->with(['servicesTranlations' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }])
            ->with('servicesCategoriesCheck')
            ->first();



        if (!$service || count($service->servicesCategoriesCheck) == 0) {
            abort(404);
        }

        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->get();


        $services = Service::with(array('servicesTranlations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('servicesCategoriesCheck')
            ->join('services_categories_lists', 'services_categories_lists.service_id', '=', 'services.id')
            ->join('services_categories', function ($join) {
                $join->on('services_categories_lists.category_id', '=', 'services_categories.id')->where('services_categories.status', 1);
            })
            ->select(
                'services.id as id',
                'services.image as image',
                'services.images as images',
                'services.slug as slug',

                'services.status as status',
                'services.created_at as created_at',
                'services.updated_at as updated_at',
            )
            ->where('services.status', 1)
            ->where('services.id', '!=', $service->id)
            ->groupBy('services_categories_lists.service_id')
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();



        $posts = Post::with(array('postsTranlations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('postsCategoriesCheck')
            ->join('posts_categories_lists', 'posts_categories_lists.post_id', '=', 'posts.id')
            ->join('posts_categories', function ($join) {
                $join->on('posts_categories_lists.category_id', '=', 'posts_categories.id')->where('posts_categories.status', 1);
            })
            ->select(
                'posts.id as id',
                'posts.image as image',
                'posts.images as images',
                'posts.slug as slug',

                'posts.status as status',
                'posts.created_at as created_at',
                'posts.updated_at as updated_at',
            )
            ->where('posts.status', 1)
            ->groupBy('posts_categories_lists.post_id')
            ->orderBy('id', 'DESC')
            ->limit(9)
            ->get();

        return view('frontend.service.detail', compact(
            'service',
            'partners',
            'services',
            'posts',
        ));

    }


}
