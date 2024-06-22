<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/adverts');
});

Route::get('/{page}', [IndexController::class, 'index'])->where('page', '.*');
