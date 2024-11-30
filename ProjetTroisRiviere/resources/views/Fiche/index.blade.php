<link rel="stylesheet" style="text/css" href="\css\GabaritCss\ficheCss.css">
<script src="{{ asset('js/filtre-demande.js') }}"></script>
@section('titre', 'Connexion')
@extends('layouts.app')
@section('contenu')
<section class="main-container">

  <div class="top-box">
    <h1>Liste des demandes</h1>

    <div class="cols-3 filtre-bar">
      <div class="cols-4 status-bar" id="status-bar">
      <label>Afficher les statuts:</label>
        <div class="unStatus">
          <input type="checkbox" name="status" value="attente" checked></input>
          <th>En attentes</th>
        </div>
        <div class="unStatus">
          <input type="checkbox" name="status" value="refusees" checked></input>
          <th>Refusées</th>
        </div>
        <div class="unStatus">
          <input type="checkbox" name="status" value="desactivee" checked></input>
          <th>Désactivées</th>
        </div>
      </div>

      <div>
        <label for="triOption">Trier par:</label>
        <select  name="optionTri" id="optionTri">
          <option value="dateDemande">Date de la demande</option>
          <option value="dateModification">Date de la dernière modification</option>
          <option value="dateChangementStatut">Date du changement de statut</option>
        </select>
      </div>
    </div>
  </div>

  <div class="content-box">
    <table class="table text-center" style="margin-bottom: 0px;">
    <thead>
      <tr>

      <th scope="col-1">Statut</th>
        <th scope="col-1">Fournisseur</th>
        <th scope="col-1">Date de la demande</th>
        <th scope="col-1">Date de la dernière modifification</th>
        <th scope="col-1">Date du changement de statut</th>
        <th scope="col-1">Fiche fournisseur</th>
      </tr>
    </thead>

    <tbody>
    @if(count($fournisseurs))
      <?php $ctr = 0; ?>
      @foreach($fournisseurs as $fournisseur)
        @if($fournisseur->statut != "Acceptee")
          <?php $ctr++;  ?>
          <tr class="uneDemande">
            <td>
              @if($fournisseur->statut == "En attente")
              <img src="Images/enAttente.png" alt="enAttente" id='imgStatut'>
              <p>En attente</p>
              @elseif($fournisseur->statut == "Desactivee")
              <img src="Images/desactivee.png" alt="desactivee" id='imgStatut'>
              <p>Désactivée</p>
              @elseif($fournisseur->statut == "Refusee")
              <img src="Images/refuse.png" alt="refusee" id='imgStatut'>
              <p>Refusée</p>
              @endif
            </td>

            <td>{{ $fournisseur->nomFournisseur }}</td>
            <td>{{  $fournisseur->demandeInscription ? $fournisseur->demandeInscription->dateDemande : 'Aucune demande' }}</td>
            <td>{{ $fournisseur->demandeInscription ? $fournisseur->demandeInscription->dateDerniereMod: 'Aucune demande' }}</td>
            <td>{{ $fournisseur->demandeInscription ? $fournisseur->demandeInscription->dateChangementStatut: 'Aucune demande' }}</td>
            <td><a href="{{ route('fiche.show', [$fournisseur]) }}"><button type="submit" id="boutonFiche">Ouvrir</button></a></td>
            <td>
            <form >
          </tr>
        @endif
        @endforeach
        </tbody>
    @else
      <h2>Aucun comptes a affiché</h2>
    @endif
 
    </table>
    </form>
  </div>
@endsection