@extends('layouts.app')
@section('contenu')

<script src="{{ asset('js/filtre.js') }}"></script>

    <form method="GET" action="{{ route('getListeFournisseur') }}">
        <div class="bloc">
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

                <button type="submit" class="sendBtn">Rechercher</button>
            </div>
        </div>

        <div class="bloc">
            <div class="container-fournisseur cols-2">
                <div class="liste-fournisseur">
                    <div class="cols-7 titre-fournisseur">
                        <div  class="info info-nom info-titre">
                            <h6>Fournisseur</h6>
                        </div>
                        <div  class="info info-ville info-titre">
                            <h6>Ville</h6>
                        </div>
                        <div  class="info info-offre info-titre">
                            <h6>Offres</h6>
                        </div>
                        <div  class="info info-cat info-titre">
                            <h6>Catégories de travaux</h6>
                        </div>
                        <div  class="info info-fiche info-titre">
                            <h6>Fiche </br> fournisseur</h6>
                        </div>
                        <div  class="info info-select info-titre">
                            <h6>Sélectionner</h6>
                        </div>
                    </div>
                    <div class="les-fournisseurs">
                        @foreach ($fournisseurs as $fournisseur)
                        <div class="cols-7 un-fournisseur">
                            <div  class="info info-nom">
                                {{ $fournisseur->nomFournisseur }} 
                            </div>
                            <div  class="info info-ville"  data-dans_ville="{{$fournisseur->dansVille}}" data-dans_region="{{$fournisseur->dansRegion}}" 
                                data-ville_selected="{{$villeSelect ? 'true' : 'false' }}" data-region_selected="{{$regionSelect ? 'true' : 'false' }}">
                                {{ $fournisseur->municipalite }}
                            </div>
                            <div  class="info info-offre" data-nbr_offres={{$nbrOffreSelect}} data-nbr_offres_correspondant="{{$fournisseur->nbr_offres_correspondant}}">
                                {{ empty($fournisseur->nbr_offres_correspondant) ? '0' : $fournisseur->nbr_offres_correspondant }} / {{$nbrOffreSelect}}
                            </div>
                            <div class="info info-cat" data-nbr_cats={{$nbrCatSelect}} data-nbr_cats_correspondant="{{$fournisseur->nbr_categories_correspondant}}">
                                {{ empty($fournisseur->nbr_categories_correspondant) ? '0' : $fournisseur->nbr_categories_correspondant }} / {{$nbrCatSelect}}
                            </div>
                            <div  class="info info-fiche">
                                <a href="">Fiche</a>
                            </div>
                            <div  class="info info-select">
                                <input type="checkbox" name="foursSelect[]" value="{{$fournisseur->idFournisseur }}"></input>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button class="extractBtn">Extraire la sélection</button>
            </div>
        </div>
    </form>
@endsection