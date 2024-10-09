

@extends('layouts.app')
@section('contenu')

<h1>Page du  fournisseur {{ $fournisseur->nomFournisseur }}</h1>
@if (isset($fournisseur))
  <li>{{ $fournisseur->nomFournisseur }}</li>
  <li>{{ $fournisseur->statut}}</li>

  <a href="{{ route('fiche.index') }}" class="btn btn-primary btn-lg" id="btnGererDemande">Retour</a>
  <a href="{{ route('fiche.gererDemande', [$fournisseur]) }}" class="btn btn-success btn-lg" id="btnGererDemande">Gérer la demande</a>


@else
  <p>Le  fournisseur n'existe pas</p>
@endif
@endsection
