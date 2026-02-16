<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Company;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::getGroup('homepage');
        $companies = Company::active()->ordered()->take(6)->get();
        $articles = Article::published()->latestPublished()->with('company')->take(4)->get();

        return view('public.home', compact('settings', 'companies', 'articles'));
    }
}
