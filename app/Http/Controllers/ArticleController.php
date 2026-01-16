<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of published articles.
     */
    public function index()
    {
        $articles = Article::published()
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $featuredArticles = Article::published()
            ->featured()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('pages.articles', compact('articles', 'featuredArticles'));
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        // Only show published articles
        if (! $article->is_published || $article->published_at > now()) {
            abort(404);
        }

        // Increment view count
        $article->incrementViews();

        // Get related articles
        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('pages.article-details', compact('article', 'relatedArticles'));
    }
}
