<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;


Route::get('/', [PostController::class, 'home'])->name('index');

Route::middleware('guest')->group(function (){
    Route::get('/register', [AuthController::class, 'create'])->name('auth.register');
    Route::post('/register', [UserController::class, 'store'])->name('users.store');

    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function (){
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    Route::get('/posts/mine', [PostController::class, 'mine'])->name('posts.mine');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('posts.like');

    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
});

// ADMIN
Route::middleware(['auth', 'is_admin'])->group(function (){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
    Route::delete('/admin/users/{user}', [AdminController::class, 'usersDestroy'])->name('admin.users.destroy');

    Route::get('/admin/posts', [AdminController::class, 'postsIndex'])->name('admin.posts.index');
    Route::delete('/admin/posts/{user}', [AdminController::class, 'postsDestroy'])->name('admin.posts.destroy');

    Route::get('/admin/categories', [AdminController::class, 'categoriesIndex'])->name('admin.categories.index');
    Route::post('/admin/categories', [AdminController::class, 'categoriesStore'])->name('admin.categories.store');
    Route::delete('/admin/categories/{category}', [AdminController::class, 'categoriesDestroy'])->name('admin.categories.destroy');
});






