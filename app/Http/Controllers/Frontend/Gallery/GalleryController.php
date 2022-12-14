<?php

namespace App\Http\Controllers\Frontend\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\GalleryCategory;
use Illuminate\Http\Request;

class GalleryController extends Controller
{


    public function index(Request $request)
    {
        $galleries = Gallery::with(array('galleriesTranslations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->with('galleriesCategoriesCheck')
            ->join('galleries_categories_lists', 'galleries_categories_lists.gallery_id', '=', 'galleries.id')
            ->join('galleries_categories', function ($join) {
                $join->on('galleries_categories_lists.category_id', '=', 'galleries_categories.id')->where('galleries_categories.status', 1);
            })
            ->select(
                'galleries.id as id',
                'galleries.image as image',
                'galleries.images as images',
                'galleries.slug as slug',

                'galleries.status as status',
                'galleries.created_at as created_at',
                'galleries.updated_at as updated_at',
            )
            ->where('galleries.status', 1)
            ->groupBy('galleries_categories_lists.gallery_id')
            ->orderBy('id', 'DESC')
            ->paginate(10);





        $categories = GalleryCategory::where('language_id', $request->languageID)
//            ->with('getGalleriesCount')
            ->orderBy('id', 'DESC')
            ->where('parent', 0)
            ->where('status', 1)
            ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
            ->get();


        return view('frontend.gallery.index', compact('galleries', 'categories'));
    }


    public function detail(Request $request)
    {

        $slug = $request->slug;
        $gallery = Gallery::where('slug', $slug)
            ->where('status', 1)
            ->with(['galleriesTranslations' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }])
            ->with('galleriesCategoriesCheck')
            ->first();

        if (!$gallery || count($gallery->galleriesCategoriesCheck) == 0) {
            abort(404);
        }



        return view('frontend.gallery.detail', compact(
            'gallery',
        ));

    }


}
