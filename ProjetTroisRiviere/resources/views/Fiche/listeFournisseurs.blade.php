@extends('layouts.app')
@section('contenu')

<script src="{{ asset('js/filtre.js') }}"></script>

    <form method="GET" action="{{ route('getListeFournisseur') }}">
        <div class="filtre-bloc">
            <div class="cols-4 grid-filtre">  
                <div class="rows-2 container-filtre">
                    <div class="recherche-filtre">
                        <h4>Offres </h4>
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
                        <h4>Catégories de licence </h4>
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
                        <h4>Régions </h4>
                        <input placeholder="Région" class="searchBar-filtre"/>
                    </div>
                    <div class="liste-filtre">
                        @foreach ($listeRegions as $region)
                        <div class="uneRegion">
                            <input type="checkbox" name="regions[]" value="{{ $region->codeRegion }}" @if(in_array($region->codeRegion, $regionSelect)) checked @endif>
                                {{ $region->codeRegion }} {{ $region->region }}
                            </input>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="rows-2 container-filtre">
                    <div class="recherche-filtre">
                        <h4>Municipalité </h4>
                        <input placeholder="Municipalite" class="searchBar-filtre"/>
                    </div>
                    <div class="liste-filtre">
                        @foreach ($listeVilles as $ville)
                        <div class="uneVille" data-codeRegion="{{ $ville->codeRegion }}">
                            <input type="checkbox" name="villes[]" value="{{ $ville->municipalite}}" @if(in_array($ville->municipalite, $villeSelect)) checked @endif>
                                {{ $ville->municipalite }}
                            </input>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="cols-2 search-bar">
                <div class="cols-4 status-bar">
                    <div class="unStatus">
                        <input type="checkbox" name="status" value="attente">En attente</input>
                    </div>
                    <div class="unStatus">
                        <input type="checkbox" name="status" value="accepte">Acceptées</input>
                    </div>
                    <div class="unStatus">
                        <input type="checkbox" name="status" value="refusees">Refusées</input>
                    </div>
                    <div class="unStatus">
                        <input type="checkbox" name="status" value="revise">À reviser</input>
                    </div>
                </div>

                <button type="submit" class="sendBtn">Rechercher</button>

            </div>
        </div>
        
        <hr>

        <ul>
            @foreach ($fournisseurs as $fournisseur)
                <li>
                    {{ $fournisseur->nomFournisseur }} 
                    {{ $fournisseur->nbr_offres_correspondant }}
                    {{ $fournisseur->nbr_categories_correspondant }}
                </li>
            @endforeach
        </ul>
    </form>
@endsection