<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestController::class, 'index']);
Route::post('/do-login', [TestController::class, 'doLogin']);
