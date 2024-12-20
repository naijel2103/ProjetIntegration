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
use Illuminate\Support\Facades\Session;
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
      

        $idFournisseur = Session::get('idFournisseur');

        if ($idFournisseur) {
            $fournisseur = Fournisseurs::find($idFournisseur);

        }
  
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
        $idFournisseur = Session::get('idFournisseur');

        if ($idFournisseur) {
            $fournisseur = Fournisseurs::find($idFournisseur);

        }
        $statut = $fournisseur->statut;
        if($statut == "Acceptee"){
            if ($idFournisseur) {
                $fournisseur = Fournisseurs::find($idFournisseur)
                ->update(['statut' => 'Desactivee']);
            }
            return redirect()->back()->with('success', 'Le  fournisseur a bien été désactivé');
        } else {
            if ($idFournisseur) {
                $fournisseur = Fournisseurs::find($idFournisseur)
                ->update(['statut' => 'Acceptee']);
            }
                
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
                        $modele = Modeles_courriels::where('idModele',1)->first();
                        Mail::to($fournisseur->email )->send(new EnvoieRefuFicheRaison($raison,$modele));
                    }else
                    {
                        $modele = Modeles_courriels::where('idModele',1)->first();
                        Mail::to($fournisseur->email )->send(new EnvoieRefuFiche($modele));
                    }
                }else if($request->statut == "Acceptee"){

                    $modele = Modeles_courriels::where('idModele',2)->first();
                    Mail::to($fournisseur->email )->send(new EnvoieAccepteFiche($modele));
                    $demandeInscription->raisonRefus = null;
                }
                $demandeInscription->save(); // Enregistrer les modifications
                $fournisseur->save(); // Enregistrer les modifications

            } else if($demandeInscription == null) {
                $fournisseur->statut = $request->statut;

                if($request->statut == "Refusee")
                {
                    $raison = $request->raisonRefus;
                    $donneeCryptee = encrypt($request->raisonRefus);
                    $estCochee = $request->has('envoyerRaison');
                 
                    if($estCochee)
                    {
                        $modele = Modeles_courriels::where('idModele',1)->first();
                        Mail::to($fournisseur->email )->send(new EnvoieRefuFicheRaison($raison,$modele));
                    }else
                    {
                        $modele = Modeles_courriels::where('idModele',1)->first();
                        Mail::to($fournisseur->email )->send(new EnvoieRefuFiche($modele));
                    }

                    Demandesinscriptions::create([  
                        'idFournisseur'=> $fournisseur->idFournisseur,
                        'dateDemande' => $dateFormatee,
                        'dateDerniereMod' => $dateFormatee,
                        'dateChangementStatut' => $dateFormatee,
                        'statut' => $request->statut,
                        'raisonRefus' => $donneeCryptee
                    ]);

                }else{
                    
                    if($request->statut == "Acceptee"){
                        $modele = Modeles_courriels::where('idModele',2)->first();
                        Mail::to($fournisseur->email )->send(new EnvoieAccepteFiche($modele));
                    }
                    
                    Demandesinscriptions::create([
                        'idFournisseur'=> $fournisseur->idFournisseur,
                        'dateDemande' => $dateFormatee,
                        'dateDerniereMod' => $dateFormatee,
                        'dateChangementStatut' => $dateFormatee,
                        'statut' => $request->statut,
                        'raisonRefus' => null
                    ]);
                }
                
                $fournisseur->save();
            }
            
            return redirect()->route('fiche.index')->with('message', "Modification de  réussi!");
        }catch(\Throwable $e)
        {
            dd($e);
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
                                        "contacts","infotels","liscences","speLiscences","catLiscences","offres","offreFournisseurs","infotelsContacts",
                                        ));
    }

    public function askCode(Request $request){
        if ($request->isMethod('get') && $request->has('codeListe')) {
            $codeListe = $request->input('codeListe');
            return redirect()->route('showListeAContacte', ['codeListe' => $codeListe]);
        }
        return view('Fiche.askCodeListe');
    }


    
    public function edit(Fournisseurs $fournisseur)
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
      
        $contacts = Contacts::where('fournisseur', $fournisseur->idFournisseur)->first();
        $infotels = Infotels::where('fournisseur', $fournisseur->idFournisseur)->first();

        $listeOffres = Offres::all();
        $listeCategories = CategorieLiscences::all();

        
        $demandeInscription = Demandesinscriptions::where('idFournisseur', $fournisseur->idFournisseur)->first();
        return View('fiche.edit',compact("fournisseur", "demandeInscription",
        "contacts","infotels","liscences","speLiscences","catLiscences","offres","offreFournisseurs"
            
                    ),[
                        'listeOffres' => $listeOffres,
                        'listeCategories' => $listeCategories,
                        'offreSelect' => [],
                        'catSelect' => [],
                        'fournisseur' => $fournisseur
            
                    ]);
    }


    public function update(FournisseurRequest $requestFournisseurs, Fournisseurs $fournisseur)
    {
        Log::debug('Requête reçue : ', $request->all());
      
        Log::debug('validated');
  
    try {

        $LiscencesRequest = new LiscencesRequest($request->all()); // Make sure this contains the necessary data

        Liscences::create([
            'numLiscence'=> $request->input('rbqLicenseInput', "0113456789"),
            'statut' => $request->input('licenseStatus', "Erreur"),
            'type'=> $request->input('entrepreneurType', "Erreur")
        ]);  
        Log::error('numLiscence');


        // Création du fournisseur
        $fournisseur = new Fournisseurs();
        $fournisseur->neq = $request->input('neq', null);
        $fournisseur->nomFournisseur = $request->input('nom', null);
        $fournisseur->numLiscence = $request->input('rbqLicenseInput', "0123456789");
        $fournisseur->email = $request->input('email', 'null@gmail.com');
        $fournisseur->mdp = bcrypt($request->input('mdp', null));
        $fournisseur->numCivique = $request->input('numero_civique', null);
        $fournisseur->rue = $request->input('rue', null);
        $fournisseur->bureau = $request->input('bureau', null);
        $fournisseur->municipalite = $request->input('ville', '');
        $fournisseur->province = $request->input('province', null);
        $fournisseur->codePostal = $request->input('codePostal', 'g7t2r4');
        $fournisseur->region = $request->input('region', null);
        $fournisseur->codeRegion = $request->input('codeRegion', null);
        $fournisseur->siteWeb = $request->input('siteInternet', null);
        $fournisseur->detailService = $request->input('detailService', null);
        $fournisseur->numTPS = $request->input('numTPS', null);
        $fournisseur->numTVQ = $request->input('numTVQ', null);
        $fournisseur->conditionPaiement = $request->input('conditionPaiement', null);
        $fournisseur->codeCondition = $request->input('codeCondition', null);
        $fournisseur->devise = $request->input('devise', null);
        $fournisseur->modCom = $request->input('modCom', null);
        $fournisseur->statut = $request->input('statut', 'En attente');

        // Save the fournisseur first
        $fournisseur->save();

        // Get the ID of the newly created fournisseur
        // Pass the $fournisseur object to createInfotel
        $infoTelsRequest = new InfoTelsRequest($request->all()); // Make sure this contains the necessary data

        InfoTels::create([
            'typeTel' => "auto",
            'numTel' => $request->input('num_telstep2', "1231231233"),
            'postTel'=> "1",
            'fournisseur' => $fournisseur->idFournisseur,  // Utilisez l'ID de l'objet
            'contact' => "12",
        ]);  

        $OffresFournisseursRequest = new OffresFournisseursRequest($request->all()); // Make sure this contains the necessary data

        // Créer une première SpecificationLiscence si categories[0] n'est pas vide
        if (!empty($request->input('offres[0]'))) {
            OffresFournisseurs::create([
                'fournisseur' => $fournisseur->idFournisseur,
                'offre' => $request->input('offres[0]', '00000000')
            ]);
        }

        if (!empty($request->input('offres[1]'))) {
            OffresFournisseurs::create([
                'fournisseur' => $fournisseur->idFournisseur,
                'offre' => $request->input('offres[1]', '00000000')
            ]);
        }

        if (!empty($request->input('offres[2]'))) {
            OffresFournisseurs::create([
                'fournisseur' => $fournisseur->idFournisseur,
                'offre' => $request->input('offres[2]', '00000000')
            ]);
        }

        if (!empty($request->input('offres[3]'))) {
            OffresFournisseurs::create([
                'fournisseur' => $fournisseur->idFournisseur,
                'offre' => $request->input('offres[3]', '00000000')
            ]);
        }


        $SpecificationLiscencesRequest = new SpecificationLiscencesRequest($request->all()); // Make sure this contains the necessary data

        // Créer une première SpecificationLiscence si categories[0] n'est pas vide
        if (!empty($request->input('categories[0]'))) {
            SpecificationLiscences::create([
                'numLiscence' => $fournisseur->numLiscence,
                'numCategorie' => $request->input('categories[0]')
            ]);
        }

        // Créer une deuxième SpecificationLiscence si categories[1] n'est pas vide
        if (!empty($request->input('categories[1]'))) {
            SpecificationLiscences::create([
                'numLiscence' => $fournisseur->numLiscence,
                'numCategorie' => $request->input('categories[1]')
            ]);
        }

        if (!empty($request->input('categories[2]'))) {
            SpecificationLiscences::create([
                'numLiscence' => $fournisseur->numLiscence,
                'numCategorie' => $request->input('categories[2]')
            ]);
        }

        if (!empty($request->input('categories[3]'))) {
            SpecificationLiscences::create([
                'numLiscence' => $fournisseur->numLiscence,
                'numCategorie' => $request->input('categories[3]')
            ]);
        }

        $ContactsRequest = new ContactsRequest($request->all()); // Make sure this contains the necessary data

        // Créer une première SpecificationLiscence si categories[0] n'est pas vide
            Contacts::create([
                'fournisseur' => $fournisseur->idFournisseur,
                'prenom' => $request->input('prenom-step5'),
                'nom' => $request->input('nom-step5'),
                'fonction' => $request->input('fonction-step5'),
                'email' => $request->input('email_contact-step5'),
            ]);
        

          // Réponse JSON
        Log::info('Tentative de création du fournisseur');
      
        return response()->json(['success' => true]);


    } catch (\Exception $e) {

        Log::error('Erreur lors de la création du fournisseur: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Erreur serveur.'], 500);
    }
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
