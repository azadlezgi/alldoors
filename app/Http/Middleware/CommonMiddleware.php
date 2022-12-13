<?php

namespace App\Http\Middleware;

use App\Models\Language\Languages;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CommonMiddleware
{

    public function handle(Request $request, Closure $next)
    {

        //Aktiv dilleri aldim
        Cache::rememberForever('key-all-languages', function () {
            return Languages::where('status', 1)
                ->orderBy('sort','ASC')
                ->get();

        });




        //Default Dili aldim
        Cache::rememberForever('language-defaultID', function () {
            $languageDefault = Languages::where('default', 1)
                ->first();
            return $languageDefault->id;
        });



        //Default Dili aldim
        Cache::rememberForever('language-default', function () {
            $languageDefault = Languages::where('default', 1)
                ->first();
            return $languageDefault->code;
        });




        view()->share('HTTP_HOST', $request->getSchemeAndHttpHost());


        return $next($request);
    }
}
