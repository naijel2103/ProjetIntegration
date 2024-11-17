<link rel="stylesheet" style="text/css" href="\css\GabaritCss\ficheCss.css">

@section('titre', 'Connexion')
@extends('layouts.app')
@section('contenu')

@if(session('error'))
    <div class="alert alert-danger errorMessage">
        {{ session('error') }}
    </div>
@endif


<form action="{{ route('askCodeListe') }}" method="GET">
    @csrf
    <div class="askBar">
        <p class="codeTitle">Entrez le code de la liste</p>
        <input type="text" id="codeListe" name="codeListe" required>
        <button type="submit" class="askBtn">Ouvrir</button>
    </div>
</form>

@endsection