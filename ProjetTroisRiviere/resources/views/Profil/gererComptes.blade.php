
@section('titre', 'Liste des comptes')
@extends('layouts.app')
@section('contenu')
<section class="main-container">
<h1>Liste des comptes </h1>


<div class="row text-center">
    <div class="col-12 ">
    <a href="/creationCompte" class="btn btn-primary text-center " >ajouter un nouveau compte</a>
  </div>
</div>
 
  <table class="table text-center">
  <thead>
    <tr>
      <th scope="col-1">Email</th>
      <th scope="col-1">role</th>
      <th scope="col-1">Modification</th>
      <th scope="col-1">Supprimer</th>
    </tr>
  </thead>


 

  <tbody>
  @if(count($comptes))
  <?php $ctr = 0; ?>
      @foreach($comptes as $compte)
      <?php $ctr++;  ?>
    <tr>

      <td>{{$compte->email}}</td>
      <td>{{$compte->role}}</td>
      <td><a href="{{route('profil.edit', [$compte->id])}}" class="btn btn-primary text-center ">Modifier le compte</a></td>
      <td>
            <form method="POST" action="{{route('profil.destroy', [$compte->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger text-center ">Supprimer le compte</button>
            </form>
        </td>
    </tr>
  </tbody>

  @endforeach
    @else
      <h2>Aucun comptes a affiché</h2>
    @endif

</table>















@endsection
