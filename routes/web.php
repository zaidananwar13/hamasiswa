<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Pengguna;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ThreadController;
use App\Http\Middleware\AdminAuthorizer;
use App\Http\Middleware\Oauth;
use Illuminate\Support\Facades\Route;

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

// Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
//     ->name('ckfinder_connector');

// Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//     ->name('ckfinder_browser');

// Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
// ->name('ckfinder_examples');

Route::get('/', [ThreadController::class, 'main']);

Route::get('login', [Auth::class, 'login']);
Route::post('login/proc', [Auth::class, 'logPost']);
Route::get('register', [Auth::class, 'register']);
Route::post('register/proc', [Auth::class, 'regPost']);

Route::get('user/{id}', [Pengguna::class, 'profile']);

Route::get('logout', [Auth::class, 'logout']);

Route::middleware([Oauth::class])->group(function () {
    Route::get('/like/{type}', [ThreadController::class, 'like']);
    Route::get('/unlike/{type}', [ThreadController::class, 'unlike']);

    Route::get('/profile', [Pengguna::class, 'profile']);
    Route::get('/profile/edit', [Pengguna::class, 'edit']);
    Route::post('/profil/update', [Pengguna::class, 'update']);

    Route::get('/beranda', [ThreadController::class, 'index']);
    Route::resource('thread', ThreadController::class);
    
    Route::get('/report/thread/{id}', [ReportController::class, 'thread']);
    Route::post('/report/thread/banned', [ReportController::class, 'threadBan']);
    
    Route::post('/thread/addpost', [ThreadController::class, 'addpost']);
    Route::get('/thread/edit/{id}', [ThreadController::class, 'edit']);
    Route::post('/thread/uppost', [ThreadController::class, 'putpost']);
    Route::post('/thread/reply/{id}', [ThreadController::class, 'reply']);
});


Route::get('/dashboard/login', [AdminController::class, 'login']);
Route::post('/dashboard/logPost', [AdminController::class, 'logged']);
Route::middleware([AdminAuthorizer::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/dashboard/thread/{id}', [AdminController::class, 'thread']);
    Route::get('/dashboard/thread/bann/{id}', [AdminController::class, 'bann']);
});
