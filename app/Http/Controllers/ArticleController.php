<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->latestPublished()
            ->with('company')
            ->paginate(12);

        return view('public.articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        if (!$article->is_published) {
            abort(404);
        }

        $article->load('company');
        $related = Article::published()
            ->where('company_id', $article->company_id)
            ->where('id', '!=', $article->id)
            ->latestPublished()
            ->take(3)
            ->get();

        return view('public.articles.show', [
            'article' => $article,
            'relatedArticles' => $related,
        ]);
    }
}
