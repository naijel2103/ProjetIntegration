<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        $produits = $request->input('produits', []);
        $categories = $request->input('categories', []);
        $regions = $request->input('regions', []);
        $villes = $request->input('villes', []);

        $requete = Produit::query();

        if (!empty($produits)) {
            $requete->where(function ($query) use ($produits) {
                $query->whereHas('offres.offres_fournisseurs', function ($subQuery) use ($produits) {
                    $subQuery->whereIn('offres.id', $produits);
                });
            });
        }

        $requete->withCount([
            'offres.offres_fournisseurs as matching_offres_count' => function ($subQuery) use ($produits) {
                $subQuery->whereIn('offres.id', $produits);
            },
            'offres as offres_count'
        ]);

        if (!empty($categories)) {
            $requete->where(function ($query) use ($categories) {
                foreach ($categories as $categoryId) {
                    $query->orWhereHas('licence.categorieLiscences', function ($subQuery) use ($categoryId) {
                        $subQuery->where('categorie_liscences.id', $categoryId);
                    });
                }
            });
        }

        $requete->withCount([
            'licence.categorieLiscences as matching_categories_count' => function ($subQuery) use ($categories) {
                $subQuery->whereIn('categorie_liscences.id', $categories);
            },
            'licence as categories_count'
        ]);

        /*if ($prixMin) {
            $query->where('prix', '>=', $prixMin); // Filtrer par prix minimum
        }*/

        $fournisseurs = $requete->get();

        return view('fournisseurs.index', ['fournisseurs' => $fournisseurs]);

    }
}
