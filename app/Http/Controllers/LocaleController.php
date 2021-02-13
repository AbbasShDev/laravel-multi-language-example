<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function switch($local) {

        try {
            if (array_key_exists($local, config('locales.languages'))) {
                App::setLocale($local);
                Lang::setLocale($local);
                setlocale(LC_TIME, config('locales.languages')[$local]['unicode']);
                Carbon::setLocale($local);
                Session::put('locale', $local);

                $segments = request()->create(url()->previous())->segments();

                if (isset($segments[1])){
                    $this->resolveModel(Post::class, $segments[1], $local);
                }
            }

            return redirect()->back();
        } catch (\Exception $exception){
            return redirect()->back();
        }
//        $segments[0] = $local;
//
//        $redirectUrl = implode('/', $segments);
//
//        return redirect()->to($redirectUrl);

    }

    protected function resolveModel($modelClass, $slug, $locale)
    {
        $model = $modelClass::where('slug->' . $locale, $slug)->first();
        if (is_null($model)) {
            foreach (config('locales.languages') as $key => $val) {
                $modelInLocale = $modelClass::where('slug->' . $key, $slug)->first();
                if ($modelInLocale) {

                    $newRoute = str_replace($slug, $modelInLocale->slug, urldecode(urlencode(route('posts.show', $modelInLocale->slug))));
                    return redirect()->to($newRoute)->send();
                }
            }
            abort(404);
        }
        return $model;
    }
}
