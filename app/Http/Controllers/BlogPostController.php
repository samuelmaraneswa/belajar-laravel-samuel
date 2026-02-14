<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
  public function index(Request $request)
  {
    $search   = $request->query('search');
    $category = $request->query('category');
    $tema     = $request->query('tema'); // ⬅ tambahkan ini

    $posts = BlogPost::with(['category', 'tema'])
      ->when($search, function ($q) use ($search) {
        $q->where('title', 'like', "%{$search}%");
      })
      ->when($category, function ($q) use ($category) {
        $q->whereHas('category', function ($c) use ($category) {
          $c->where('slug', $category);
        });
      })
      ->when($tema, function ($q) use ($tema) {
        $q->whereHas('tema', function ($t) use ($tema) {
          $t->where('slug', $tema);
        });
      })
      ->latest()
      ->paginate(12)
      ->withQueryString();

    $categories = BlogCategory::orderBy('name')->get();

    return view('blog.posts.index', compact('posts', 'categories'));
  }

  public function show(BlogPost $post)
  {
    $similarPosts = BlogPost::with(['category'])
      ->where('category_id', $post->category_id)
      ->where('id', '!=', $post->id)
      ->take(6)
      ->get();

    return view('blog.posts.show', compact(
      'post',
      'similarPosts'
    ));
  }

  public function suggest(Request $request)
  {
    $q        = trim($request->query('q'));
    $category = $request->query('category');
    $tema     = $request->query('tema');

    if ($q === '') {
      return response()->json([]);
    }

    $query = BlogPost::query();

    $query->where('title', 'like', "%{$q}%");

    if ($category) {
      $query->whereHas('category', function ($c) use ($category) {
        $c->where('slug', $category);
      });
    }

    if ($tema) {
      $query->whereHas('tema', function ($t) use ($tema) {
        $t->where('slug', $tema);
      });
    }

    $titles = $query->orderBy('title')
      ->limit(20)
      ->pluck('title')
      ->values();

    return response()->json($titles);
  }
}
