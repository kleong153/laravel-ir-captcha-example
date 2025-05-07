<?php

use App\Http\Controllers\ExampleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExampleController::class, 'index']);
Route::post('/do-login', [ExampleController::class, 'doLogin']);
