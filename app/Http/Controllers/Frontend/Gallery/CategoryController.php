<?php

namespace App\Http\Controllers\Frontend\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\GalleryCategory;
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
        $galleries = '';
        $gallerycCount = '';
        $category = '';
        if ($categorySlug != null) {

            $category = GalleryCategory::where('language_id',  $request->languageID)
                ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
                ->where('slug', $categorySlug)
                ->with('getGalleriesCount')
                ->where('status', 1)
                ->first();



            if ($category) {
                $categories = GalleryCategory::where('language_id', $request->languageID)
                    ->with('getGalleriesCount')
                    ->orderBy('id', 'DESC')
                    ->where('status', 1)
                    ->where('parent', $category->id)
                    ->join('galleries_categories_translations', 'galleries_categories_translations.category_id', '=', 'galleries_categories.id')
                    ->get();



                $galleries = Gallery::with(array('galleriesTranslations' => function ($query) use($request) {
                    $query->where('language_id', $request->languageID);

                })) ->with('galleriesCategoriesCheck')
                    ->where('galleries_categories_lists.category_id', $category->id)
                    ->join('galleries_categories_lists', 'galleries_categories_lists.gallery_id', '=', 'galleries.id')
                    ->orderBy('galleries.id', 'DESC')
                    ->select('*', 'galleries.id as id')
                    ->where('status', 1)
                    ->paginate(10);




            }else{
                abort(404);
            }


        } else {
            abort(404);
        }

        $gallerycCount = $category->getGalleriesCount->count();
        $categoryName = $category->name;


        return view('frontend.gallery.category.index', compact(
            'categories',
            'fullCategorySlug',
            'galleries',
            'gallerycCount',
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


        /*   ATTRIBUTES START   */





        return view('frontend.gallery.category.detail', compact(
            'gallery',
            'fullCategorySlug'
        ));



    }

}
