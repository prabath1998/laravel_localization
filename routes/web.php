<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;



// Route::get('/', function () {
//     return redirect(app()->getLocale());
// });



// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/welcome/{locale}', function (string $locale) {
//     if (!in_array($locale, ['en', 'sin'])) {
//         abort(400);
//     }

//     App::setLocale($locale);

//     return view('welcome');

//     // ...
// });

Route::get('/localization/{locale}',LocalizationController::class)->name('localization');

Route::middleware(Localization::class)->group(function () {

    Route::view('/','welcome');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';
});
