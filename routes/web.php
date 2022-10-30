<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\postsController;
use App\Http\Controllers\PostsController as ControllersPostsController;
use App\Http\Controllers\UsersController;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Routing\Router;
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

//get all posts
Route::get('/', [PostsController::class, 'index']);

//get single post
Route::get('/p/{id}', [PostsController::class, 'show']);

//get posts by tag
Route::get('/tag/{tag}', [PostsController::class, 'TagFilter']);

//get posts by search
Route::get('/search/', [PostsController::class, 'SearchFilter']);

//create post page
Route::get('/create', [PostsController::class, 'create'])->middleware('auth');

//create post page
Route::post('/posts/store', [PostsController::class, 'store']);

//settings page
Route::get('/settings', function () {
    return view('system.settings');
})->middleware('auth')->name('profile');

//register page
Route::get('/register', [UsersController::class, 'register'])->middleware('guest');

//login page
Route::get('/login', [UsersController::class, 'login'])->middleware('guest')->name('login');

//store user (Sign UP)
Route::post('/user/store', [UsersController::class, 'store']);

//user authentication (login)
Route::post('/user/authenticate', [UsersController::class, 'authenticate']);

//logout 
Route::post('/user/logout', [UsersController::class, 'logout'])->middleware('auth');

//user profile
Route::get('/u/@{users}/{param}', [UsersController::class, 'show']);

//user update profile
Route::put('/user/update-profile', [UsersController::class, 'updateProfile']);

//user update account
Route::put('/user/update-account', [UsersController::class, 'updateAccount']);

//user update passwoed
Route::put('/user/update-password', [UsersController::class, 'updatePassword']);

//profile image ipdate
Route::post('update-image',[UsersController::class, 'updateImage'])->name('crop');

//delete profile image
Route::put('/user/delete-profile', [UsersController::class, 'deleteImage']);

//post comment
Route::post('/p/comment/{post_id}', [CommentController::class, 'store']);