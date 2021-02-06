<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class Language
{

    public function handle(Request $request, Closure $next)
    {
        App::setLocale($request->language);
        return $next($request);
    }
}
