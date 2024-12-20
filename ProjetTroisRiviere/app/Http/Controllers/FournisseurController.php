<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseurs;
use App\Models\Infotels;
use App\Models\Offres;
use App\Models\OffresFournisseurs;
use App\Models\CategorieLiscences;
use App\Models\SpecificationLiscences;
use App\Models\Liscences;
use App\Models\ListeAContacter;
use App\Models\Contacts;
use App\Http\Requests\FournisseurRequest;
use App\Http\Requests\infoTelsRequest;
use App\Http\Requests\LiscencesRequest;
use App\Http\Requests\SpecificationLiscencesRequest;
use App\Http\Requests\OffresFournisseursRequest;
use App\Http\Requests\ContactsRequest;
use App\Mail\AccountCreated;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ApiController;


class FournisseurController extends Controller
{
    
    public function checkEmail(Request $request)
    {
        $email = $request->query('email'); // Récupérer l'email de la requête GET
    
        if (!$email) {
            return response()->json(['error' => 'Email manquant'], 400);
        }
    
        $exists = Fournisseurs::where('email', $email)->exists(); // Vérifier si l'email existe

        return response()->json(['exists' => $exists]);
    }

    public function checkNEQ(Request $request)
    {
        $neq = $request->query('neq'); // Récupérer l'email de la requête GET
    
        if (!$neq) {
            return response()->json(['error' => 'neq manquant'], 400);
        }
    
        $exists = Fournisseurs::where('neq', $neq)->exists(); // Vérifier si l'email existe

        return response()->json(['exists' => $exists]);
    }

    public function checkRBQ(Request $request)
    {
        $numLiscence = $request->query('numLiscence'); // Récupérer l'email de la requête GET
    
        if (!$numLiscence) {
            return response()->json(['error' => 'RBQ manquant'], 400);
        }
    
        $exists = Liscences::where('numLiscence', $numLiscence)->exists(); // Vérifier si l'email existe

        return response()->json(['exists' => $exists]);
    }
    

    public function showCreationForm()
    {

        $listeOffres = Offres::all();
        $listeCategories = CategorieLiscences::all();
    
        return view('Profil.creation', [
            'listeOffres' => $listeOffres,
            'listeCategories' => $listeCategories,
            'offreSelect' => [],
            'catSelect' => []
        ]);
    }
    

    public function getListe(Request $requete)
    {

        $offreSelect = $requete->input('offres', []);
        $catSelect =  $requete->input('categories', []);
        $regionSelect = $requete->input('regions',[]);
        $villeSelect = $requete->input('villes',[]);

        $requeteBD = Fournisseurs::query()->where('statut', 'Acceptee');

        $listeOffres = Offres::whereIn('codeUNSPSC', OffresFournisseurs::select('offre'))->distinct()->get();
        $listeCategories = CategorieLiscences::whereIn('numCategorie', SpecificationLiscences::select('numCategorie'))->distinct()->get();
        $listeRegions = Fournisseurs::select('region','codeRegion')->distinct()->get();
        $listeVilles = Fournisseurs::select('codeRegion','municipalite')->distinct()->get();

        if ($requete->has('offres') || $requete->has('categories')) {
            $requeteBD->where(function($sousRequete) use ($requete, $offreSelect, $catSelect) {
                if ($requete->has('offres')) {
                    $sousRequete->whereHas('offres', function($sousRequeteoffre) use ($offreSelect) {
                        $sousRequeteoffre->whereIn('codeUNSPSC', $offreSelect);
                    });
                }
        
                if ($requete->has('categories')) {
                    $sousRequete->orWhereHas('licence', function($sousRequeteCat) use ($catSelect) {
                        $sousRequeteCat->whereHas('categorieLiscences', function($sousSousRequeteCat) use ($catSelect) {
                            $sousSousRequeteCat->whereIn('specification_liscences.numCategorie', $catSelect);
                        });
                    });
                }
            });
            
        
            if ($requete->has('offres')) {
                $requeteBD->withCount([
                    'offres as nbr_offres_correspondant' => function ($sousRequete) use ($offreSelect) {
                        $sousRequete->whereIn('codeUNSPSC', $offreSelect);
                    }
                ]);
            }
        
            if ($requete->has('categories')) {
                $requeteBD->withCount([
                    'licence as nbr_categories_correspondant' => function ($sousRequete) use ($catSelect) {
                        $sousRequete->whereHas('categorieLiscences', function($sousSousRequete) use ($catSelect) {
                            $sousSousRequete->whereIn('specification_liscences.numCategorie', $catSelect);
                        });
                    }
                ]);
            }
        }
        

        $fournisseurs = $requeteBD->get();

        $fournisseurs->transform(function($fournisseur) use ($regionSelect, $villeSelect) {
            $fournisseur->dansRegion = in_array($fournisseur->codeRegion, $regionSelect) ? 1 : 0;
            $fournisseur->dansVille = in_array($fournisseur->municipalite, $villeSelect) ? 1 : 0;
            return $fournisseur;
        });

        $listeOffres = $listeOffres->sortByDesc(function ($offre) use ($offreSelect) {
            return in_array($offre->codeUNSPSC, $offreSelect) ? 1 : 0;
        });
        $listeCategories = $listeCategories->sortBy(function ($cat) use ($catSelect) {
            return [
                in_array($cat->numCategorie, $catSelect) ? 0 : 1,
                (int)$cat->numCategorie
            ];
        });

        $listeRegions = $listeRegions->sortBy(function ($region) use ($regionSelect) {
            return [
                in_array($region, $regionSelect) ? 0 : 1,
                $region->codeRegion
            ];
        });

        $listeVilles = $listeVilles->sortBy(function ($ville) use ($villeSelect, $regionSelect) {
            return [
                in_array($ville->municipalite, $villeSelect) ? 0 : 1,
                in_array($ville->codeRegion, $regionSelect) ? 0 : 1
            ];
        });

        return view('Fiche.listeFournisseurs', [
            'fournisseurs' => $fournisseurs,

            'listeOffres' => $listeOffres,
            'listeCategories' => $listeCategories,
            'listeVilles' => $listeVilles,
            'listeRegions' => $listeRegions,


            'offreSelect' => $offreSelect,
            'catSelect' => $catSelect,
            'regionSelect' => $regionSelect,
            'villeSelect' => $villeSelect,
            
            'nbrOffreSelect' => count($offreSelect),
            'nbrCatSelect' => count($catSelect)
        ]);
    }

