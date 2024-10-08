<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [LinkController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [LinkController::class, 'store'])->name('links.store');
    Route::get('/dashboard/edit/{link}', [LinkController::class, 'edit'])->name('links.edit');
    Route::put('/dashboard/update/{link}', [LinkController::class, 'update'])->name('links.update');
    Route::delete('/dashboard/delete/{link}', [LinkController::class, 'destroy'])->name('links.delete');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'fa'])) {  // Ensure only valid locales are set
        // Set the cookie for 1 year (60 minutes * 24 hours * 365 days)
        Cookie::queue('user_lang', $locale, 60 * 24 * 365);
    }
    return redirect()->back(); // Redirect back to the page the user came from
})->name('lang.switch');

require __DIR__ . '/auth.php';

Route::get('{slug}', [RedirectController::class, 'index']);
