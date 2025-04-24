<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route halaman home
Route::get('/', function () {
    $articles = \App\Models\Article::orderBy('published_at', 'desc')->paginate(5); // Gunakan paginate
    return view('frontend.home', compact('articles'));
})->name('home');

// Route detail artikel
Route::get('/article/{id}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('article.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/search', [ArticleController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    route::resource(name: 'users', controller: \App\Http\Controllers\UserController::class);
    Route::resource(name: 'articles', controller: \App\Http\Controllers\ArticleController::class);

});

require __DIR__.'/auth.php';
