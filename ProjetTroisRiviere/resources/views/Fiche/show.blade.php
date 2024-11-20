
<link rel="stylesheet" style="text/css" href="\..\css\FicheFournisseurCss\ficheCss.css">
@extends('layouts.app')
@section('contenu')

<h1>Page du fournisseur {{ $fournisseur->nomFournisseur }}</h1>

<div class="button-container">
    <a href="{{ route('fiche.index') }}" class="btn btn-primary btn-lg" id="btnRetour">Retour</a>
    <a href="{{ route('fiche.gererDemande', [$fournisseur]) }}" class="btn btn-success btn-lg" id="btnGererDemande">Gérer la demande</a>
  
    @if ( $fournisseur->statut == "Accepte" )
        <a href="{{ route('fiche.envoieFicheFinance', [$fournisseur]) }}" class="btn btn-warning btn-lg" id="btnExporter">Exporter vers les Finances</a>
    @endif
</div>
  

@if (isset($fournisseur))
<div class="fournisseur-card">
    <div class="fournisseur-info">


    <div class="info-box identification">
      <div class="info-title">Identification:</div>
        <div class="info-content">
          <div>
            <b>Neq:</b> {{$fournisseur->neq }}
          </div>
          <div>
            <b>Nom:</b> {{ $fournisseur->nomFournisseur }}
          </div>
          <div>
            <b>Email:</b> {{ $fournisseur->email }}
          </div>
      </div>
    </div>

    <div class="info-box adresse-contact">
      <div class="info-title">Adresse et Contact:</div>
      <div class="info-content">
        <div>
          {{ $fournisseur->numCivique }}
           {{ $fournisseur->rue }}
            {{ $fournisseur->municipalite }}
              ({{ $fournisseur->region }})
        </div>
        <div >
          <b>Bureau:</b> {{ $fournisseur->bureau }}
        </div>
        <div>
          <b>Code de la région: </b>{{ $fournisseur->codeRegion }}
        </div>
        <div>
          <b>Code Postal:</b> {{ $fournisseur->codePostal }}
        </div>
        <div>
          <b>Site Web:</b> <a href="{{ $fournisseur->siteWeb }}" target="_blank">{{ $fournisseur->siteWeb }}</a>
        </div>
        <div>
          <b>Numéro(s) de téléphone:</b> {{ $infotel->numTel }}(poste {{ $infotel->postTel }}) ({{ $infotel->typeTel }})
        </div>
      </div>
    </div>



      <div class="info-box">
        <div class="info-title">Numéro de licence:</div>
        <div class="info-content"><b>{{ $fournisseur->numLiscence }}</b></div>
      </div>
    
      <div class="info-box">
        <div class="info-title">Détail du service:</div>
        <div class="info-content"><b>{{ $fournisseur->detailService }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Numéro TPS:</div>
        <div class="info-content"><b>{{ $fournisseur->numTPS }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Numéro TVQ:</div>
        <div class="info-content"><b>{{ $fournisseur->numTVQ }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Condition de paiement:</div>
        <div class="info-content"><b>{{ $fournisseur->conditionPaiement }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Code de condition:</div>
        <div class="info-content"><b>{{ $fournisseur->codeCondition }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Devise:</div>
        <div class="info-content"><b>{{ $fournisseur->devise }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Mode de communication:</div>
        <div class="info-content"><b>{{ $fournisseur->modCom }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Statut:</div>
        <div class="info-content"><b>{{ $fournisseur->statut }}</b></div>
      </div>

      <div class="info-box">
        <div class="info-title">Prénom:</div>
        <div class="info-content"><b>{{ $contact->prenom }}</b></div>
      </div>
      <div class="info-box">
      <div class="info-title">Nom:</div>
        <div class="info-content"><b>{{ $contact->nom }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Fonction:</div>
        <div class="info-content"><b>{{ $contact->fonction }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Statut:</div>
        <div class="info-content"><b>{{ $liscence->statut }}</b></div>
      </div>
      <div class="info-box">
      <div class="info-title">Type:</div>
        <div class="info-content"><b>{{ $liscence->type }}</b></div>
      </div>



      <div class="info-box">
        <div class="info-title">Numéro Catégorie:</div>
        <div class="info-content"><b>{{ $catLiscence->numCategorie }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Nom Catégorie:</div>
        <div class="info-content"><b>{{ $catLiscence->nom }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Classe:</div>
        <div class="info-content"><b>{{ $catLiscence->classe }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Mode de communication:</div>
        <div class="info-content"><b>{{ $fournisseur->modCom }}</b></div>
      </div>
      <div class="info-box">
        <div class="info-title">Statut:</div>
        <div class="info-content"><b>{{ $fournisseur->statut }}</b></div>
      </div>
    </div>
  </div>


@else
  <p>Le  fournisseur n'existe pas</p>
@endif
@endsection
