<?php

namespace App\Http\Controllers\Frontend\Team;

use App\Http\Controllers\Controller;
use App\Models\Attribute\Attribute;
use App\Models\Attribute\AttributeGroup;
use App\Models\Partner\Partner;
use App\Models\Team\Team;
use App\Models\Team\TeamCategory;
use Illuminate\Http\Request;

class TeamController extends Controller
{


    public function index(Request $request)
    {
        $teams = Team::with(array('teamsTranslations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))->where('status', 1)
            ->orderBy('sort', 'ASC')
            ->paginate(12);




        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->get();


        return view('frontend.team.index', compact('teams', 'partners'));
    }

    public function detail(Request $request)
    {

        $slug = $request->slug;
        $team = Team::where('slug', $slug)
            ->where('status', 1)
            ->with(['teamsTranslations' => function ($query) use ($request) {
                $query->where('language_id', $request->languageID);
            }])
            ->first();

        if (!$team) {
            abort(404);
        }

        $teams = Team::with(array('teamsTranslations' => function ($query) use ($request) {
            $query->where('language_id', $request->languageID);

        }))
            ->where('teams.status', 1)
            ->limit(20)
            ->orderBy('sort', 'ASC')
            ->get();


        $partners = Partner::where('language_id', $request->languageID)
            ->where('status', 1)
            ->join('partners_translations', 'partners.id', '=', 'partners_translations.partner_id')
            ->orderBy('sort', 'ASC')
            ->get();


        return view('frontend.team.detail', compact(
            'team',
            'teams',
            'partners',
        ));

    }



}
