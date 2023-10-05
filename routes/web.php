<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
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

Route::get('/', [PageController::class, 'main']);
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/service', [PageController::class, 'service'])->name('service');
Route::get('/projects',[PageController::class, 'projects'])->name('projects');
Route::get('/contacts',[PageController::class, 'contacts'])->name('contacts');

//Authenticate Route
Route::get('login', [AuthController::class,'login'])->name('login');
Route::post('authenticate',[AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout',[AuthController::class, 'logout'])->name('logout');
Route::get('register',[AuthController::class,'register'])->name('register');
Route::post('register',[AuthController::class,'register_store'])->name('register.store');
// Posts Rout

//Route::prefix('/posts')->group(function (){
//    Route::get('/',[PostController::class, 'index'])->name('posts.index');
//    Route::get('{post}',[PostController::class, 'show'])->name('posts.show');
//    Route::get('/create',[PostController::class, 'create'])->name('posts.create');
//    Route::post('/create',[PostController::class, 'store'])->name('posts.store');
//    Route::get('/{post}/edit',[PostController::class, 'edit'])->name('posts.edit');
//    Route::put('/{post}/edit',[PostController::class, 'update'])->name('posts.update');
//    Route::delete('/{post}/delete',[PostController::class, 'destroy'])->name('posts.');
//});

Route::resources([
    'posts' => PostController::class,
    'comments' => CommentController::class,
    'users' => UserController::class
]);
