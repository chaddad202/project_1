<?php

use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SlideShowController;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Http\Controllers\StatusController;
use Symfony\Component\HttpFoundation\Request;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('login');
})->name('login.page');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');


Route::middleware(['check.token'])->group(
    function () {
        /////////////CATEGORY_ROUTE//////////////////
        Route::get('/category_page', function () {
            return view('category');
        })->name('category.page');
        Route::get('/category_add', function () {
            return view('add_category');
        })->name('category.add');
        Route::get('/category_index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/category_show', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/category_edit/{id}', [CategoryController::class, 'edit'])->name('category.edite');
        Route::delete('/category_destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::post('/category_update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/category_store', [CategoryController::class, 'store'])->name('category.store');


        ////////////////ADS_ROUTE////////////////////////////////
        Route::get('/ads_page', function () {
            return view('ads');
        })->name('ads.page');
        Route::get('/ads_add', function () {
            return view('add_ads');
        })->name('ads.add');
        Route::get('/ads_index', [AnnouncementController::class, 'index'])->name('ads.index');
        Route::get('/ads_show', [AnnouncementController::class, 'show'])->name('ads.show');
        Route::get('/ads_edit/{id}', [AnnouncementController::class, 'edit'])->name('ads.edite');
        Route::delete('/ads_destroy/{id}', [AnnouncementController::class, 'destroy'])->name('ads.destroy');
        Route::post('/ads_update/{id}', [AnnouncementController::class, 'update'])->name('ads.update');
        Route::post('/ads_store', [AnnouncementController::class, 'store'])->name('ads.store');


        ////////////////CONTACT_ROUTE/////////////////////
        Route::get('/contact_page', function () {
            return view('contact');
        })->name('contact.page');
        Route::get('/contact_add', function () {
            return view('add_contact');
        })->name('contact.add');
        Route::get('/contact_index', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/contact_show', [ContactController::class, 'show'])->name('contact.show');
        Route::get('/contact_edit/{id}', [ContactController::class, 'edit'])->name('contact.edite');
        Route::delete('/contact_destroy/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
        Route::post('/contact_update/{id}', [ContactController::class, 'update'])->name('contact.update');
        Route::post('/contact_store', [ContactController::class, 'store'])->name('contact.store');



        ///////////////////SLIDE SHOW ROUTE////////////////
        Route::get('/slideShow_page', function () {
            return view('slideShow');
        })->name('slideShow.page');
        Route::get('/slideShow_add', function () {
            return view('add_slideShow');
        })->name('slideShow.add');
        Route::get('/slideShow_index', [SlideShowController::class, 'index'])->name('slideShow.index');
        Route::get('/slideShow_show', [SlideShowController::class, 'show'])->name('slideShow.show');
        Route::get('/slideShow_edit/{id}', [SlideShowController::class, 'edit'])->name('slideShow.edite');
        Route::delete('/slideShow_destroy/{id}', [SlideShowController::class, 'destroy'])->name('slideShow.destroy');
        Route::post('/slideShow_update/{id}', [SlideShowController::class, 'update'])->name('slideShow.update');
        Route::post('/slideShow_store', [SlideShowController::class, 'store'])->name('slideShow.store');



        ///////////////STATUS ROUTE//////////////////////////////////////////////
        Route::get('/status_page', function () {
            $status = DB::table('statuses')->orderBy('id', 'desc')->first(); // الحصول على آخر حالة
            return view('status', ['status' => $status]);
        })->name('status.page');
        Route::get('/status_update', [StatusController::class, 'update'])->name('status.update');



        /////////////////////////////SERVICE ROUTE/////////////////////////

        Route::get('/service_page/{category_id}', function ($category_id) {
            return view('service', compact('category_id'));
        })->name('service.page');
        Route::get('/service_add/{category_id}', function ($category_id) {
            return view('add_service', compact('category_id'));
        })->name('service.add');
        Route::get('/service_index/{category_id}', [ServiceController::class, 'index'])->name('service.index');
        Route::post('/service_store', [ServiceController::class, 'store'])->name('service.store');
        Route::get('/service_show', [ServiceController::class, 'show'])->name('service.show');
        Route::get('/service_edit/{id}', [ServiceController::class, 'edit'])->name('service.edite');
        Route::delete('/service_destroy/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
        Route::post('/service_update/{id}', [ServiceController::class, 'update'])->name('service.update');


        /////////////////////////LOGOUT///////////////////////////
        Route::get('/user_logout', [LoginController::class, 'logout'])->name('user.logout');
    }
);
