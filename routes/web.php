<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(
    ['middleware' => 'setlang'],
    function () {
        Route::get('/', function () {
            return view('welcome');
        });
        Auth::routes();

        Route::get('languages/{code}', [LanguageController::class, 'langView'])->name('language.view');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('language', LanguageController::class);

        Route::post('translation/update', [LanguageController::class, 'transUpdate'])->name('translation.update');
        Route::get('set-language/{code}', [LanguageController::class, 'setLanguage'])->name('set.language');
        Route::get('/changelanguage/{lang}', [LanguageController::class, 'changeLanguage'])->name('changeLanguage');
        Route::get('test', [LanguageController::class, 'test'])->name('test');
    }
);
