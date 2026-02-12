<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTema;
use Illuminate\Http\Request;

class BlogController extends Controller
{
  public function index()
  {
    return view('admin.blog.index', [
      'totalPosts' => BlogPost::count(),
      'categories' => BlogCategory::withCount('posts')->get(),
    ]);
  }
}
