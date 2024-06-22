<?php

use App\Http\Controllers\AdvertController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'adverts'], function () {
    Route::get('/', [AdvertController::class, 'index'])->name('adverts.index');
    Route::get('/{id}', [AdvertController::class, 'show'])->name('adverts.show');
    Route::post('/', [AdvertController::class, 'store'])->name('adverts.store');
});
