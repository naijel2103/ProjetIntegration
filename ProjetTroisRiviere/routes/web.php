<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcceuilsController;

Route::get('/',
[AcceuilsController::class, 'index']) -> name('accueil');