<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function changeLocale($locale){
        app()->setLocale($locale);
        session()->put('locale', $locale); //simpan dlm session supaya next page akan redirect ke localization setted

        return redirect()->back();
    }
}
