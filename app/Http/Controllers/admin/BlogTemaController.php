<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTema;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogTemaController extends Controller
{
  public function index()
  {
    $temas = BlogTema::with('category')
      ->latest()
      ->get();

    $categories = BlogCategory::where('is_active', true)->get();

    return view('admin.blog.tema.index', compact('temas', 'categories'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'category_id' => 'required|exists:blog_categories,id',
      'name'        => 'required|string|max:255',
    ]);

    $tema = BlogTema::create([
      'category_id' => $validated['category_id'],
      'name'        => $validated['name'],
      'slug'        => Str::slug($validated['name']),
      'description' => $request->description,
      'is_active'   => $request->boolean('is_active'),
    ]);

    return response()->json([
      'message' => 'Tema berhasil ditambahkan',
      'html' => view(
        'admin.blog.tema._row',
        ['tema' => $tema->load('category')]
      )->render(),
    ], 201);
  }

  public function update(Request $request, BlogTema $blogTema)
  {
    $validated = $request->validate([
      'category_id' => 'required|exists:blog_categories,id',
      'name'        => 'required|string|max:255',
    ]);

    $blogTema->update([
      'category_id' => $validated['category_id'],
      'name'        => $validated['name'],
      'slug'        => Str::slug($validated['name']),
      'description' => $request->description,
      'is_active'   => $request->boolean('is_active'),
    ]);

    return response()->json([
      'message' => 'Tema berhasil diupdate',
      'html' => view(
        'admin.blog.tema._row',
        ['tema' => $blogTema->load('category')]
      )->render(),
    ]);
  }

  public function destroy(BlogTema $blogTema)
  {
    $blogTema->delete();

    return response()->json([
      'message' => 'Tema berhasil dihapus',
    ]);
  }
}
