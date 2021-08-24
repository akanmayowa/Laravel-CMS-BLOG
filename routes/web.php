<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\SettingsController;
use App\Models\Post;
use App\Models\Category;
use App\Models\Setting;


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/', [FrontController::class, 'index'])->name('home');


Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/post/index', [PostsController::class, 'index'])->name('post.index');

    Route::get('/post/create', [PostsController::class, 'create'])->name('post.create');

    Route::post('/post/store', [PostsController::class, 'store'])->name('post.store');

    Route::get('/post/delete/{id}', [PostsController::class, 'destroy'])->name('post.delete');

    Route::get('/post/trashed/', [PostsController::class, 'trashed'])->name('post.trashed');

    Route::get('/post/kill/{id}', [PostsController::class, 'kill'])->name('post.kill');

    Route::get('/post/restore/{id}', [PostsController::class, 'restore'])->name('post.restore');

    Route::get('post/edit/{id}', [PostsController::class, 'edit'])->name('post.edit');

    Route::post('post/update/{id}', [PostsController::class, 'update'])->name('post.update');

    Route::get('/category/create', [CategoriesController::class, 'create'])->name('category.create');

    Route::post('/category/store', [CategoriesController::class, 'store'])->name('category.store');

    Route::get('/category/index', [CategoriesController::class, 'index'])->name('category.index');

    Route::get('/category/edit/{id}', [CategoriesController::class, 'edit'])->name('category.edit');

    Route::get('/category/delete/{id}', [CategoriesController::class, 'destroy'])->name('category.delete');

    Route::post('/category/update/{id}', [CategoriesController::class, 'update'])->name('category.update');

    Route::get('/tag/index', [TagController::class, 'index'])->name('tag.index');

    Route::get('/tag/create', [TagController::class, 'create'])->name('tag.create');

    Route::get('/tag/delete/{id}', [TagController::class, 'destroy'])->name('tag.delete');

    Route::get('/tag/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');

    Route::post('/tag/update/{id}', [TagController::class, 'update'])->name('tag.update');

    Route::post('/tag/store', [TagController::class, 'store'])->name('tag.store');

    Route::get('/users/index', [UsersController::class, 'index'])->name('users.index');

    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');

    Route::post('/users/store', [UsersController::class, 'store'])->name('users.store');

    Route::get('/users/delete/{id}', [UsersController::class, 'destroy'])->name('users.delete');

    Route::get('/users/make_admin/{id}', [UsersController::class, 'make_admin'])->name('users.make_admin');

    Route::get('/users/notmake_admin/{id}', [UsersController::class, 'notmake_admin'])->name('users.notmake_admin');

    Route::get('users/profile', [ProfilesController::class, 'index'])->name('users.profile');

    Route::post('/users/profile/update/', [ProfilesController::class, 'update'])->name('users.profile.update');

    Route::get('/settings/settings/', [SettingsController::class, 'index'])->name('settings.settings')->middleware('admin');

    Route::post('/settings/settings/update/', [SettingsController::class, 'update'])->name('settings.update')->middleware('admin');

    Route::get('/{slug}', [FrontController::class, 'singlepost'])->name('post.single');

    Route::get('/category/{id}', [FrontController::class, 'category'])->name('category.single');

    Route::get('/result', function () {
        $posts = Post::where('title', 'like', '%'. request('query'). '%');
        return view('results')
        ->with('posts', $posts)
        ->with('title', request('query'))
        ->with('categories', Category::take(5)->get())
        ->with('settings', Setting::first())
        ->with('query', request('query'));

    });

});
