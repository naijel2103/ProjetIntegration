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
use App\Models\Parametres;
use App\Models\Modeles_courriels;
use App\Models\Contacts;
use App\Models\Infotels;
use App\Models\Liscences;
use App\Models\ListeAContacter;
use App\Models\SpecificationLiscences;
use App\Models\CategorieLiscences;
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
        $finance = Parametres::where('id',1)->first();
        Mail::to($finance->courrielFinance)->send(new EnvoieFicheFinance($fournisseur));
       
        return redirect()->route('acceuils.index');

       
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Fournisseurs $fournisseur)
    {
        
        $liscence  = Liscences::where('numLiscence', $fournisseur->numLiscence)->first();
        $speLiscence = SpecificationLiscences::where('numLiscence', $fournisseur->numLiscence)->first();
        $catLiscence  = CategorieLiscences::where('numCategorie',  $speLiscence->numCategorie)->first();
        $contact = Contacts::where('fournisseur', $fournisseur->idFournisseur)->first();
        $infotel = Infotels::where('fournisseur', $fournisseur->idFournisseur)->first();
        $demandeInscription = Demandesinscriptions::where('idFournisseur', $fournisseur->idFournisseur)->first();
        return View('fiche.show',compact("fournisseur", "demandeInscription",
                                        "contact","infotel","liscence","speLiscence","catLiscence"
                                        ));
    }

    public function askCode(Request $request){
        if ($request->isMethod('get') && $request->has('codeListe')) {
            $codeListe = $request->input('codeListe');
            return redirect()->route('showListeAContacte', ['codeListe' => $codeListe]);
        }

        return view('Fiche.askCodeListe');
    }

    public function showListeAContacte($codeListe){

        $listeAContacteExists = ListeAContacter::where('codeListe', $codeListe)->exists();

        if(!$listeAContacteExists ){
            return redirect()->route('askCodeListe')->with('error', 'Le codeListe fourni n\'existe pas.');
        }

        $listeAContactes = ListeAContacter::where('codeListe', $codeListe)->get();
        $listeFournisseurs = [];

        foreach ($listeAContactes as $listeAContacte) {
            $fournisseur = Fournisseurs::find($listeAContacte->fournisseur);

            $listeFournisseurs[] = [
                'fournisseur' => $fournisseur,
                'contacts' => $fournisseur->contacts,
                'infotels' => $fournisseur->infotels,
                'contacte' => $listeAContacte->contacte,
            ];
        }

        return view('Fiche.listeAContacter', [
            'listeFournisseurs' => $listeFournisseurs,
            'codeListe' => $codeListe
        ]);
    }

}
