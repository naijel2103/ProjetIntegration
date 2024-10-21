<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcceuilsController;
use App\Http\Controllers\FichesController;
use App\Http\Controllers\ProfilsController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FournisseurController;

Route::get('/',
[AcceuilsController::class, 'index']) -> name('accueil');

Route::get('/demandeFiche',
[FichesController::class, 'demandeFiche']) -> name('fiche.demandeFiche');

Route::get('/fiche',
[FichesController::class, 'index']) -> name('fiche.index');

Route::get('/envoieDemandeFiche',
[FichesController::class, 'envoieDemandeFiche']) -> name('fiche.envoieDemandeFiche');

Route::get('/connexion',
[ProfilsController::class, 'connexion']) -> name('profil.connexion');

Route::get('/deconnexion',
[ProfilsController::class, 'deconnexion']) -> name('profil.deconnexion');

Route::post('/loginNEQ',
[ProfilsController::class, 'loginNEQ']) -> name('profil.loginNEQ');

Route::post('/login',
[ProfilsController::class, 'login']) -> name('profil.login');

Route::get('/connexionNEQ',
[ProfilsController::class, 'connexionNEQ']) -> name('profil.connexionNEQ');

Route::get('/creation',
[ProfilsController::class, 'creation']) -> name('profil.creation');

Route::post('/creer',
[ProfilsController::class, 'creer']) -> name('profil.creer');

Route::get('/motdepasse',
[ProfilsController::class, 'motdepasseView']) -> name('motdepasse');

Route::post('/reset',
[ProfilsController::class, 'reset']) -> name('profil.reset');

Route::get('/api/data/{neq}', 
[ApiController::class, 'getData']);

Route::get('/api/regions', 
[ApiController::class, 'getRegion']);

Route::get('/api/villes', 
[ApiController::class, 'getVille']);

Route::get('/listeFournisseur', 
[FournisseurController::class, 'getListe'])->name('getListeFournisseur');