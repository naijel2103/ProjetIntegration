@section('titre', 'Connexion')
@extends('layouts.app')
@section('contenu')
<section class="main-container">
<h1>Liste des fournisseur


<div class="row text-center">
    <div class="col-12 lien">
    <a href="" class="btn btn-primary text-center " >ajouter un nouveau fournisseur</a>
  </div>
</div>
 
  <thead>
    <tr>
      <th scope="col-1">Email</th>
      <th scope="col-1">Fournisseur</th>
      <th scope="col-1">Numero de téléphone</th>
      <th scope="col-1">Contact</th>
      <th scope="col-1">Contactés</th>
    </tr>
  </thead>


  <tbody>
  @if(count($fournisseurs))
  <?php $ctr = 0; ?>
      @foreach($fournisseurs as $fournisseur)
      <?php $ctr++;  ?>
    <tr>
      <th scope="row"></th>
      <td>{{ $fournisseur->etat }}</td>
      <td>{{ $fournisseur->nomFournisseur }}</td>
      <td>{{ $fournisseur->nomFournisseur }}</td>
      <td>{{ $fournisseur->nomFournisseur }}</td>
      <td>{{ $fournisseur->nomFournisseur }}</td>
      <td><a href="" class="btn btn-primary text-center ">Voir la fiche fournisseur</a></td>
      <td>
          <form >
            <input type="checkbox" id="selectionner" name="selectionner"+$ctr value="selectionner"+$ctr>
      </td>
    </tr>
        </form>
  </tbody>

  @endforeach
    @else
      <h2>Aucun fournisseur a affiché</h2>
    @endif
@endsection