<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Controllers\LoginController;


Route::post("login", LoginController::class)->name('login');
