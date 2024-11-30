<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseurs;
use App\Models\Offres;
use App\Models\OffresFournisseurs;
use App\Models\CategorieLiscences;
use App\Models\SpecificationLiscences;
use App\Models\Liscences;
use App\Models\ListeAContacter;
use App\Http\Requests\FournisseurRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ApiController;


class FournisseurController extends Controller
{
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
        Log::debug('Requête reçue : ', $request->all());  // Loguer toutes les données reçues
    
        try {
            $fournisseur = new Fournisseurs();
            $fournisseur->neq = $request->input('neq', null);
            $fournisseur->nomFournisseur = $request->input('nomFournisseur', null);
            $fournisseur->numLiscence = $request->input('numLiscence', null);
            $fournisseur->email = $request->input('email', 'null@gmail.com');
            $fournisseur->mdp = bcrypt($request->input('mdp', null));
            $fournisseur->numCivique = $request->input('numero_civique', null);  // Vérifier ici
            $fournisseur->rue = $request->input('rue', null);
            $fournisseur->bureau = $request->input('bureau', null);
            $fournisseur->municipalite = $request->input('municipalite', 'null');
            $fournisseur->province = $request->input('province', null);
            $fournisseur->codePostal = $request->input('codePostal', 'g7t2r4');
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
            $fournisseur->statut = $request->input('statut', 'En attente');
    
            // Sauvegarder le fournisseur
            $fournisseur->save();
    
            // Réponse JSON
            return response()->json(['success' => true]);
    
        } catch (\Exception $e) {
            // Log l'exception et retourne un message d'erreur
            Log::error('Erreur lors de la création du fournisseur: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erreur serveur.'], 500);
        }
    }
    
}

