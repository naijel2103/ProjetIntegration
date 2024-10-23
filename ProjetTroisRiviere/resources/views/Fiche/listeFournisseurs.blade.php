@extends('layouts.app')
@section('contenu')

<script src="{{ asset('js/filtre.js') }}"></script>

    <form method="GET" action="{{ route('getListeFournisseur') }}">
        <h3>Filtres: </h3>

        <div class="cols-4 grid-filtre">  
            <div class="rows-2 container-filtre">
                <div class="recherche-filtre">
                    <h4>Offres: </h4>
                    <input placeholder="Offre" class="searchBar-filtre"/>
                </div>
                <div class="liste-filtre">
                    @foreach ($listeOffres as $offre)
                    <div class="uneOffre">
                        <input type="checkbox" name="offres[]" value="{{ $offre->codeUNSPSC }}" @if(in_array($offre ->codeUNSPSC, $offreSelect)) checked @endif>
                                {{ $offre->nom }}
                        </input>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="rows-2 container-filtre">
                <div class="recherche-filtre">
                    <h4>Catégories de liscence: </h4>
                    <input placeholder="Catégorie" class="searchBar-filtre"/>
                </div>
                <div class="liste-filtre">
                    @foreach ($listeCategories as $categorie)
                    <div class="uneCategorie">
                        <input type="checkbox" name="categories[]" value="{{ $categorie->numCategorie }}" @if(in_array($categorie ->numCategorie, $catSelect)) checked @endif>
                            {{ $categorie->numCategorie }} {{ $categorie->nom }}
                        </input>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="rows-2 container-filtre">
                <div class="recherche-filtre">
                    <h4>Régions: </h4>
                    <input placeholder="Région" class="searchBar-filtre"/>
                </div>
                <div class="liste-filtre">
                    @foreach ($listeRegions as $codeRegion => $nomRegion)
                    <div class="uneRegion">
                        <input type="checkbox" name="regions[]" value="{{ $codeRegion }}" @if(in_array($codeRegion, $regionSelect)) checked @endif>
                            {{ $codeRegion }} {{ $nomRegion }}
                        </input>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="rows-2 container-filtre">
                <div class="recherche-filtre">
                    <h4>Municipalite: </h4>
                    <input placeholder="Municipalite" class="searchBar-filtre"/>
                </div>
                <div class="liste-filtre">
                    @foreach ($listeVilles as $ville)
                    <div class="uneVille">
                        <input type="checkbox" name="villes[]" value="{{ $ville['nomVille']}}" @if(in_array($ville["nomVille"], $villeSelect)) checked @endif>
                            {{ $ville['nomVille'] }}
                        </input>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit">Rechercher</button>
    </form>

    <ul>
        @foreach ($fournisseurs as $fournisseur)
            <li>
                {{ $fournisseur->nomFournisseur }} 
                {{ $fournisseur->matching_offres_count }}
                {{ $fournisseur->matching_categories_count }}
            </li>
        @endforeach
    </ul>
@endsection