<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('company')->latest('created_at')->paginate(20);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $companies = Company::active()->ordered()->get();
        return view('admin.articles.form', [
            'article' => new Article(),
            'companies' => $companies,
        ]);
    }

    public function store(ArticleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('articles/covers', 'public');
        }

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        if (!empty($data['is_published']) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Articolul a fost creat cu succes.');
    }

    public function edit(Article $article)
    {
        $companies = Company::active()->ordered()->get();
        return view('admin.articles.form', compact('article', 'companies'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            if ($article->cover_image) {
                Storage::disk('public')->delete($article->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('articles/covers', 'public');
        }

        if (!empty($data['is_published']) && empty($article->published_at) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Articolul a fost actualizat cu succes.');
    }

    public function destroy(Article $article)
    {
        if ($article->cover_image) {
            Storage::disk('public')->delete($article->cover_image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Articolul a fost șters.');
    }
}
