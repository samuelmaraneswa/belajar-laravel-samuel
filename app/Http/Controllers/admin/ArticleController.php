<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ArticleController extends Controller
{
  public function index(Request $request)
  {
    $query = Article::query();

    if ($request->filled('search')) {
      $query->where('title', 'like', '%' . $request->search . '%');
    }

    $articles = $query->latest()->paginate(30);

    if ($request->ajax()) {
      return response()->json([
        'html' => view('admin.articles.partials._table', compact('articles'))->render(),
        'pagination' => [
          'page' => $articles->currentPage(),
          'last' => $articles->lastPage(),
        ]
      ]);
    }

    return view('admin.articles.index', compact('articles'));
  }

  public function create()
  {
    return view('admin.articles.partials._form');
  }

  public function uploadImage(Request $request)
  {
    $request->validate([
      'image' => 'required|image|max:10048'
    ]);

    $path = $request->file('image')->store('temp', 'public');

    return response()->json([
      'location' => asset('storage/' . $path)
    ]);
  }

  public function store(Request $request)
  {
    try {

      $request->validate([
        'title'   => 'required|string|max:255',
        'content' => 'required',
        'image'   => 'nullable|image|max:10048',
        'video'   => 'nullable|string'
      ]);
    } catch (ValidationException $e) {

      return response()->json([
        'errors' => $e->errors()
      ], 422);
    }

    $content = $request->content;

    // pindahkan temp image dari editor
    preg_match_all('/storage\/temp\/([^"]+)/', $content, $matches);

    if (!empty($matches[1])) {
      foreach ($matches[1] as $file) {

        $from = 'temp/' . $file;
        $to   = 'articles/' . $file;

        if (Storage::disk('public')->exists($from)) {
          Storage::disk('public')->move($from, $to);
        }

        $content = str_replace(
          '/storage/temp/' . $file,
          '/storage/articles/' . $file,
          $content
        );
      }
    }

    $imagePath = null;
    $thumbPath = null;

    if ($request->hasFile('image')) {

      // simpan file asli
      $imageFile = $request->file('image');
      $imagePath = $imageFile->store('articles', 'public');

      $manager = new ImageManager(new Driver());

      $image = $manager->read(
        storage_path('app/public/' . $imagePath)
      )->orient();

      $thumbDirectory = storage_path('app/public/articles/thumb');

      if (!file_exists($thumbDirectory)) {
        mkdir($thumbDirectory, 0755, true);
      }

      $thumbPath = 'articles/thumb/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

      $thumb = clone $image;

      $thumb
        ->toWebp(70)
        ->save(storage_path('app/public/' . $thumbPath));
    }

    Article::create([
      'title'   => $request->title,
      'slug'    => Str::slug($request->title),
      'content' => $content,
      'video'   => $request->video,
      'image'   => $imagePath,
      'thumb'   => $thumbPath,
      'status'  => $request->status ?? 'draft'
    ]);

    return response()->json(['success' => true]);
  }

  public function cleanupTemp()
  {
    $files = Storage::disk('public')->files('temp');

    foreach ($files as $file) {
      Storage::disk('public')->delete($file);
    }

    return response()->json(['success' => true]);
  }

  public function show(Article $article)
  {
    return view('admin.articles.partials._show', compact('article'));
  }

  public function edit(Article $article)
  {
    return view('admin.articles.partials._form', compact('article'));
  }

  public function update(Request $request, Article $article)
  {
    try {

      $request->validate([
        'title'   => 'required|string|max:255',
        'content' => 'required',
        'image'   => 'nullable|image|max:10048',
        'video'   => 'nullable|string'
      ]);
    } catch (ValidationException $e) {

      return response()->json([
        'errors' => $e->errors()
      ], 422);
    }

    $oldContent = $article->content;
    $newContent = $request->content;

    /*
|--------------------------------------------------------------------------
| 1️⃣ HAPUS GAMBAR YANG SUDAH TIDAK ADA DI CONTENT
|--------------------------------------------------------------------------
*/
    preg_match_all('/storage\/articles\/([^"]+)/', $oldContent, $oldMatches);
    preg_match_all('/storage\/articles\/([^"]+)/', $newContent, $newMatches);

    $oldImages = $oldMatches[1] ?? [];
    $newImages = $newMatches[1] ?? [];

    $imagesToDelete = array_diff($oldImages, $newImages);

    foreach ($imagesToDelete as $file) {
      $path = 'articles/' . $file;

      if (Storage::disk('public')->exists($path)) {
        Storage::disk('public')->delete($path);
      }
    }

    /*
|--------------------------------------------------------------------------
| 2️⃣ PINDAHKAN TEMP IMAGE BARU
|--------------------------------------------------------------------------
*/
    preg_match_all('/storage\/temp\/([^"]+)/', $newContent, $tempMatches);

    if (!empty($tempMatches[1])) {
      foreach ($tempMatches[1] as $file) {

        $from = 'temp/' . $file;
        $to   = 'articles/' . $file;

        if (Storage::disk('public')->exists($from)) {
          Storage::disk('public')->move($from, $to);
        }

        $newContent = str_replace(
          '/storage/temp/' . $file,
          '/storage/articles/' . $file,
          $newContent
        );
      }
    }

    /*
    |--------------------------------------------------------------------------
    | 3️⃣ HANDLE THUMB IMAGE JIKA DIGANTI
    |--------------------------------------------------------------------------
    */
    $imagePath = $article->image;
    $thumbPath = $article->thumb;

    if ($request->hasFile('image')) {

      // hapus lama
      if ($article->image && Storage::disk('public')->exists($article->image)) {
        Storage::disk('public')->delete($article->image);
      }

      if ($article->thumb && Storage::disk('public')->exists($article->thumb)) {
        Storage::disk('public')->delete($article->thumb);
      }

      // simpan baru
      $imageFile = $request->file('image');
      $imagePath = $imageFile->store('articles', 'public');

      $manager = new ImageManager(new Driver());

      $image = $manager->read(
        storage_path('app/public/' . $imagePath)
      )->orient();

      $thumbDirectory = storage_path('app/public/articles/thumb');

      if (!file_exists($thumbDirectory)) {
        mkdir($thumbDirectory, 0755, true);
      }

      $thumbPath = 'articles/thumb/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

      $thumb = clone $image;

      $thumb
        ->toWebp(70)
        ->save(storage_path('app/public/' . $thumbPath));
    }

    /*
    |--------------------------------------------------------------------------
    | 4️⃣ UPDATE DATABASE
    |--------------------------------------------------------------------------
    */
    $article->update([
      'title'   => $request->title,
      'slug'    => Str::slug($request->title),
      'content' => $newContent,
      'video'   => $request->video,
      'image'   => $imagePath,
      'thumb'   => $thumbPath,
      'status'  => $request->status ?? 'draft'
    ]);

    return response()->json(['success' => true]);
  }

  public function destroy(Article $article)
  {
    // 🔥 1️⃣ Hapus semua gambar dari content (TinyMCE)
    preg_match_all('/storage\/articles\/([^"]+)/', $article->content, $matches);

    $images = $matches[1] ?? [];

    foreach ($images as $file) {

      $path = 'articles/' . $file;

      if (Storage::disk('public')->exists($path)) {
        Storage::disk('public')->delete($path);
      }
    }

    // 🔥 2️⃣ Hapus image utama
    if ($article->image && Storage::disk('public')->exists($article->image)) {
      Storage::disk('public')->delete($article->image);
    }

    // 🔥 3️⃣ Hapus thumbnail webp
    if ($article->thumb && Storage::disk('public')->exists($article->thumb)) {
      Storage::disk('public')->delete($article->thumb);
    }

    $article->delete();

    return response()->json(['success' => true]);
  }

  public function suggest(Request $request)
  {
    $q = $request->q;

    $articles = Article::where('title', 'like', "%{$q}%")
      ->limit(20)
      ->pluck('title');

    return response()->json($articles);
  }
}
