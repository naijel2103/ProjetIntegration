

@extends('layouts.app')
@section('contenu')

<h1>Page du  fournisseur {{ $fournisseur->nomFournisseur }}</h1>
@if (isset($fournisseur))
  <li>{{ $fournisseur->nomFournisseur }}</li>
  <li>{{ $fournisseur->statut}}</li>
@else
  <p>Le  fournisseur n'existe pas</p>
@endif
@endsection
