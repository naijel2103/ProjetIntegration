<link rel="stylesheet" style="text/css" href="\css\GabaritCss\ficheCss.css">
@section('titre', 'Connexion')
@extends('layouts.app')
@section('contenu')
<section class="main-container">
<h1>Liste des fournisseurs</h1>


  <table class="table text-center">
  <thead>
    <tr>
    <th scope="col-1">Statut</th>
      <th scope="col-1">Fournisseur</th>
      <th scope="col-1">Ville</th>
      <th scope="col-1">Produits et services</th>
      <th scope="col-1">Catégorie de travaux</th>
      <th scope="col-1">Fiche fournisseur</th>
      <th scope="col-1">Sélectionner</th>
    </tr>
  </thead>


 

  <tbody>
  @if(count($fournisseurs))
  <?php $ctr = 0; ?>
      @foreach($fournisseurs as $fournisseur)
      <?php $ctr++;  ?>
    <tr>
      <td>
        @if($fournisseur->statut == "En attente")
        <img src="Images/enAttente.png" alt="enAttente" id='imgStatut'>
        @elseif($fournisseur->statut == "Accepter")
        <img src="Images/accepter.png" alt="accepter" id='imgStatut'>
        @else
        <img src="Images/refuse.png" alt="refuse" id='imgStatut'>
        @endif
      </td>
      <td>{{ $fournisseur->nomFournisseur }}</td>
      <td>{{ $fournisseur->adresse }}</td>
      <td>{{ $fournisseur->nomFournisseur }}</td>
      <td>{{ $fournisseur->nomFournisseur }}</td>
      <td><a href="{{ route('fiche.show', [$fournisseur]) }}"><button type="submit" id="boutonFiche">Ouvrir</button></a></td>
      <td>
      <form >
            <input type="checkbox" id="selectionner" name="selectionner"+$ctr value="selectionner"+$ctr>
          
      </td>
   
      </td>
    </tr>
  </tbody>

  @endforeach
    @else
      <h2>Aucun comptes a affiché</h2>
    @endif
 
</table>
<a href="" class="btn btn-primary text-center ">Liste des fournisseurs sélectionnés</a>
    </form>
@endsection