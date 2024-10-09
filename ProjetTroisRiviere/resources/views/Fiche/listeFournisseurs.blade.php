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