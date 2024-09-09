<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcceuilsController;
use App\Http\Controllers\FichesController;
use App\Http\Controllers\ProfilsController;

Route::get('/',
[AcceuilsController::class, 'index']) -> name('accueil');

Route::get('/demandeFiche',
[FichesController::class, 'demandeFiche']) -> name('fiche.demandeFiche');

Route::get('/envoieDemandeFiche',
[FichesController::class, 'envoieDemandeFiche']) -> name('fiche.envoieDemandeFiche');

Route::get('/connexion',
[ProfilsController::class, 'connexion']) -> name('profil.connexion');

Route::get('/creation',
[ProfilsController::class, 'creation']) -> name('profil.creation');

Route::post('/creer',
[ProfilController::class, 'creer']) -> name('profil.creer');