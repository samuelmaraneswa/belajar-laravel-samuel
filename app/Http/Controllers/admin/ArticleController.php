<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ArticleController extends Controller
{
  public function index()
  {
    $articles = Article::latest()->paginate(10);

    return view('admin.articles.index', compact('articles'));
  }

  public function list(Request $request)
  {
    $search = $request->search;

    $articles = Article::query()
      ->when($search, function ($query) use ($search) {
        $query->where('title', 'like', "%{$search}%");
      })
      ->latest()
      ->paginate(10);

    return view('admin.articles.partials._table', compact('articles'))->render();
  }

  public function create()
  {
    return view('admin.articles.partials._form');
  }

  public function uploadImage(Request $request)
  {
    $request->validate([
      'image' => 'required|image|max:2048'
    ]);

    $path = $request->file('image')->store('temp', 'public');

    return response()->json([
      'location' => asset('storage/' . $path)
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'title'   => 'required|string|max:255',
      'content' => 'required',
      'image'   => 'nullable|image|max:10048',
      'video'   => 'nullable|string'
    ]);

    $content = $request->content;

    // 🔥 pindahkan temp image dari editor
    preg_match_all('/storage\/temp\/([^"]+)/', $content, $matches);

    if (!empty($matches[1])) {
      foreach ($matches[1] as $file) {

        $from = 'temp/' . $file;
        $to   = 'foods/' . $file;

        if (Storage::disk('public')->exists($from)) {
          Storage::disk('public')->move($from, $to);
        }

        $content = str_replace(
          '/storage/temp/' . $file,
          '/storage/foods/' . $file,
          $content
        );
      }
    }

    $imagePath = null;
    $thumbPath = null;

    if ($request->hasFile('image')) {

      // simpan file asli
      $imageFile = $request->file('image');
      $imagePath = $imageFile->store('foods', 'public');

      // generate thumb webp (quality 70)
      $manager = new ImageManager(new Driver());

      $image = $manager->read(
        storage_path('app/public/' . $imagePath)
      )->orient();

      $thumbDirectory = storage_path('app/public/foods/thumb');

      if (!file_exists($thumbDirectory)) {
        mkdir($thumbDirectory, 0755, true);
      }

      $thumbPath = 'foods/thumb/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

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
    $request->validate([
      'title'   => 'required|string|max:255',
      'content' => 'required',
      'image'   => 'nullable|image|max:10048',
      'video'   => 'nullable|string'
    ]);

    $oldContent = $article->content;
    $newContent = $request->content;

    /*
  |--------------------------------------------------------------------------
  | 1️⃣ HAPUS GAMBAR YANG SUDAH TIDAK ADA DI CONTENT
  |--------------------------------------------------------------------------
  */
    preg_match_all('/storage\/foods\/([^"]+)/', $oldContent, $oldMatches);
    preg_match_all('/storage\/foods\/([^"]+)/', $newContent, $newMatches);

    $oldImages = $oldMatches[1] ?? [];
    $newImages = $newMatches[1] ?? [];

    $imagesToDelete = array_diff($oldImages, $newImages);

    foreach ($imagesToDelete as $file) {
      $path = 'foods/' . $file;

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
        $to   = 'foods/' . $file;

        if (Storage::disk('public')->exists($from)) {
          Storage::disk('public')->move($from, $to);
        }

        $newContent = str_replace(
          '/storage/temp/' . $file,
          '/storage/foods/' . $file,
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
      $imagePath = $imageFile->store('foods', 'public');

      $manager = new ImageManager(new Driver());

      $image = $manager->read(
        storage_path('app/public/' . $imagePath)
      )->orient();

      $thumbDirectory = storage_path('app/public/foods/thumb');

      if (!file_exists($thumbDirectory)) {
        mkdir($thumbDirectory, 0755, true);
      }

      $thumbPath = 'foods/thumb/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

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
    $article->delete();

    return response()->json(['success' => true]);
  }
}
