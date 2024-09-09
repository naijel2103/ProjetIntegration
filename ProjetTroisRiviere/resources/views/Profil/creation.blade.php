<link rel="stylesheet" href="{{ asset ('css/ProfilCss/creation.css') }}">
@section('titre', 'Création du compte')
@extends('layouts.app')
@section('contenu')
<div class="page-wrap">
    <div class="container">
        <div>
            <div class="formbold-main-wrapper">
                <form action="{{ route('profil.creer') }}" method="POST">
                    @csrf
                    <div class=" col-10 offset-1">
                        <br>
                        <label for="neq">Numéro d'entreprise du Québec(NEQ)</label>
                        <input type="text" name="neq" id="neq" class="form-control" placeholder=" 8831854938">

                        <label for="nom">Nom de l'entreprise:</label>
                        <input type="text" name="nom" id="nom"class="form-control" required>

                        <label for="email">Adresse courriel</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        
                        <label for="password">Mot de passe:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        
                        <label for="password">Confirmer le mot de passe:</label>
                        <input type="password" name="password_confirmation"id="password_confirmation" class="form-control" required>
                        
                      
            
                        </br>
                        <div class="text-center">
                            <button type="submit" id="btnsubmit" class="btn btn-primary btn-lg">Créer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection