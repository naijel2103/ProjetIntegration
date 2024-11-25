
<link rel="stylesheet" style="text/css" href="\..\css\FicheFournisseurCss\ficheCss.css">
@extends('layouts.app')
@section('contenu')

<h1>Page du fournisseur {{ $fournisseur->nomFournisseur }}</h1>

<div class="button-container">
    <a href="{{ route('fiche.index') }}" class="btn btn-primary btn-lg" id="btnRetour">Retour</a>
    <a href="{{ route('fiche.gererDemande', [$fournisseur]) }}" class="btn btn-success btn-lg" id="btnGererDemande">Gérer la demande</a>
  
    @if ( $fournisseur->statut == "Acceptee" )
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
                <div>
                    <b>Statut:</b>      @if($fournisseur->statut == "Refusee")
                                            <div>
                                                <img src="../Images/refuse.png" alt="refusee" id='imgStatut'>
                                                {{ $fournisseur->statut }}
                                            </div>
                                        @elseif($fournisseur->statut == "Acceptee")
                                            <div>
                                                <img src="../Images/accepter.png" alt="acceptee" id='imgStatut'>
                                                {{ $fournisseur->statut }}
                                            </div>
                                        @elseif($fournisseur->statut == "Desactivee")
                                            <div>
                                                <img src="../Images/desactivee.png" alt="desactivee" id='imgStatut'>
                                                {{ $fournisseur->statut }}
                                            </div>
                                        @else
                                            <div>
                                                <img src="../Images/enAttente.png" alt="enAttente" id='imgStatut'>
                                                {{ $fournisseur->statut }}
                                            </div>
                                        @endif
                </div>
            </div>
        </div>


        <div class="info-box adresse-contact">
            <div class="info-title">Adresse</div>
            <div class="info-content">
                <div>
                    {{ $fournisseur->numCivique }}
                    {{ $fournisseur->rue }}
                    {{ $fournisseur->municipalite }}
                    ({{ $fournisseur->region }})
                </div>
                <div>
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
                <b>Numéro(s) de téléphone:</b> 
                <div class="infotel-container">
          @foreach($infotels as $infotel)
            <div class="infotel-item">
            {{ $infotel->numTel }} (poste {{ $infotel->postTel }}) ({{ $infotel->typeTel }})
            </div>
           @endforeach
            </div>
            </div>
        </div>

 
        <div class="info-box finances">
            <div class="info-title">Finances:</div>
            <div class="info-content">
                <div>
                    <b>Numéro TPS:</b> {{ $fournisseur->numTPS }}
                </div>
                <div>
                    <b>Numéro TVQ:</b> {{ $fournisseur->numTVQ }}
                </div>
                <div>
                    <b>Condition de paiement:</b> {{ $fournisseur->conditionPaiement }}
                </div>
                <div>
                    <b>Devise:</b> {{ $fournisseur->devise }}
                </div>
                <div>
                    <b>Mode de communication:</b> {{ $fournisseur->modCom }}
                </div>
            </div>
        </div>

       
      <div class="info-box contacts">
    <div class="info-title">Contacts:</div>
    <div class="info-content">
    @foreach($contacts as $contact)
        <div class="contact-item">
        <div>
            <b>Nom:</b> {{ $contact->prenom }} {{ $contact->nom }}
        </div>
        <div>
            <b>Fonction:</b> {{ $contact->fonction }}
        </div>
        <div >
            <b>Courriel:</b> {{ $contact->email }}
        </div>
        <div>
        @foreach($infotelsContacts as $infotelsContact)
        @if($contact->idContact == $infotelsContact->contact)
            <b>Téléphone:</b> {{ $infotelsContact->numTel }}
        @endif
            @endforeach
        </div>
        </div>
        @endforeach
    </div>
</div>

        <div class="info-box offre">
            <div class="info-title">Produits et services offerts:</div>
        
            <div class="info-content">
            @foreach($offres as $offre)
                <div class="offre-item">
                <div>
                <b>UNSPSC:</b> {{ $offre->codeUNSPSC }} 
                 
                </div>
                <div>
                <b>Nom:</b> {{ $offre->nom }}
                </div>
                </div>
                @endforeach
            </div>
       
        </div>


        <div class="info-box licence">
            <div class="info-title">Licence:</div>
            <div class="info-content">
                <div>
                    <b>Numéro de licence:</b> {{ $fournisseur->numliscence }}
                </div>
                <div>
                  @if($liscences->statut == "Valide")
                  <b>Statut de licence:</b>
                  <div>
                   {{ $liscences->statut }} <img src="../Images/checkVert.png" alt="accepter" id='imgStatut'>
                   </div>
                @else
                <b>Statut de licence:</b> 
                <div>
                {{ $liscences->statut }}<img src="Images/refuse.png" alt="refuse" id='imgStatut'>
                </div>
                @endif
                </div>
                <div>
                    <b>Type de licence:</b> {{ $liscences->type }}
                </div>
                <div class="liscences-container">
                @foreach($catLiscences as $catLiscence)
                <div class="liscence-item">
                <div>
                    <b>Numéro de catégorie:</b> {{ $catLiscence->numCategorie }}
                </div>
                <div>
                    <b>Nom de la catégorie:</b> {{ $catLiscence->nom }}
                </div>
                <div>
                    <b>Classe de la catégorie:</b> {{ $catLiscence->classe }}
                </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@else
    <p>Le fournisseur n'existe pas</p>
@endif

@endsection

