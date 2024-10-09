<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [LinkController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/create', [LinkController::class, 'create'])->name('links.create');
    Route::post('/dashboard/create', [LinkController::class, 'store'])->name('links.store');
    Route::get('/dashboard/edit/{link}', [LinkController::class, 'edit'])->name('links.edit');
    Route::put('/dashboard/update/{link}', [LinkController::class, 'update'])->name('links.update');
    Route::delete('/dashboard/delete/{link}', [LinkController::class, 'destroy'])->name('links.delete');
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
