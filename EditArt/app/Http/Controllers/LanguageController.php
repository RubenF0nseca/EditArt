<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function switchLanguage($locale)
    {
        if (in_array($locale, ['en', 'pt'])) {
            App::SetLocale($locale);
            Session::put('locale', $locale);
        }
        return Redirect::back();
    }
}
