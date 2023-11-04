<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ClientsMessagesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\PostController;

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

Route::group(['prefix' => 'manager','middleware' => 'auth'], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home')->middleware(['middleware' => 'role:root,mngr,cnt,sc']);
    Route::any('posts/update/{id}', [App\Http\Controllers\Admin\PostController::class, 'newsort'])->name('posts.newsort')->middleware(['middleware' => 'role:root,sc']);
    Route::resource('posts', PostController::class)->middleware(['middleware' => 'role:root,sc']);
    Route::resource('clients', ClientController::class)->middleware(['middleware' => 'role:root,mngr']);
    Route::any('clients/update/{id}', [App\Http\Controllers\Admin\ClientController::class, 'newstatus'])->name('clients.newstatus')->middleware(['middleware' => 'role:root,mngr']);
    Route::resource('clients-messages', ClientsMessagesController::class)->middleware(['middleware' => 'role:root,mngr']);
    Route::get('noread', [App\Http\Controllers\Admin\ClientsMessagesController::class, 'noread'])->name('clientmessages.noread')->middleware(['middleware' => 'role:root,mngr']);
    Route::get('read', [App\Http\Controllers\Admin\ClientsMessagesController::class, 'read'])->name('clientmessages.read')->middleware(['middleware' => 'role:root,mngr']);
    Route::resource('categories', CategoryController::class)->middleware(['middleware' => 'role:root,sc']);
    Route::resource('products', ProductController::class)->middleware(['middleware' => 'role:root,sc,cnt']);
    Route::resource('tests', TestController::class)->middleware(['middleware' => 'role:root,sc,cnt']);
    Route::resource('questions', QuestionController::class)->middleware(['middleware' => 'role:root,sc,cnt']);
    Route::resource('tags', TagController::class)->middleware(['middleware' => 'role:root,sc']);
    Route::resource('quotes', QuoteController::class)->middleware(['middleware' => 'role:root,sc']);
    Route::resource('users', UserController::class)->middleware(['middleware' => 'role:root']);
    Route::resource('roles', RoleController::class)->middleware(['middleware' => 'role:root']);
    Route::resource('permissions', PermissionController::class)->middleware(['middleware' => 'role:root']);
    Route::get('error-rules', [App\Http\Controllers\Admin\RoleController::class, 'norole'])->name('norole');
});

Auth::routes();
