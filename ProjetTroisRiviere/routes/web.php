<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcceuilsController;
use App\Http\Controllers\FichesController;
use App\Http\Services\ApiLiscence;

Route::get('/',
[AcceuilsController::class, 'index']) -> name('accueil');

Route::get('/demandeFiche',
[FichesController::class, 'demandeFiche']) -> name('fiche.demandeFiche');

Route::get('/listeLiscence',
[ApiLiscence::class, 'showListeLiscence']) -> name('fiche.demandeFiche');