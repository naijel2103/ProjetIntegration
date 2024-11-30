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
use App\Mail\confirmationEnvoieFiche;
use App\Mail\EnvoieRefuFiche;
use App\Mail\EnvoieRefuFicheRaison;
use App\Models\Parametres;
use App\Models\Modeles_courriels;
use App\Models\Contacts;
use App\Models\Comptes;
use App\Models\Infotels;
use App\Models\Liscences;
use App\Models\ListeAContacter;
use App\Models\Offres;
use App\Models\OffresFournisseurs;
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
        $compte = Comptes::Find(Auth::id());
        $fournisseur = Fournisseurs::where('email', $compte->email)->first();
        $offreFournisseurs = OffresFournisseurs::where('fournisseur', $fournisseur->idFournisseur)->get();


        $offres = collect();

        foreach ($offreFournisseurs as $offreFournisseur) {
            $offre = Offres::where('codeUNSPSC', $offreFournisseur->offre)->get();
            $offres = $offres->merge($offre);
            }


        $liscences  = Liscences::where('numLiscence', $fournisseur->numLiscence)->first();
        $speLiscences = SpecificationLiscences::where('numLiscence', $fournisseur->numLiscence)->get();
        $catLiscences = CategorieLiscences::whereIn('numCategorie', $speLiscences->pluck('numCategorie')->toArray())->get();


        $contacts = Contacts::where('fournisseur', $fournisseur->idFournisseur)->get();
        $infotels = Infotels::where('fournisseur', $fournisseur->idFournisseur)->get();

        $infotelsContacts = collect();

        foreach ($contacts as $contact) {
            $infotelsContact = Infotels::where('contact', $contact->idContact)->get();
            $infotelsContacts = $infotelsContacts->merge($infotelsContact);
        }
        
       

        $demandeInscription = Demandesinscriptions::where('idFournisseur', $fournisseur->idFournisseur)->first();
        return View('fiche.demandeFiche',compact("fournisseur", "demandeInscription",
        "contacts","infotels","liscences","speLiscences","catLiscences","offres","offreFournisseurs","infotelsContacts"));
    }

    public function desactivateFiche(){
        $compte = Comptes::Find(Auth::id());
        $fournisseur = Fournisseurs::where('email', $compte->email)->first();
        $statut = $fournisseur->statut;
        if($statut == "Acceptee"){
            Fournisseurs::where('email', $compte->email)->first()
                ->update(['statut' => 'Desactivee']);
            return redirect()->back()->with('success', 'Le  fournisseur a bien été désactivé');
        } else {
            Fournisseurs::where('email', $compte->email)->first()
                ->update(['statut' => 'Acceptee']);
            return redirect()->back()->with('success', 'Le  fournisseur a bien été réactivé');
        }

    }

    public function envoieDemandeFiche(Fournisseurs $fournisseur)
    {
        
    
        Mail::to($fournisseur->email )->send(new confirmationEnvoieFiche());

        $offreFournisseurs = OffresFournisseurs::where('fournisseur', $fournisseur->idFournisseur)->get();


        $offres = collect();

        foreach ($offreFournisseurs as $offreFournisseur) {
            $offre = Offres::where('codeUNSPSC', $offreFournisseur->offre)->get();
            $offres = $offres->merge($offre);
            }


        $liscences  = Liscences::where('numLiscence', $fournisseur->numLiscence)->first();
        $speLiscences = SpecificationLiscences::where('numLiscence', $fournisseur->numLiscence)->get();
        $catLiscences = CategorieLiscences::whereIn('numCategorie', $speLiscences->pluck('numCategorie')->toArray())->get();


        $contacts = Contacts::where('fournisseur', $fournisseur->idFournisseur)->get();
        $infotels = Infotels::where('fournisseur', $fournisseur->idFournisseur)->get();
        $infotelsContacts = Infotels::where('contact', $contacts->idContact)->get();
            dd($infotelsContacts);
        $demandeInscription = Demandesinscriptions::where('idFournisseur', $fournisseur->idFournisseur)->first();
        return View('fiche.demandeFiche',compact("fournisseur", "demandeInscription",
        "contacts","infotels","liscences","speLiscences","catLiscences","offres","offreFournisseurs","infotelsContacts"));
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
                $fournisseur->statut = $request->statut;
                if($request->statut == "Refusee")
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
                }else if($request->statut == "Accepte"){

                    Mail::to($fournisseur->email )->send(new EnvoieAccepteFiche());
                    $demandeInscription->raisonRefus = null;
                }
                $demandeInscription->save(); // Enregistrer les modifications
                $fournisseur->save(); // Enregistrer les modifications
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
       
        return redirect()->route('getListeFournisseur');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fournisseurs $fournisseur)
    {


        $offreFournisseurs = OffresFournisseurs::where('fournisseur', $fournisseur->idFournisseur)->get();


        $offres = collect();

        foreach ($offreFournisseurs as $offreFournisseur) {
            $offre = Offres::where('codeUNSPSC', $offreFournisseur->offre)->get();
            $offres = $offres->merge($offre);
            }


        $liscences  = Liscences::where('numLiscence', $fournisseur->numLiscence)->first();
        $speLiscences = SpecificationLiscences::where('numLiscence', $fournisseur->numLiscence)->get();
        $catLiscences = CategorieLiscences::whereIn('numCategorie', $speLiscences->pluck('numCategorie')->toArray())->get();


        $contacts = Contacts::where('fournisseur', $fournisseur->idFournisseur)->get();
        $infotels = Infotels::where('fournisseur', $fournisseur->idFournisseur)->get();



        $infotelsContacts = collect();

        foreach ($contacts as $contact) {
            $infotelsContact = Infotels::where('contact', $contact->idContact)->get();
            $infotelsContacts = $infotelsContacts->merge($infotelsContact);
        }
        
       
    


        $demandeInscription = Demandesinscriptions::where('idFournisseur', $fournisseur->idFournisseur)->first();
        return View('fiche.show',compact("fournisseur", "demandeInscription",
                                        "contacts","infotels","liscences","speLiscences","catLiscences","offres","offreFournisseurs","infotelsContacts"
                                        ));
    }

    public function askCode(Request $request){
        if ($request->isMethod('get') && $request->has('codeListe')) {
            $codeListe = $request->input('codeListe');
            return redirect()->route('showListeAContacte', ['codeListe' => $codeListe]);
        }
        return view('Fiche.askCodeListe');
    }

    public function edit(string $id)
    {
        $compte = Comptes::Find(Auth::id());
        $fournisseur = Fournisseurs::where('email', $compte->email)->first();
        return View('fiche.edit', compact('fournisseur'));
    }

    public function editFiche(Fournisseurs $fournisseur)
    {
        return view('fiche.edit',compact("fournisseur"));
    }
    
    public function showListeAContacte($codeListe){

        $listeAContacteExists = ListeAContacter::where('codeListe', $codeListe)->exists();

        if(!$listeAContacteExists ){
            return redirect()->route('askCodeListe')->with('error', '*Le code de la liste fourni n\'existe pas*');
        }

        $listeAContactes = ListeAContacter::where('codeListe', $codeListe)->get();
        $listeFournisseurs = [];

        foreach ($listeAContactes as $listeAContacte) {
            $fournisseur = Fournisseurs::find($listeAContacte->fournisseur);
            
            $contactsAvecInfotels = $fournisseur->contacts->map(function ($contact) {
                return [
                    'contact' => $contact,
                    'infotels' => $contact->infotels,
                ];
            });

            $listeFournisseurs[] = [
                'fournisseur' => $fournisseur,
                'contacts' => $contactsAvecInfotels,
                'infotels' => $fournisseur->infotels,
                'contacte' => $listeAContacte->contacte,
            ];
        }

        return view('Fiche.listeAContacter', [
            'listeFournisseurs' => $listeFournisseurs,
            'codeListe' => $codeListe
        ]);
    }

    public function fournisseurContacted(Request $request, $codeListe, $fournisseurId)
    {
        $listeAContacter = ListeAContacter::where('codeListe', $codeListe)
        ->where('fournisseur', $fournisseurId)
        ->firstOrFail();

        $contacte = $request->has('contacte') ? 1 : 0;
    

        ListeAContacter::where('codeListe', $codeListe)
        ->where('fournisseur', $fournisseurId)
        ->update(['contacte' => $contacte]);
        
        return redirect()->back()->with('success', 'Le statut de contact a été mis à jour.');
    }

    public function deleteListe($codeListe){
        $listeAContacter = ListeAContacter::where('codeListe', $codeListe);
        $listeAContacter->delete();

        return redirect()->route('askCodeListe')->with('success', '* La liste a été supprimé avec succès *');
    }
}
