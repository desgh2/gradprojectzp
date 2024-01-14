<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\PersonController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {

    Route::view('/', 'dashboard')->name('dashboard');

    /**
     * Керівництво
     */
    Route::resource('person', PersonController::class);
    Route::patch('status/{person}', [PersonController::class, 'status'])->name('person.status');
    /**
     * Новини
     */
    Route::resource('post', PostController::class);
    Route::post('post/{post}', [PostController::class, 'status'])->name('post.status');
    /**
     * Категорії
     */
    Route::resource('category', CategoryController::class);
    Route::post('category/{category}', [CategoryController::class, 'status'])->name('category.status');



});

require __DIR__ . '/auth.php';

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); */


