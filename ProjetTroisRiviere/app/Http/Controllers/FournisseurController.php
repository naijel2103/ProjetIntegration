<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fournisseurs;

class FournisseurController extends Controller
{
    public function getListe(Request $request)
    {
        $produits = $request->input('produits', []);
        $categories = $request->input('categories', []);
        $regions = $request->input('regions', []);
        $villes = $request->input('villes', []);

        $requete = Fournisseurs::query();

        if (!empty($produits)) {
            $requete->where(function ($query) use ($produits) {
                $query->whereHas('offres', function ($subQuery) use ($produits) {
                    $subQuery->whereIn('codeUNSPSC', $produits);
                });
            });
        }

        $requete->withCount([
            'offres as nbr_offres_correspondant' => function ($subQuery) use ($produits) {
                $subQuery->whereIn('codeUNSPSC', $produits);
            },
            'offres as nbr_offres_correspondant'
        ]);

        /*
            ***CORRIGER LIEN ENTRE TABLE DANS MODELS***
        
        if (!empty($categories)) {
            $requete->where(function ($query) use ($categories) {
                foreach ($categories as $categoryId) {
                    $query->orWhereHas('licences', function ($subQuery) use ($categoryId) {
                        $subQuery->where('numCategorie', $categoryId);
                    });
                }
            });
        }

        $requete->withCount([
            'licence as nbr_categories_correspondant' => function ($subQuery) use ($categories) {
                $subQuery->whereIn('numCategorie', $categories);
            },
            'licence as nbr_categories_correspondant'
        ]);
*/
        /*
        if (!empty($villes)) {
            $query->where(function ($query) use ($villes) {
                foreach ($villes as $ville) {
                    $query->orWhere('ville', 'like', '%' . $ville . '%');
                }
            });
        }
        }*/

        $fournisseurs = $requete->get();

        return view('fournisseurs.getListe', ['fournisseurs' => $fournisseurs]);

    }
}
