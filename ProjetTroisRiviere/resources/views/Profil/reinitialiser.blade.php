@section('titre', 'reinitialiser')
@extends('layouts.app')
@section('contenu')

<form method="POST" action="{{ route('profil.reinitialiser', $code) }}">
    @csrf
    <div>
        <input type="hidden" name="code" value="{{ $code }}"> 
        <label for="password">Nouveau mot de passe<label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <label for="password_confirmation">Confirmation de mot de passe</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <div>
        <button type="submit">Reset Password</button>
        
    </div>
</form>




@endsection