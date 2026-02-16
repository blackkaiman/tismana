<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Company;
use App\Models\ContactMessage;
use App\Models\Page;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'companies' => Company::count(),
            'articles' => Article::count(),
            'pages' => Page::count(),
            'published_articles' => Article::published()->count(),
            'unread_messages' => ContactMessage::unread()->count(),
        ];

        $latestArticles = Article::with('company')->latest('created_at')->take(5)->get();
        $latestMessages = ContactMessage::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestArticles', 'latestMessages'));
    }
}
