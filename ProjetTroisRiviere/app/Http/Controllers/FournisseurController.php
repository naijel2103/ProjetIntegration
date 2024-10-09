<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseurs;
use App\Models\Offres;
use App\Models\CategorieLiscences;


class FournisseurController extends Controller
{
    public function getListe(Request $requete)
    {
        $listeOffres = Offres::all();
        $listeCategories = CategorieLiscences::all();

        $offreSelect = $requete->input('offres', []);
        $catSelect =  $requete->input('categories', []);

        $requeteBD = Fournisseurs::query();

        if ($requete->has('offres')) {
            $requeteBD->whereHas('offres', function($sousRequete) use ($offreSelect) {
                $sousRequete->whereIn('codeUNSPSC', $offreSelect);
            });

            $requeteBD->withCount([
                'offres as nbr_offres_correspondant' => function ($sousRequete) use ($offreSelect) {
                    $sousRequete->whereIn('codeUNSPSC', $offreSelect);
                }
            ]);
        }
    
        if ($requete->has('categories')) {
            $requeteBD->whereHas('offres.categories', function($sousRequete) use ($catSelect) {
                $sousRequete->whereIn('numCategorie', $catSelect);
            });

            $requeteBD->withCount([
                'licence as nbr_categories_correspondant' => function ($sousRequete) use ($catSelect) {
                    $sousRequete->whereIn('numCategorie', $catSelect);
                }
            ]);

        }
    
        /*if ($requete->has('regions')) {
            $regions = $requete->input('regions');
            // Filtrer par région
            $query->whereIn('region', $regions);
        }
    
        if ($requete->has('villes')) {
            $villes = $requete->input('villes');
            // Filtrer par ville
            $query->whereIn('ville', $villes);
        }*/

        $fournisseurs = $requeteBD->get();

        $listeOffres = $listeOffres->sortByDesc(function ($offre) use ($offreSelect) {
            return in_array($offre->codeUNSPSC, $offreSelect) ? 1 : 0;
        });

        return view('Fiche.listeFournisseurs', [
            'fournisseurs' => $fournisseurs,

            'listeOffres' => $listeOffres,
            'listeCategories' => $listeCategories,


            'offreSelect' => $offreSelect,
            'catSelect' => $catSelect
            /*'regions' => $request->input('regions', []),
            'villes' => $request->input('villes', []),*/
        ]);
    }
}
