<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class Language
{

    public function handle(Request $request, Closure $next)
    {
        if (Session::has('locale') && array_key_exists(Session::get('locale'), config('locales.languages'))){
            App::setLocale(Session::get('locale'));
        }else{
            $userLangs = preg_split('/[,;]/',  $request->server('HTTP_ACCEPT_LANGUAGE'));

            foreach ($userLangs as $userLang){
                if (array_key_exists($userLang, config('locales.languages'))) {
                    App::setLocale($userLang);
                    Lang::setLocale($userLang);
                    setlocale(LC_TIME, config('locales.languages')[$userLang]['unicode']);
                    Carbon::setLocale($userLang);
                }
            }
        }

        return $next($request);
    }
}
