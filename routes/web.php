<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\postsController;
use App\Http\Controllers\PostsController as ControllersPostsController;
use App\Http\Controllers\UsersController;
use App\Models\Posts;
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
Route::get('/', [PostsController::class , 'index']);

//get single post
Route::get('/p/{id}' ,[PostsController::class , 'show']);

//get posts by tag
Route::get('/tag/{tag}' , [PostsController::class , 'TagFilter']);

//get posts by search
Route::get('/search/' , [PostsController::class, 'SearchFilter']);

//create post page
Route::get('/create' , [PostsController::class , 'create']);

//create post page
Route::post('/posts/store' , [PostsController::class , 'store']);

//settings page
Route::get('/settings', function()
{
    return view('system.settings');
});

//register page
Route::get('/register', [UsersController::class , 'register']);

//login page
Route::get('/login', [UsersController::class , 'login']);

//store user (Sign UP)
Route::post('/user/store', [UsersController::class, 'store']);
//DEMO

//fake daa for profile page

Route::get('/u/{users}', [UsersController::class, 'show']);

Route::get('/u/{users}/{param}', [UsersController::class, 'show']);

