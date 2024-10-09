<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Fournisseurs;

class FichesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $fournisseurs = Fournisseurs::all();
        return View("fiche.index",compact("fournisseurs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function demandeFiche()
    {
        return View('Fiche.demandeFiche');
    }

    public function gererDemande(Fournisseurs $fournisseur)
    {

        return View('Fiche.gererDemande',compact("fournisseur"));
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
    public function show(Fournisseurs $fournisseur)
    {
        return View('fiche.show',compact("fournisseur"));
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