    public function createListe(Request $request){
        $request->validate([
            'fournisseurs' => 'required|array',
            'fournisseurs.*' => 'exists:fournisseurs,idFournisseur',
        ]);

        $fournisseurs = $request->input('fournisseurs');

        do {
            $codeListe = rand(10000000, 99999999);

            $exists = ListeAContacter::where('codeListe', $codeListe)->exists();
        } while ($exists);

        foreach ($fournisseurs as $fournisseur) {
            ListeAContacter::create([
                'fournisseur' => $fournisseur,
                'contacte' => 0,
                'codeListe' => $codeListe,
            ]);
        }


        return response()->json([
            'success' => true,
            'codeListe' => $codeListe,
        ]);
    }





    public function createFournisseur(FournisseurRequest $request)
{

    Log::debug('Requête reçue : ', $request->all());
      
        Log::debug('validated');
  
    try {

        $LiscencesRequest = new LiscencesRequest($request->all()); // Assure-toi que cela contient les données nécessaires

        $numLiscence = $request->input('rbqLicenseInput');
        if ($numLiscence !== null) {
            Liscences::create([
                'numLiscence' => $numLiscence,
                'statut' => $request->input('licenseStatus', "Erreur"),
                'type' => $request->input('entrepreneurType', "Erreur")
            ]);
        }


        // Création du fournisseur
        $fournisseur = new Fournisseurs();
        $fournisseur->neq = $request->input('neq', null);
        $fournisseur->nomFournisseur = $request->input('nom', null);
        $fournisseur->numLiscence = $request->input('rbqLicenseInput', null);
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
    

    public function edit(Fournisseurs $fournisseur)
    {
        $listeOffres = Offres::all();
        $listeCategories = CategorieLiscences::all();
    
        return view('fiche.edit', [
            'listeOffres' => $listeOffres,
            'listeCategories' => $listeCategories,
            'offreSelect' => [],
            'catSelect' => [],
            'fournisseur' => $fournisseur

        ]);
    }

    public function update(FournisseurRequest $requestFournisseurs, Fournisseurs $fournisseur )
    {
        $fournisseur->neq = $request->input('neq', null);
        $fournisseur->nomFournisseur = $request->input('nomFournisseur', null);
        $fournisseur->numLiscence = $request->input('numLiscence', null);
        $fournisseur->email = $request->input('email', null);
        $fournisseur->mdp = bcrypt($request->input('mdp', null));  // Assurez-vous de hasher le mot de passe
        $fournisseur->numCivique = $request->input('numCivique', null);
        $fournisseur->rue = $request->input('rue', null);
        $fournisseur->bureau = $request->input('bureau', null);
        $fournisseur->municipalite = $request->input('municipalite', null);
        $fournisseur->province = $request->input('province', null);
        $fournisseur->codePostal = $request->input('codePostal', null);
        $fournisseur->region = $request->input('region', null);
        $fournisseur->codeRegion = $request->input('codeRegion', null);
        $fournisseur->siteWeb = $request->input('siteWeb', null);
        $fournisseur->detailService = $request->input('detailService', null);
        $fournisseur->numTPS = $request->input('numTPS', null);
        $fournisseur->numTVQ = $request->input('numTVQ', null);
        $fournisseur->conditionPaiement = $request->input('conditionPaiement', null);
        $fournisseur->codeCondition = $request->input('codeCondition', null);
        $fournisseur->devise = $request->input('devise', null);
        $fournisseur->modCom = $request->input('modCom', null);
        $fournisseur->statut = $request->input('statut', null);

       
        $fournisseur->save();
    }
}

