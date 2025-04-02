<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::prefix('movie')->group(function () {
    Route::get('{movie}/actors', [MovieController::class, 'actors'])->name('movie.actors');
    Route::post('{movie}/attach', [MovieController::class, 'attach'])->name('movie.attach');
    Route::delete('{movie}/detach/{artist}', [MovieController::class, 'detach'])->name('movie.detach');
});

// Route::prefix('artist')->group(function () {
//     Route::get('{artist}/artist', [ArtistController::class, 'artist']->name('artist.artist'));
// });

Route::resource('artist', ArtistController::class);

Route::resource('movie', MovieController::class);

Route::resource('country', CountryController::class);
