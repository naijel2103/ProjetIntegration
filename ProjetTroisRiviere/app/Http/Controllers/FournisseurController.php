<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseurs;
use App\Models\Offres;
use App\Models\CategorieLiscences;
use App\Models\Liscences;

use App\Http\Controllers\ApiController;


class FournisseurController extends Controller
{
    public function getListe(Request $requete)
    {
        $apiController = new ApiController();

        $listeOffres = Offres::all();
        $listeCategories = CategorieLiscences::all();
        $listeRegions = collect($apiController->getRegion());
        $listeVilles = collect($apiController->getVille());

        $offreSelect = $requete->input('offres', []);
        $catSelect =  $requete->input('categories', []);
        $regionSelect = $requete->input('regions',[]);
        $villeSelect = $requete->input('villes',[]);

        $requeteBD = Fournisseurs::query();

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
    
        if ($requete->has('regions')) {
            $requeteBD->where(function($sousRequete) use ($requete, $regionSelect) {
                $sousRequete->whereIn('codeRegion', $regionSelect);
            });
        }

        if ($requete->has('villes')) {
            $requeteBD->where(function($sousRequete) use ($requete, $villeSelect) {
                $sousRequete->whereIn('municipalite', $villeSelect);
            });
        }
        

        $fournisseurs = $requeteBD->get();

        $listeOffres = $listeOffres->sortByDesc(function ($offre) use ($offreSelect) {
            return in_array($offre->codeUNSPSC, $offreSelect) ? 1 : 0;
        });

        $listeCategories = $listeCategories->sortBy(function ($cat) use ($catSelect) {
            return [
                in_array($cat->numCategorie, $catSelect) ? 0 : 1,
                (int)$cat->numCategorie
            ];
        });

        $listeRegions = $listeRegions->sortBy(function ($nomRegion, $codeRegion) use ($regionSelect) {
            return [
                in_array($codeRegion, $regionSelect) ? 0 : 1,
                (int)$codeRegion
            ];
        });

        $listeVilles = $listeVilles->sortByDesc(function ($ville) use ($villeSelect) {
            $nomVille = is_array($ville) ? $ville['nomVille'] : $ville->nomVille;
            return in_array($nomVille, $villeSelect) ? 1 : 0;
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
            'villeSelect' => $villeSelect
            
        ]);
    }
}
