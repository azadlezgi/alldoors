<?php

namespace App\Http\Controllers\Frontend\Page;

use App\Http\Controllers\Controller;
use App\Models\Page\Page;
use App\Models\Team\Team;
use Illuminate\Http\Request;

class PageController extends Controller
{


    public function page(Request $request)
    {

        $page = Page::where('language_id', $request->languageID)
            ->where('status', 1)
            ->where('slug', $request->slug)
            ->join('pages_translations', 'pages.id', '=', 'pages_translations.page_id')
            ->select(
                '*',
                'pages.updated_at as updated_at',
            )
            ->first();


        if (!$page) {
            abort(404);
        }



        $teams = Team::with(array('teamsTranslations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))->where('status', 1)
            ->orderBy('sort', 'ASC')
            ->limit(12)
            ->get();


        return view('frontend.page.index', compact(
            'page',
            'teams',
        ));
    }


}
