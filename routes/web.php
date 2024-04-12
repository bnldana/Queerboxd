<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReviewController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/create', [FilmController::class, 'create'])->name('films.create');
Route::post('/films', [FilmController::class, 'store'])->name('films.store');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');

Route::post('/tmdb-search', [FilmController::class, 'search']);

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
