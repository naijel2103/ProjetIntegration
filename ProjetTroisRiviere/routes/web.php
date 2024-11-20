<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AcceuilsController;
use App\Http\Controllers\FichesController;
use App\Http\Controllers\ProfilsController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FournisseurController;

Route::get('/',
[AcceuilsController::class, 'index']) -> name('acceuils.index');

Route::get('/demandeFiche',
[FichesController::class, 'demandeFiche']) -> name('fiche.demandeFiche');

Route::get('/listeDemande',
[FichesController::class, 'index']) -> name('fiche.index');

Route::get('/envoieDemandeFiche/{fournisseur}',
[FichesController::class, 'envoieDemandeFiche']) -> name('fiche.envoieDemandeFiche');

Route::get('/envoieFicheFinance/{fournisseur}',
[FichesController::class, 'envoieFicheFinance']) -> name('fiche.envoieFicheFinance');

Route::get('/fournisseurs/{fournisseur}',
[FichesController::class, 'show']) -> name('fiche.show');

Route::get('/gererDemande/{fournisseur}',
[FichesController::class, 'gererDemande']) -> name('fiche.gererDemande');

Route::patch('/gererDemande/{fournisseur}',
[FichesController::class, 'reponseDemande'])->name('fiche.reponseDemande');

Route::get('/listeAContacter', 
[FichesController::class, 'askCode'])->name('askCodeListe');

Route::get('/listeAContacter/{codeListe}', 
[FichesController::class, 'showListeAContacte'])->name('showListeAContacte');

Route::put('/listeAContacter/{codeListe}/{idFournisseur}/update-contacte', 
[FichesController::class, 'fournisseurContacted'])->name('updateContacte');

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

Route::get('/gererModele',
[ProfilsController::class, 'gererModele']) -> name('profil.gererModele');


Route::patch('/gererModele/edit',
[ProfilsController::class, 'editGererModele']) -> name('profil.editGererModele');

Route::get('/gererParametres',
[ProfilsController::class, 'gererParametres']) -> name('profil.gererParametres');

Route::patch('/editGererParametres/edit',
[ProfilsController::class, 'editGererParametres']) -> name('profil.editGererParametres');


Route::get('/confirmer/{code}',
[ProfilsController::class, 'confirmer']) -> name('profil.confirmer');

Route::get('/reinitialiser/{code}',
[ProfilsController::class, 'reinitialiserPage']) -> name('profil.reinitialiser');

Route::post('/reinitialiser/{code}',
[ProfilsController::class, 'reinitialiser']) -> name('profil.reinitialiser');

Route::get('/gererComptes',
[ProfilsController::class, 'gererComptes']) -> name('profil.gererComptes');

Route::patch('/comptes/modifier/{compte}',
[ProfilsController::class, 'update'])->name('profil.update');

Route::get('/comptes/edit/{compte}',
[ProfilsController::class, 'edit'])->name('profil.edit');

Route::delete('/comptes/supprimer/{compte}',
[ProfilsController::class, 'destroy'])->name('profil.destroy');

Route::post('/creer',
[ProfilsController::class, 'creer']) -> name('profil.creer');

Route::get('/motdepasse',
[ProfilsController::class, 'motdepasseView']) -> name('motdepasse');

Route::post('/reset',
[ProfilsController::class, 'reset']) -> name('profil.reset');

Route::get('/reinitialiser/{code}',
[ProfilsController::class, 'reinitialiserPage']) -> name('profil.reinitialiser');

Route::post('/reinitialiser/{code}',
[ProfilsController::class, 'reinitialiser']) -> name('profil.reinitialiser');

Route::get('/api/data/{neq}', 
[ApiController::class, 'getData']);

Route::get('/listeFournisseur', 
[FournisseurController::class, 'getListe'])->name('getListeFournisseur');

Route::post('/listeFournisseur', 
[FournisseurController::class, 'createListe'])->name('createListeFournisseur');

Route::get('/creation', [FournisseurController::class, 'showCreationForm'])->name('profil.creation');
