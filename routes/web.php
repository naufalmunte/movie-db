<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MovieController::class, 'index'])->name('movies.index');
Route::get('/search', [MovieController::class, 'search'])->name('movies.search');

Route::get('/movie/{id}/{slug}', [MovieController::class, 'detail_movie'])->name('movies.detail_movie');

Route::resource('movies', MovieController::class);


Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create')->middleware('auth');
Route::post('/movies/store', [MovieController::class, 'store'])->name('movies.store')->middleware('auth');

Route::get('login', [AuthController::class, 'Formlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin/movies', [MovieController::class, 'showMovies'])->name('admin.movies.list');


