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
use App\Mail\EnvoieFicheFinance;
use App\Mail\EnvoieRefuFiche;
use App\Mail\EnvoieRefuFicheRaison;
use App\Models\Modeles_courriels;
use App\Mail\EnvoieAccepteFiche;
use App\Models\Demandesinscriptions;

use Carbon\Carbon;

class FichesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fournisseurs = Fournisseurs::with('demandeInscription')
            ->get();

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

    public function reponseDemande(Request $request,Fournisseurs $fournisseur)
    {
            $demandeInscription = Demandesinscriptions::where('idFournisseur', $fournisseur->idFournisseur)->first();
        try{
            $dateAujourdhui = Carbon::today();
            
            $dateFormatee = $dateAujourdhui->format('Y-m-d'); // Format: 2024-10-21

            if ($demandeInscription) {
                $demandeInscription->dateChangementStatut = $dateFormatee;
                $demandeInscription->statut = $request->statut;
                if($request->statut == "Refuse")
                {
                    $raison = $request->raisonRefus;
                    $donneeCryptee = encrypt($request->raisonRefus);
                    $demandeInscription->raisonRefus =$donneeCryptee;
                    $estCochee = $request->has('envoyerRaison');
                    if($estCochee)
                    {
                        
                        Mail::to($fournisseur->email )->send(new EnvoieRefuFicheRaison($raison));
                    }else
                    {
                        Mail::to($fournisseur->email )->send(new EnvoieRefuFiche());
                    }
                }else if($request->statut == "Approuve"){
                    Mail::to($fournisseur->email )->send(new EnvoieAccepteFiche());
                    $demandeInscription->raisonRefus = null;
                }
                $demandeInscription->save(); // Enregistrer les modifications
            }
            
            return redirect()->route('fiche.index')->with('message', "Modification de  réussi!");
        }catch(\Throwable $e)
        {
            Log::debug($e);
            return redirect()->route('fiche.gererDemande',compact("fournisseur"))->with('message', "Modification pas effectue");
        }
        return redirect()->route('fiche.gererDemande',compact("fournisseur"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function envoieFicheFinance(Fournisseurs $fournisseur)
    {
        Mail::to('loick.michaud2103@gmail.com')->send(new EnvoieFicheFinance($fournisseur));
       
        return redirect()->route('acceuils.index');

       
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Fournisseurs $fournisseur)
    {
        $demandeInscription = Demandesinscriptions::where('idFournisseur', $fournisseur->idFournisseur)->first();
        return View('fiche.show',compact("fournisseur", "demandeInscription"));
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
