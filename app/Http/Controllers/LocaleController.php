<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LocaleController extends Controller
{
    public function switch($local) {

        $segments = request()->create(url()->previous())->segments();
        $segments[0] = $local;

        $redirectUrl = implode('/', $segments);

        return redirect()->to($redirectUrl);

    }
}
