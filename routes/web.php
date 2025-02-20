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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home'); // Home page
    Route::get('post/{id}', 'show')->name('showPost');
    Route::get('category/{id}', 'categoryFilter')->name('category.filter');
    Route::get('titleslogan/{id}', 'getTitleSlogan')->name('title.slogan');
    Route::put('titleslogan/update/{id}', 'titleSloganUpdate')->name('title.slogan.update');
    Route::get('social/{id}', 'getSocialLink')->name('social');
    Route::put('social/update/{id}', 'socialUpdate')->name('social.update');
    Route::get('copyright/{id}', 'getCopynote')->name('copyright');
    Route::put('copyright/update/{id}', 'CopyNoteUpdate')->name('copyright.update');
    Route::get('pages/{id}', 'singlePage')->name('single.page');
    Route::get('contract', 'contractPage')->name('contract');
    Route::get('search', 'search')->name('search');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('showregister', 'showRegister')->name('auth.register');
    Route::post('register', 'registerStore')->name('register.store');
    Route::get('login', 'showLogin')->name('auth.login');
    Route::post('loginmatch', 'loginUser')->name('login.match');
    Route::get('dashbord','dashboard')->middleware('auth.check')->name('dashbord');
    Route::get('logout', 'logout')->name('logout');
});


Route::middleware(['auth'])->group(function () {
    Route::controller(SingleUserController::class)->group(function () {
        Route::get('profile', 'showUser')->name('profile');
        Route::put('profile/update', 'infoupdate')->name('profile.update');
        Route::get('profile/changePass', 'changePass')->name('change.pass');
        Route::put('profile/updatePassword', 'changePassword')->name('update.password');
    });
});


Route::resource('users', UserController::class);

Route::resource('posts', PostController::class);

Route::resource('categories', CategoryController::class);

Route::resource('page', PageController::class);

Route::resource('slider', SliderController::class);

Route::resource('message', ContractController::class);

Route::post('/message/{id}/seenMsg', [ContractController::class, 'seenMsg'])->name('messages.seen');

Route::post('/message/{id}/undo', [ContractController::class, 'undo'])->name('messages.undo');




