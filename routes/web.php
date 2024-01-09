<?php

use App\Http\Controllers\Dashboard\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\CategoryController;
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
     * Категорії
     */
    Route::resource('category', CategoryController::class);
    Route::post('category/{category}', [CategoryController::class, 'status'])->name('category.status');

    /**
     * Керівництво
     */
    Route::resource('person', PersonController::class);
    Route::patch('status/{person}', [PersonController::class, 'status'])->name('person.status');
    // Route::patch('category/{category}', [CategoryController::class, 'status'])->name('category.status');
    //Route::patch('status/{person}', [CategoryController::class, 'status'])->name('person.status');
    //настройки сайта
    /* Route::resource('setting', SettingController::class);
    //категории
    Route::get('category/likes', [CategoryController::class, 'categoryLike']);
    Route::resource('category', CategoryController::class);
    Route::patch('category/status/{category}', [CategoryController::class, 'status'])->name('category.status');

    //изображения
    Route::get('photo/likes', 'Admin\PhotoController@photoLike');
    // Route::get('photo/search', 'Admin\PhotoController@search')->name('photo.search');
    // Route::resource('photo', 'Admin\PhotoController');
    Route::resource('photo', PhotoController::class);
    Route::patch('photo/status/{photo}', [PhotoController::class, 'status'])->name('photo.status');
    // Route::post('photo/status', 'Admin\PhotoController@status')->name('photo.status');
    //сообщения
    Route::get('message', 'ContactController@index')->name('message');
    Route::delete('message/destroy', 'ContactController@destroy')->name('message.destroy'); */
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


