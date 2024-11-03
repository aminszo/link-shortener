<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;

route::view('/', 'welcome')->name('home');

Route::middleware('auth')->controller(ProfileController::class)
    ->name('profile.')->group(function () {
        Route::get('/profile', 'edit')->name('edit');
        Route::patch('/profile', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('destroy');
    });

Route::get('/dashboard', [LinkController::class, 'index'])->middlleware('auth')->name('dashboard');

Route::middleware('auth')->controller(LinkController::class)
    ->prefix('link')->name('links.')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{link}', 'edit')->name('edit');
        Route::patch('/update/{link}', 'update')->name('update');
        Route::delete('/delete/{link}', 'destroy')->name('delete');
    });

// User can change the app locale using this route
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fa'])) {  // Ensure only valid locales are set
        // Set the cookie for 1 year (60 minutes * 24 hours * 365 days)
        Cookie::queue('user_lang', $locale, 60 * 24 * 365);
    } else {
        return abort(404); // if locale is not valid, return 404 error
    }
    return redirect()->back(); // Redirect back to the page the user came from
})->name('lang.switch');

require __DIR__ . '/auth.php';

/*
* This route handles redirection logic for all link slugs.
* This MUST be the last rule in routes file, so if the requested url does not match any of
* the application's defined urls, it will be treated as a link slug.
*/
Route::get('{slug}', [RedirectController::class, 'index']);
