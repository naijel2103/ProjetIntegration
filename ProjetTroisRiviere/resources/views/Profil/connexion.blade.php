
@section('titre', 'Connexion')
@extends('layouts.app')
@section('contenu')
<div class="page-wrap">
    <br>
    <br>
    <div class="container">
        <div class="row ">
            <div class="col-10 offset-1">
                <br>
                <br>
                <div class="formbold-main-wrapper">
                    <form action="\" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe:</label>
                            <input type="password" name="password" id="password" class="form-control" value="" required>
                        </div>
                        <br>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" id="btncon">Connexion</button>
                        </div>
                        <div class="form-group text-center">
                            <p class="small fw-light">_________________________
                                <br>
                                Première visite?
                                <br>
                                <a href="{{ route('profil.creation') }}" class="btn btn-success" id="btnCreer">Créer un compte</a>
                            </p>
                        </div>
                    </form>
                </div>
                {{-- class="btn btn-warning" --}}
            </div>
        </div>
    </div>
</div>
@endsection