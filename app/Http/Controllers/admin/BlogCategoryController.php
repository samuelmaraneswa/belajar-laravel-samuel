<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
  public function index()
  {
    $categories = BlogCategory::latest()->get();

    return view('admin.blog.categories.index', compact('categories'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $category = BlogCategory::create([
      'name'        => $validated['name'],
      'slug'        => Str::slug($validated['name']),
      'description' => $request->description,
      'is_active'   => $request->boolean('is_active'),
    ]);

    return response()->json([
      'message' => 'Category berhasil ditambahkan',
      'html' => view(
        'admin.blog.categories._row',
        ['category' => $category]
      )->render(),
    ], 201);
  }

  public function update(Request $request, BlogCategory $blogCategory)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $blogCategory->update([
      'name'        => $validated['name'],
      'slug'        => Str::slug($validated['name']),
      'description' => $request->description,
      'is_active'   => $request->boolean('is_active'),
    ]);

    return response()->json([
      'message' => 'Category berhasil diupdate',
      'html' => view(
        'admin.blog.categories._row',
        ['category' => $blogCategory]
      )->render(),
    ]);
  }

  public function destroy(BlogCategory $blogCategory)
  {
    $blogCategory->delete();

    return response()->json([
      'message' => 'Category berhasil dihapus',
    ]);
  }
}
