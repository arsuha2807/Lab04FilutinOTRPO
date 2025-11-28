<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;


Route::get('/index', [CardController::class, 'main'])->name('index');
Route::resource('cards', CardController::class);

Route::get('/', [CardController::class, 'main']);