<link rel="stylesheet" style="text/css" href="\css\GabaritCss\ficheCss.css">

@section('titre', 'Connexion')
@extends('layouts.app')
@section('contenu')

<script src="{{ asset('js/contact-scroll.js') }}"></script>

<section class="main-container">

    <div class="top-box">
        <h1>Liste des fournisseurs</h1>
    </div>

    <div class="content-box">
        <div class="listeAContacte">
            @foreach($listeFournisseurs as $fournisseur)
                <div class="unFournisseur" data-fournisseur-id="{{ $fournisseur['fournisseur']->idFournisseur }}" data-current-index="{{ $fournisseur->current_index ?? 0 }}">
                    <div class="infoFournisseur">
                        <div>{{ $fournisseur['fournisseur']->nomFournisseur }}</div>
                        <div>{{ $fournisseur['fournisseur']->email }}</div>
                    </div>

                    <div class="infoComs">
                        <div class="listeComs">
                        @if($fournisseur['infotels']->isNotEmpty())
                            @foreach( $fournisseur['infotels'] as $index => $infoTel)
                            <div class="carteCom">
                                <div>{{ $infoTel->numTel }}</div>
                                <div>{{ $infoTel->typeTel }}</div>
                                <div>{{ $infoTel->postTel }}</div>
                            </div>
                            @endforeach
                        </div>
                        <div class="btnComs">
                            <button type="button"class="btnUpComs btn-carte">⩟</button>
                            <button type="button" class="btnDownComs btn-carte">⩡</button>
                        </div>
                        @else
                            <div>
                                <p>Aucun numéro de téléphone</p>      
                            </div>
                        @endif
                    </div>

                    <div class="infoContact">
                        <div class="listeContact">
                        @if($fournisseur['contacts']->isNotEmpty())
                            @foreach( $fournisseur['contacts'] as $index => $infoContact)
                            <div class="carteContact" data-contact-id="{{ $infoContact['contact']->idContact }}" data-current-index="{{ $fournisseur->current_index ?? 0 }}">
                                <div>{{ $infoContact['contact']->prenom }} {{ $infoContact['contact']->nom }}, {{ $infoContact['contact']->fonction }}</div>
                                <div>{{ $infoContact['contact']->email }}</div>
                                <div class="infoComsContact">
                                    @if($infoContact['infotels']->isNotEmpty())
                                        <div class="listeComsContact">
                                            @foreach( $infoContact['infotels'] as $index => $infoTel)
                                            <div class="carteComsContact" data-contact-id="{{ $infoContact['contact']->idContact }}">
                                                <div>{{ $infoTel->numTel }} #{{ $infoTel->postTel }}</div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="btnCards">
                                            <button type="button" class="btnDownContactComs btn-carte" data-leContact-id="{{ $infoContact['contact']->idContact}}">←</button> 
                                            <button type="button" class="btnUpContactComs btn-carte" data-leContact-id="{{ $infoContact['contact']->idContact }}">→</button>
                                        </div>
                                    @else
                                    <div>
                                        <p>Aucun téléphone</p>      
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div>
                                <p>Aucun contact</p>      
                            </div>
                        @endif
                        </div>
                        @if($fournisseur['contacts']->isNotEmpty())
                        <div class="btnContact">
                            <button type="button"class="btnUpContact btn-carte" id="UpComs">⩟</button>
                            <button type="button" class="btnDownContact btn-carte" id="DownComs">⩡</button>
                        </div>
                        @endif
                    </div>

                    <div class="infoContacte">
                        <div>
                        <form action="{{ route('updateContacte', ['codeListe' => $codeListe, 'idFournisseur' => $fournisseur['fournisseur']->idFournisseur]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="checkbox" name="contacte" value="" onchange="this.form.submit()" @if($fournisseur['contacte']) checked @endif></input>
                            <p>
                                @if($fournisseur['contacte'])
                                    Contacté
                                @else
                                    Non contacté
                                @endif
                            </p>
                        </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bottom-box">
        <button id="openPopupDelete" class="openPopup-btn">Supprimer la liste</button>
    </div>

    <div id="popUpDelete" class="popup-modal" style="display: none;">
        <div class="popup-content">
        <p>Êtes-vous sûr de vouloir supprimer cette liste?</p>
        <div class="popup-btns">
            <form method="POST" action="{{ route('deleteListe', ['codeListe' => $codeListe]) }}">
            @csrf
            @method('DELETE')
                <button type="submit" class="popup-btn yesBtn">Oui, supprimer</button>
            </form>
            <button id="closePopUpBtn" class="popup-btn noBtn">Non, annuler</button>
        </div>
        </div>
    </div>
@endsection