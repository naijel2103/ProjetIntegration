@extends('layouts.app')
@section('contenu')

@auth
    <form method="GET" action="{{ route('getListeFournisseur') }}">
        <h3>Filtres :</h3>

        <h4>Produits :</h4>
        @foreach ($produits as $produit)
            <label>
                <input type="checkbox" name="produits[]" value="{{ $produit->id }}" {{ in_array($produit->id, request('produits', [])) ? 'checked' : '' }}> {{ $produit->nom }}
            </label>
        @endforeach

        <h4>Catégories :</h4>
        @foreach ($categories as $categorie)
            <label>
                <input type="checkbox" name="categories[]" value="{{ $categorie->id }}" {{ in_array($categorie->id, request('categories', [])) ? 'checked' : '' }}> {{ $categorie->nom }}
            </label>
        @endforeach

        <button type="submit">Rechercher</button>
    </form>

    <ul>
        @foreach ($fournisseurs as $fournisseur)
            <li>
                {{ $fournisseur->nomFournisseur }} 
                ({{ $fournisseur->matching_offres_count }} offre(s) correspondante(s))
                ({{ $fournisseur->matching_categories_count }} catégorie(s) correspondante(s))
            </li>
        @endforeach
    </ul>
@endauth
@endsection