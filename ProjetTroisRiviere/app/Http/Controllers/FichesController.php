<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\F;

class FichesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $fourni = Fournisseur::all();
        return View("fiche.index",compact("fournisseur"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function demandeFiche()
    {
        return View('Fiche.demandeFiche');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function envoieDemandeFiche(Request $request)
    {


     /*   $compte = Compte::Find(Auth::id());
        try {
            Mail::to($compte->email)->send(new confirmationEnvoieFIche($compte));
        }
        catch (\Throwable $e) {
            //Gérer l'erreur
             Log::debug($e);
             return View('Acceuils.index');
            }
       */


       
            return View('Acceuils.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $selectionner = Fournisseur::where('selectionner','true')->get();
        return View('Fiche.fournisseurSelectionne',compact("selectionner"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
