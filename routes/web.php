<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\OneTimeLinkController;
use App\Http\Controllers\SelfDestructMessageController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
});

Route::get('/short-links', function () {
    return view('short-link');
});
/**
 * Proses pembuatan short link (POST dari form)
 * Controller: ShortLinkController@store
 */
Route::post('generate-shorten-link', [ShortLinkController::class, 'store'])->name('shorten.store');

/**
 * Route untuk redirect ke link asli dari short link
 * Controller: ShortLinkController@shortenLink
 */
Route::get('/short-link/{code}', [ShortLinkController::class, 'shortenLink'])->name('shorten.link');

/* ------------------ One-Time Link ------------------ */

/**
 * Halaman form untuk buat one-time link
 * View: resources/views/one-time.blade.php
 */
Route::get('/one-time-link', function () {
    return view('one-time');
});

/**
 * Proses pembuatan one-time link (POST dari form)
 * Controller: OneTimeLinkController@store
 */
Route::post('/one-link', [OneTimeLinkController::class, 'store'])->name('one-time-link.store');

/**
 * Akses ke link sekali pakai → akan redirect ke URL tujuan & delete data
 * Controller: OneTimeLinkController@redirect
 */
Route::get('/one-link/{code}', [OneTimeLinkController::class, 'redirect'])->name('one-time-link.redirect');


/* ------------------ Self Destruct Message ------------------ */

/**
 * Halaman buat input pesan rahasia
 * View: resources/views/self-destruct.blade.php
 */
Route::get('/self-destruct', function () {
    return view('self-destruct');
});

/**
 * Proses simpan pesan rahasia (POST dari form)
 * Controller: SelfDestructMessageController@store
 */
Route::post('/self-destruct', [SelfDestructMessageController::class, 'store'])->name('self-destruct.store');

/**
 * Tampilkan pesan yang bisa hancur sendiri setelah dibuka
 * Controller: SelfDestructMessageController@show
 */
Route::get('/self-destruct/{code}', [SelfDestructMessageController::class, 'show']);
