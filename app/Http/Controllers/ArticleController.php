<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->query('search');

    $articles = Article::query()
      ->where('status', 'published') // hanya tampilkan yang publish
      ->when($search, function ($q) use ($search) {
        $q->where('title', 'like', "%{$search}%");
      })
      ->latest()
      ->paginate(30)
      ->withQueryString();

    return view('articles.index', compact('articles'));
  }

  public function show(Article $article)
  {
    // pastikan hanya published yang bisa dibuka
    if ($article->status !== 'published') {
      abort(404);
    }

    $similarArticles = Article::where('status', 'published')
      ->where('id', '!=', $article->id)
      ->latest()
      ->take(6)
      ->get();

    return view('articles.show', compact(
      'article',
      'similarArticles'
    ));
  }

  public function suggest(Request $request)
  {
    $q = trim($request->query('q'));

    if ($q === '') {
      return response()->json([]);
    }

    $titles = Article::where('status', 'published')
      ->where('title', 'like', "%{$q}%")
      ->orderBy('title')
      ->limit(20)
      ->pluck('title')
      ->values();

    return response()->json($titles);
  }
}
