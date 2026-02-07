<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTema;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
  public function index()
  {
    $posts = BlogPost::with(['category', 'tema'])
      ->latest()
      ->get();

    return view('admin.blog.posts.index', compact('posts'));
  }

  public function create()
  {
    $categories = BlogCategory::where('is_active', true)->get();
    $temas      = BlogTema::where('is_active', true)->get();

    return view('admin.blog.posts.create', compact('categories', 'temas'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'category_id' => 'required|exists:blog_categories,id',
      'tema_id'     => 'required|exists:blog_tema,id',
      'title'       => 'required|string|max:255',
      'content'     => 'required',
    ]);

    $post = BlogPost::create([
      'category_id' => $validated['category_id'],
      'tema_id'     => $validated['tema_id'],
      'title'       => $validated['title'],
      'slug'        => Str::slug($validated['title']),
      'content'     => $validated['content'],
      'is_published' => $request->boolean('is_published'),
      'published_at' => $request->boolean('is_published') ? now() : null,
    ]);

    /*
        |--------------------------------------------------------------------------
        | FUTURE EXTENSION (nanti)
        |--------------------------------------------------------------------------
        | if ($request->category === 'calisthenics') {
        |   $post->workoutDetail()->create([...]);
        | }
        |
        | if ($request->category === 'cooking') {
        |   $post->recipeDetail()->create([...]);
        | }
        */

    return redirect()
      ->route('admin.blog.posts.index')
      ->with('success', 'Post berhasil dibuat');
  }

  public function edit(BlogPost $blogPost)
  {
    $categories = BlogCategory::where('is_active', true)->get();
    $temas      = BlogTema::where('is_active', true)->get();

    return view(
      'admin.blog.posts.edit',
      compact('blogPost', 'categories', 'temas')
    );
  }

  public function update(Request $request, BlogPost $blogPost)
  {
    $validated = $request->validate([
      'category_id' => 'required|exists:blog_categories,id',
      'tema_id'     => 'required|exists:blog_tema,id',
      'title'       => 'required|string|max:255',
      'content'     => 'required',
    ]);

    $blogPost->update([
      'category_id' => $validated['category_id'],
      'tema_id'     => $validated['tema_id'],
      'title'       => $validated['title'],
      'slug'        => Str::slug($validated['title']),
      'content'     => $validated['content'],
      'is_published' => $request->boolean('is_published'),
      'published_at' => $request->boolean('is_published') ? now() : null,
    ]);

    return redirect()
      ->route('admin.blog.posts.index')
      ->with('success', 'Post berhasil diupdate');
  }

  public function destroy(BlogPost $blogPost)
  {
    $blogPost->delete();

    return redirect()
      ->route('admin.blog.posts.index')
      ->with('success', 'Post berhasil dihapus');
  }
}
