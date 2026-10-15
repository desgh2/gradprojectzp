<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\PersonController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\ProjectController;
use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\FeedbackController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\RealEstateController;
use App\Http\Controllers\Dashboard\EstateOrderController;
use App\Http\Controllers\Dashboard\AdvertController;
use App\Http\Controllers\Dashboard\FileUploadController;
use App\Livewire\Front\Contact;
use App\Livewire\Front\Project;
use App\Livewire\Front\Projects;
use App\Livewire\Front\RealEstate;
use App\Livewire\Front\Advert;
use App\Livewire\Front\Category;
use App\Livewire\Front\Department;
use App\Livewire\Front\SubCategory;
use App\Livewire\Front\Feedback;
use App\Livewire\Front\News;
use App\Livewire\Front\Persons;
use App\Livewire\Front\Post;
use App\Livewire\Front\RealEstateShow;
use App\Livewire\Front\AdvertShow;
use App\Livewire\Front\Search;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
| Here is where you can register web routes for your application. These
|
*/



Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {


    Route::view('/', 'dashboard')->name('dashboard');

    Route::post('upload/files', [FileUploadController::class, 'upload'])->name('fileupload');

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

    /**
     * Проєкти
     */
    Route::resource('project', ProjectController::class);
    Route::post('project/{project}', [ProjectController::class, 'status'])->name('project.status');

    /**
     * Відділи
     */
    Route::resource('department', DepartmentController::class);
    //dd('asd');
    Route::post('department/{department}', [DepartmentController::class, 'status'])->name('department.status');

    /**
     * Користувачі
     */
    Route::resource('user', UserController::class);

    /**
     * Нерухоме майно
     */
    Route::resource('estate', RealEstateController::class);
    Route::post('status/{real_estate}', [RealEstateController::class, 'status'])->name('estate.status');
    //Заявки на нерухомість
    Route::resource('order', EstateOrderController::class);
    Route::post('order/{order}', [EstateOrderController::class, 'status'])->name('order.status');
    /**
     * Рекламні оголошення
     */
    Route::resource('advert', AdvertController::class);
    Route::post('advert/{advert}', [AdvertController::class, 'status'])->name('advert.status');

    /**
     * Налаштування
     */
    Route::resource('setting', SettingController::class);

    /**
     * Зворотній зв’язок
     */
    Route::resource('feedback', FeedbackController::class);
    Route::post('feedback/{feedback}', [FeedbackController::class, 'status'])->name('feedback.status');
});

//Авторизація
require __DIR__ . '/auth.php';

//Головна
// Route::view('/', 'gg');
Route::get('/', HomePage::class)->name('front.index');
//карта сайта html
Route::view('sitemap.html', 'sitemap.sitemap_html');
//карта сайта index
Route::get('sitemap.xml', function () {
    return response()->view('sitemap.sitemap')->header('Content-type', 'text/xml');
});
//Контакти
Route::get('/contacts', Contact::class)->name('front.contact');
//Зворотній зв’язок
Route::get('/feedback', Feedback::class)->name('front.feedback');
//Проєкти
Route::get('/projects', Projects::class)->name('front.projects');
//Нерухоме майно
Route::get('/real-estate', RealEstate::class)->name('front.realestate');
//Рекламні оголошення   
Route::get('/advert', Advert::class)->name('front.advert');
//Новини
Route::get('/news', News::class)->name('front.news');
//Пошук
Route::get('/search', Search::class)->name('front.search');
//відділ
Route::get('/departments/{department:slug}', Department::class)->name('front.department');
//Нерухоме майно
Route::get('/real-estate/{estate:slug}', RealEstateShow::class)->name('front.realestate.show');
//Рекламні оголошення
Route::get('/advert/{advert:slug}', AdvertShow::class)->name('front.advert.show');
//Новина
Route::get('/news/{post:slug}', Post::class)->name('front.post');
//Проєкт
Route::get('/projects/{project:slug}', Project::class)->name('front.project');
//Ктегорії
Route::get('{category:slug}', Category::class)->name('front.category');
//Категорія
Route::get('{parent:slug}/{category:slug}', SubCategory::class)->name('front.subcategory');
