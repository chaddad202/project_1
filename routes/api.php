<?php

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SlideShowController;
use App\Http\Controllers\StatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(
    ['middleware' => ['changeLanguage']],
    function () {

        Route::get('/announcement_index', [AnnouncementController::class, 'index']);
        Route::get('/announcement_show/{id}', [AnnouncementController::class, 'show']);
        Route::get('/category_index', [CategoryController::class, 'index']);
        Route::get('/category_show/{category_id}', [CategoryController::class, 'show']);
        Route::get('/service_index/{category_id}', [ServiceController::class, 'index']);
        Route::get('/service_show/{id}', [ServiceController::class, 'show']);
        Route::get('/contact_index', [ContactController::class, 'index']);
        Route::get('/contact_show/{id}', [ContactController::class, 'show']);
        Route::get('/status_show', [StatusController::class, 'show']);
    }
);


Route::get('/slide_show_index', [SlideShowController::class, 'index']);
Route::get('/slide_show_show/{id}', [SlideShowController::class, 'show']);
Route::get('/announcement_show_update/{id}', [AnnouncementController::class, 'show_for_update']);
Route::get('/category_show_update/{category_id}', [CategoryController::class, 'show_for_update']);
Route::get('/contact_show_update/{id}', [ContactController::class, 'show_for_update']);
Route::get('/slide_show_show_update/{id}', [SlideShowController::class, 'show']);
Route::post('/user_login', [LoginController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user_logout', [LoginController::class, 'logout']);
    Route::post('/service_store', [ServiceController::class, 'store']);
    Route::post('/service_update/{id}', [ServiceController::class, 'update']);
    Route::delete('/service_destroy/{id}', [ServiceController::class, 'destroy']);
    Route::post('/slide_show_store', [SlideShowController::class, 'store']);
    Route::post('/slide_show_update/{id}', [SlideShowController::class, 'update']);
    Route::delete('/slide_show_destroy/{id}', [SlideShowController::class, 'destroy']);
    Route::post('/category_store', [CategoryController::class, 'store']);
    Route::put('/category_update/{id}', [CategoryController::class, 'update']);
    Route::delete('/category_destroy/{id}', [CategoryController::class, 'destroy']);
    Route::post('/announcement_store', [AnnouncementController::class, 'store']);
    Route::post('/announcement_update/{id}', [AnnouncementController::class, 'update']);
    Route::delete('/announcement_destroy/{id}', [AnnouncementController::class, 'destroy']);
    Route::post('/contact_store', [ContactController::class, 'store']);
    Route::post('/contact_update/{id}', [ContactController::class, 'update']);
    Route::delete('/contact_destroy/{id}', [ContactController::class, 'destroy']);
    Route::get('/status_update', [StatusController::class, 'update']);
});
