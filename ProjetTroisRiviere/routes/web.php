<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FichesController;
use App\Http\Controllers\ProfilsController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FournisseurController;


Route::get('/',
[ProfilsController::class, 'connexion']) -> name('profil.connexion');

Route::get('/demandeFiche',
[FichesController::class, 'demandeFiche']) -> name('fiche.demandeFiche');

Route::put('/demandeFiche',
[FichesController::class, 'desactivateFiche']) -> name('fiche.desactivateFiche');

Route::get('/fournisseur/edit/{fournisseur}',
[FichesController::class, 'edit'])->name('fiche.edit');

Route::patch('/fournisseur/edit/{fournisseur}',
[FichesController::class, 'update'])->name('fiche.update');

Route::get('/listeDemande',
[FichesController::class, 'index']) -> name('fiche.index')->middleware('check.role:Admin,Responsable');

Route::get('/envoieDemandeFiche/{fournisseur}',
[FichesController::class, 'envoieDemandeFiche']) -> name('fiche.envoieDemandeFiche');

Route::get('/envoieFicheFinance/{fournisseur}',
[FichesController::class, 'envoieFicheFinance']) -> name('fiche.envoieFicheFinance')->middleware('check.role:Admin,Responsable,Commis');

Route::get('/fournisseurs/{fournisseur}',
[FichesController::class, 'show']) -> name('fiche.show')->middleware('check.role:Admin,Responsable,Commis');

Route::get('/gererDemande/{fournisseur}',
[FichesController::class, 'gererDemande']) -> name('fiche.gererDemande')->middleware('check.role:Admin,Responsable');

Route::patch('/gererDemande/{fournisseur}',
[FichesController::class, 'reponseDemande'])->name('fiche.reponseDemande')->middleware('check.role:Admin,Responsable');



Route::get('/listeAContacter', 
[FichesController::class, 'askCode'])->name('askCodeListe');

Route::get('/listeAContacter/{codeListe}', 
[FichesController::class, 'showListeAContacte'])->name('showListeAContacte');

Route::put('/listeAContacter/{codeListe}/{idFournisseur}/update-contacte', 
[FichesController::class, 'fournisseurContacted'])->name('updateContacte');

Route::delete('/listeAContacter/{codeListe}',
[FichesController::class, 'deleteListe']) -> name('deleteListe')->middleware('check.role:Admin,Responsable');


Route::get('/api/data/{neq}', 
[ApiController::class, 'getUser']);

Route::get('/api/data/{neq}', 
[ApiController::class, 'getData']);

Route::get('/connexion',
[ProfilsController::class, 'connexion']) -> name('profil.connexion');

Route::get('/deconnexion',
[ProfilsController::class, 'deconnexion']) -> name('profil.deconnexion');
Route::get('/deconnexionFournisseur',
[ProfilsController::class, 'deconnexionFournisseur']) -> name('profil.deconnexionFournisseur');

Route::post('/loginNEQ',
[ProfilsController::class, 'loginNEQ']) -> name('profil.loginNEQ');

Route::post('/login',
[ProfilsController::class, 'login']) -> name('profil.login');

Route::get('/connexionNEQ',
[ProfilsController::class, 'connexionNEQ']) -> name('profil.connexionNEQ');

Route::get('/creation',
[ProfilsController::class, 'creation']) -> name('profil.creation');

Route::get('/gererModele',
[ProfilsController::class, 'gererModele']) -> name('profil.gererModele')->middleware('check.role:Admin');


Route::patch('/gererModele/edit',
[ProfilsController::class, 'editGererModele']) -> name('profil.editGererModele')->middleware('check.role:Admin');

Route::get('/gererParametres',
[ProfilsController::class, 'gererParametres']) -> name('profil.gererParametres')->middleware('check.role:Admin');

Route::patch('/editGererParametres/edit',
[ProfilsController::class, 'editGererParametres']) -> name('profil.editGererParametres')->middleware('check.role:Admin');


Route::get('/confirmer/{code}',
[ProfilsController::class, 'confirmer']) -> name('profil.confirmer');

Route::get('/reinitialiser/{code}',
[ProfilsController::class, 'reinitialiserPage']) -> name('profil.reinitialiser');

Route::post('/reinitialiser/{code}',
[ProfilsController::class, 'reinitialiser']) -> name('profil.reinitialiser');

Route::get('/gererComptes',
[ProfilsController::class, 'gererComptes']) -> name('profil.gererComptes')->middleware('check.role:Admin');

Route::patch('/comptes/modifier/{compte}',
[ProfilsController::class, 'update'])->name('profil.update')->middleware('check.role:Admin');

Route::get('/comptes/edit/{compte}',
[ProfilsController::class, 'edit'])->name('profil.edit')->middleware('check.role:Admin');

Route::delete('/comptes/supprimer/{compte}',
[ProfilsController::class, 'destroy'])->name('profil.destroy')->middleware('check.role:Admin');

Route::post('/creer',
[ProfilsController::class, 'creer']) -> name('profil.creer');

Route::get('/creationCompte',
[ProfilsController::class, 'creationCompte']) -> name('profil.creationCompte')->middleware('check.role:Admin');

Route::post('/creerCompte',
[ProfilsController::class, 'creerCompte']) -> name('profil.creerCompte')->middleware('check.role:Admin');

Route::get('/motdepasse',
[ProfilsController::class, 'motdepasseView']) -> name('motdepasse');

Route::post('/reset',
[ProfilsController::class, 'reset']) -> name('profil.reset');

Route::get('/reinitialiser/{code}',
[ProfilsController::class, 'reinitialiserPage']) -> name('profil.reinitialiser');

Route::post('/reinitialiser/{code}',
[ProfilsController::class, 'reinitialiser']) -> name('profil.reinitialiser');

Route::get('/check-email', [FournisseurController::class, 'checkEmail']);

Route::get('/check-neq', [FournisseurController::class, 'checkNEQ']);

Route::get('/check-rbq', [FournisseurController::class, 'checkRBQ']);



Route::get('/listeFournisseur', 
[FournisseurController::class, 'getListe'])->name('getListeFournisseur')->middleware('check.role:Admin,Responsable,Commis');

Route::post('/listeFournisseur', 
[FournisseurController::class, 'createListe'])->name('createListeFournisseur');

Route::get('/creation', [FournisseurController::class, 'showCreationForm'])->name('profil.creation');

Route::post('/createFournisseur', 
[FournisseurController::class, 'createFournisseur'])->name('createFournisseur');
