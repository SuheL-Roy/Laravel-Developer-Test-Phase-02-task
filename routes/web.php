<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublicController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/{page?}', function ($page = null) {
//     $page = $page ?? 'index.html';

//     $path = public_path("html/{$page}");

//     if (File::exists($path)) {
//         return response()->file($path);
//     }

//     abort(404);
// });

Route::get('/', function () {
  $all_posts = Post::latest()->paginate(10);
  return view('public_post_list', compact('all_posts'));
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* ----------Public Blog----------------*/
Route::get('/blog-details', [PublicController::class, 'blog_details'])->name('blog_details');
Route::get('/blog', [PublicController::class, 'blog'])->name('blog');


/* ----------Admin Post Manage----------------*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
  Route::get('search-title', [PostController::class, 'search_title'])->name('search_title');
  Route::get('create-post', [PostController::class, 'create_post'])->name('create_post');
  Route::get('get-post', [PostController::class, 'get_post'])->name('get_post');
  Route::post('store', [PostController::class, 'store'])->name('posts');
  Route::get('destroy', [PostController::class, 'destroy'])->name('destroy');
  Route::post('update', [PostController::class, 'update'])->name('update');
});

/* ----------Admin Post Manage----------------*/
Route::middleware('auth')->prefix('admin')->name('category.')->group(function () {
  Route::get('create-category', [CategoryController::class, 'create_category'])->name('create_category');
  Route::post('store-category', [CategoryController::class, 'store_category'])->name('store_category');
  Route::get('destroy-category', [CategoryController::class, 'destroy_category'])->name('destroy_category');
});
