<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::active()->ordered()->get();
        return view('public.companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        if (!$company->is_active) {
            abort(404);
        }

        $articles = $company->publishedArticles()->paginate(10);
        return view('public.companies.show', compact('company', 'articles'));
    }
}
