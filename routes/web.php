<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{LoginController, LogoutController, RegisterController} ;
use App\Http\Controllers\{DashboardController, HomeController, PostController, PostLikeController, QuoteController, 
    UserController, UserPostController};

// Redirect
Route::get('/', [HomeController::class, 'redirect']);

// Home
Route::get('/home', [HomeController::class,'indexHome'])->name('home');

// Register
Route::group([
    'prefix'        => '/register',
    'as'            => ''
], function () {
    Route::get('/', [RegisterController::class, 'index'])->name('register');
    Route::post('/', [RegisterController::class, 'store']);
});

// Login
Route::group([
    'prefix'        => '/login',
    'as'            => ''
], function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/', [LoginController::class, 'store']);
});

// Logout
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Quotes 
Route::group([
    'middleware'    => 'auth',
    'prefix'        => '/quotes',
    'as'            => ''
], function () {
    Route::get('/', [QuoteController::class, 'index'])->name('quotes');
    Route::post('/', [QuoteController::class, 'store']);
});


// Post
Route::group([
    'prefix'        => '/posts',
    'as'            => ''
], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts')->middleware('auth');
    Route::post('/', [PostController::class, 'store'])->name('posts');
    Route::get('search', [PostController::class, 'search'])->name('search');
    Route::delete('{post}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('{slug}', [PostController::class, 'show'])->name('posts.show');
    Route::get('{slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('{id}/update', [PostController::class, 'update'])->name('posts.update');
    Route::post('{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
    Route::delete('{post}/dislikes', [PostLikeController::class, 'destroy'])->name('posts.dislikes');
});


Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');

Route::get('/search', [PostController::class, 'search'])->name('search');

Route::controller(UserController::class)->group(function() {
// User profile
Route::get('/user/{user:username}/profile', [UserController::class, 'show'])->name('users.profile');
// Users edit
Route::put('/user/{id}/update', [UserController::class, 'update'])->name('users.update');
});

