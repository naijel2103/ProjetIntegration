<link rel="stylesheet" style="text/css" href="\css\GabaritCss\ficheCss.css">

@section('titre', 'Connexion')
@extends('layouts.app')
@section('contenu')

<script src="{{ asset('js/contact-scroll.js') }}"></script>

<section class="main-container">

  <div class="top-box">
    <h1>Liste des fournisseurs</h1>

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
                        @foreach( $fournisseur['infotels'] as $index => $infoTel)
                        <div class="carteCom">
                            <div>{{ $infoTel->numTel }}</div>
                            <div>{{ $infoTel->typeTel }}</div>
                            <div>{{ $infoTel->postTel }}</div>
                        </div>
                        @endforeach
                    </div>
                    <div class="btnCards">
                        <button type="button"class="btnUpCards" id="UpComs">⩟</button>
                        <button type="button" class="btnDownCards" id="DownComs">⩡</button>
                    </div>
                </div>

                <div class="infoContact">
                    <div class="listeContact">
                        @foreach( $fournisseur['contacts'] as $index => $infoContact)
                        <div class="carteContact">
                            <div>{{ $infoContact['contact']->prenom }} {{ $infoContact['contact']->nom }}, {{ $infoContact['contact']->fonction }}</div>
                            <div>{{ $infoContact['contact']->email }}</div>
                            <div class="infoComsContact">
                                <div class="listeComsContact">
                                    @foreach( $infoContact['infotels'] as $index => $infoTel)
                                    <div class="carteComContact">
                                        <div>{{ $infoTel->numTel }} #{{ $infoTel->postTel }}</div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="btnCards">
                                    <button type="button"class="btnUpCards" id="UpComs">→</button>
                                    <button type="button" class="btnDownCards" id="DownComs">←</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="btnCards">
                        <button type="button"class="btnUpCards" id="UpComs">⩟</button>
                        <button type="button" class="btnDownCards" id="DownComs">⩡</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
  </div>
@endsection