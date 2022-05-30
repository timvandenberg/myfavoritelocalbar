<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PlaceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search-step-1', [SearchController::class, 'searchStep1'])->name('search-step-1');
Route::post('/search-step-2', [SearchController::class, 'searchStep2'])->name('search-step-2-post');
Route::post('/search-step-3', [SearchController::class, 'searchStep3'])->name('search-step-3-post');
Route::post('/search-step-4', [SearchController::class, 'searchStep4'])->name('search-step-4-post');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/bars', BarController::class);
    Route::post('/bars/connection', [BarController::class, 'connection'])->name('barsConnection');
});

Route::get('/map', [MapsController::class, 'index'])->name('map');

Route::post('/get-bars', [BarController::class, 'getBars'])->name('getBars');

Route::post('/search/bar', [BarController::class, 'search']);

require __DIR__.'/auth.php';
