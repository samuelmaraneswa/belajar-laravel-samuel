<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogTema;
use App\Models\BlogPost;

class BlogController extends Controller
{
  // =========================
  // BLOG DASHBOARD (CATEGORIES)
  // =========================
  public function index()
  {
    $totalPosts = BlogPost::count();

    $categories = BlogCategory::withCount('posts')
      ->orderBy('name')
      ->get();

    return view('blog.index', compact(
      'totalPosts',
      'categories'
    ));
  }

  // =========================
  // TEMAS BY CATEGORY
  // =========================
  public function category(BlogCategory $category)
  {
    $temas = BlogTema::where('category_id', $category->id)
      ->withCount('posts')
      ->orderBy('name')
      ->get();

    return view('blog.temas.index', compact(
      'category',
      'temas'
    ));
  }
}
