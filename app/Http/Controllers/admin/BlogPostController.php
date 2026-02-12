<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BlogPostController extends Controller
{
  public function index(Request $request)
  {
    $query = BlogPost::with(['category', 'tema']);

    if ($request->filled('search')) {
      $query->where('title', 'like', '%' . $request->search . '%');
    }

    $posts = $query->latest()->paginate(20);

    if ($request->ajax()) {
      return response()->json([
        'html' => view('admin.blog.posts.partials.grid', compact('posts'))->render(),
        'pagination' => [
          'page' => $posts->currentPage(),
          'last' => $posts->lastPage(),
        ]
      ]);
    }

    return view('admin.blog.posts.index', compact('posts'));
  }

  public function create()
  {
    $categories = BlogCategory::where('is_active', true)->get();
    $temas      = BlogTema::where('is_active', true)->get();

    return view('admin.blog.posts.create', compact('categories', 'temas'));
  }

  public function temasByCategory($categoryId)
  {
    return BlogTema::where('is_active', true)
      ->where('category_id', $categoryId)
      ->select('id', 'name')
      ->get();
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'category_id' => 'required|exists:blog_categories,id',
      'tema_id'     => 'required|exists:blog_tema,id',
      'title'       => 'required|string|max:255',
      'excerpt'     => 'nullable|string',
      'content'     => 'required',

      'image'       => 'nullable|image|max:2048',
      'video_url'   => 'nullable|url',

      'progressions'                 => 'nullable|array',
      'progressions.*.name'          => 'nullable|string|max:255',
      'progressions.*.sets'          => 'nullable|integer',
      'progressions.*.reps'          => 'nullable|integer',
      'progressions.*.hold_seconds'  => 'nullable|integer',
      'progressions.*.weight'        => 'nullable|numeric',
    ]);

    // ⛔ CEK SLUG DUPLIKAT (BERDASARKAN TITLE)
    $slug = Str::slug($validated['title']);

    if (BlogPost::where('slug', $slug)->exists()) {
      return back()
        ->withErrors(['title' => 'Judul sudah digunakan, silakan ubah judul.'])
        ->withInput();
    }

    // upload image + generate thumb
    $imagePath = null;
    $thumbPath = null;

    if ($request->hasFile('image')) {

      // simpan file asli
      $imageFile = $request->file('image');
      $imagePath = $imageFile->store('blog/posts', 'public');

      // buat thumbnail
      $manager = new ImageManager(new Driver());

      $image = $manager->read(
        storage_path('app/public/' . $imagePath)
      )->orient();

      $thumbDirectory = storage_path('app/public/blog/thumb');

      if (!file_exists($thumbDirectory)) {
        mkdir($thumbDirectory, 0755, true);
      }

      $thumbPath = 'blog/thumb/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

      $thumb = clone $image;

      $thumb
        ->toWebp(70)
        ->save(storage_path('app/public/' . $thumbPath));
    }

    // === BLOG POST (GLOBAL) ===
    $post = BlogPost::create([
      'category_id'  => $validated['category_id'],
      'tema_id'      => $validated['tema_id'],
      'title'        => $validated['title'],
      'slug'         => Str::slug($validated['title']),
      'excerpt'      => $validated['excerpt'] ?? null,
      'content'      => $validated['content'],
      'image'        => $imagePath,
      'thumb'        => $thumbPath,
      'video_url'    => $validated['video_url'] ?? null,
      'status'       => $request->has('status') ? 'published' : 'draft',
      'published_at' => $request->has('status') ? now() : null,
    ]);

    // === CONDITIONAL: CALISTHENICS ===
    if ($request->filled('progressions')) {
      foreach ($request->progressions as $item) {
        if (empty($item['name'])) continue;

        $post->workoutDetails()->create([
          'progression'   => $item['name'],
          'sets'          => $item['sets'] ?? null,
          'reps'          => $item['reps'] ?? null,
          'hold_seconds'  => $item['hold_seconds'] ?? null,
          'weight'        => $item['weight'] ?? null,
        ]);
      }
    }

    return redirect()
      ->route('admin.blog.posts.index')
      ->with('success', 'Post berhasil dibuat');
  }

  public function edit(BlogPost $post)
  {
    $post->load('workoutDetails');

    $categories = BlogCategory::where('is_active', true)->get();
    $temas      = BlogTema::where('is_active', true)->get();

    return view('admin.blog.posts.edit', [
      'post'       => $post,
      'categories' => $categories,
      'temas'      => $temas,
    ]);
  }

  public function update(Request $request, BlogPost $blogPost)
  {
    // =====================
    // VALIDATION
    // =====================
    $validated = $request->validate([
      'category_id' => 'required|exists:blog_categories,id',
      'tema_id'     => 'required|exists:blog_tema,id',
      'title'       => 'required|string|max:255',
      'excerpt'     => 'nullable|string',
      'content'     => 'required',
      'image'       => 'nullable|image|max:2048',
      'progressions' => 'nullable|array',
    ]);

    // =====================
    // IMAGE (REPLACE + THUMB)
    // =====================
    if ($request->hasFile('image')) {

      // hapus image lama
      if ($blogPost->image && Storage::disk('public')->exists($blogPost->image)) {
        Storage::disk('public')->delete($blogPost->image);
      }

      // hapus thumb lama
      if ($blogPost->thumb && Storage::disk('public')->exists($blogPost->thumb)) {
        Storage::disk('public')->delete($blogPost->thumb);
      }

      // simpan image baru
      $imageFile = $request->file('image');
      $imagePath = $imageFile->store('blog/posts', 'public');

      // generate thumb baru
      $manager = new ImageManager(new Driver());

      $image = $manager->read(
        storage_path('app/public/' . $imagePath)
      )->orient();

      $thumbPath = 'blog/thumb/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

      $thumb = clone $image;

      $thumb
        ->toWebp(70)
        ->save(storage_path('app/public/' . $thumbPath));

      $validated['image'] = $imagePath;
      $validated['thumb'] = $thumbPath;
    }

    // =====================
    // UPDATE MAIN POST
    // =====================
    $blogPost->update([
      'category_id'  => $validated['category_id'],
      'tema_id'      => $validated['tema_id'],
      'title'        => $validated['title'],
      'slug'         => Str::slug($validated['title']),
      'excerpt'      => $validated['excerpt'] ?? null,
      'content'      => $validated['content'],
      'image'        => $validated['image'] ?? $blogPost->image,
      'thumb'        => $validated['thumb'] ?? $blogPost->thumb,
      'is_published' => $request->boolean('status'),
      'published_at' => $request->boolean('status') ? now() : null,
    ]);

    // =====================
    // SYNC WORKOUT PROGRESSIONS
    // =====================
    if ($request->filled('progressions')) {

      // ambil ID yang MASIH ADA di form
      $incomingIds = collect($request->progressions)
        ->pluck('id')
        ->filter()
        ->toArray();

      // 🔥 HAPUS DI DB YANG DITEKAN "X"
      $blogPost->workoutDetails()
        ->whereNotIn('id', $incomingIds)
        ->delete();

      // update / insert
      foreach ($request->progressions as $prog) {
        $blogPost->workoutDetails()->updateOrCreate(
          ['id' => $prog['id'] ?? null],
          [
            'progression'  => $prog['name'] ?? null,
            'sets'         => $prog['sets'] ?? null,
            'reps'         => $prog['reps'] ?? null,
            'hold_seconds' => $prog['hold_seconds'] ?? null,
            'weight'       => $prog['weight'] ?? null,
          ]
        );
      }
    } else {
      // jika semua progression dihapus di UI
      $blogPost->workoutDetails()->delete();
    }

    return redirect()
      ->route('admin.blog.posts.index', $blogPost->slug)
      ->with('success', 'Post berhasil diupdate');
  }

  public function destroy(BlogPost $post)
  {
    $post->delete();

    return redirect()
      ->route('admin.blog.posts.index')
      ->with('success', 'Post berhasil dihapus');
  }

  public function show(BlogPost $post)
  {
    $post->load(['category', 'tema', 'workoutDetails']);

    return view('admin.blog.posts.show', compact('post'));
  }

  public function suggest(Request $request)
  {
    $q = $request->q;

    $posts = BlogPost::where('title', 'like', "%{$q}%")
      ->limit(20)
      ->pluck('title');

    return response()->json($posts);
  }
}