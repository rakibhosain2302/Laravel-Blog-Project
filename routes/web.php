<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SingleUserController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Guest + All Users)
|--------------------------------------------------------------------------
*/

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');

    Route::get('post/{id}', 'show')->name('showPost');
    Route::get('category/{id}', 'categoryFilter')->name('category.filter');
    Route::get('pages/{id}', 'singlePage')->name('single.page');

    Route::get('search', 'search')->name('search');
    Route::get('contract', 'contractPage')->name('contract');

    // Blog Settings (public view only)
    Route::get('blog-title', 'titleSlogan')->name('blog.title.index');
    Route::get('social-link', 'socialIndex')->name('social.index');
    Route::get('copyright', 'copyrightIndex')->name('copyright.index');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Login/Register)
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {

    Route::get('admin', 'admin')->name('admin');

    Route::get('showregister', 'showRegister')
        ->name('auth.register')
        ->middleware('guest');

    Route::post('register', 'registerStore')->name('register.store');

    Route::get('login', 'showLogin')
        ->name('auth.login')
        ->middleware('guest');

    Route::post('loginmatch', 'loginUser')->name('login.match');

    Route::get('dashbord', 'dashboard')
        ->middleware('auth.check')
        ->name('dashbord');

    Route::get('logout', 'logout')->name('logout');
});


/*
|--------------------------------------------------------------------------
| USER PROFILE ROUTES (All Auth Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::controller(SingleUserController::class)->group(function () {

        Route::get('profile', 'showUser')->name('profile');
        Route::get('profile/edit', 'editProfile')->name('profile.edit');
        Route::put('profile/update', 'infoupdate')->name('profile.update');

        Route::get('profile/changePass', 'changePass')->name('change.pass');
        Route::put('profile/updatePassword', 'changePassword')->name('update.password');
    });
});


/*
|--------------------------------------------------------------------------
| ADMIN PANEL (ONLY Admin + Editor)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role.access'])->prefix('admin')->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('page', PageController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('message', ContractController::class);
});
Route::resource('posts', PostController::class);


/*
|--------------------------------------------------------------------------
| MESSAGE ACTION ROUTES (Admin + Editor)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role.access'])->group(function () {

    Route::post('/message/{id}/seenMsg', [ContractController::class, 'seenMsg'])
        ->name('messages.seen');

    Route::post('/message/{id}/undo', [ContractController::class, 'undo'])
        ->name('messages.undo');
});
