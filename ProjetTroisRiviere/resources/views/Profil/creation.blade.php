@section('titre', 'Création du compte')
@extends('layouts.app')
@section('contenu')
<div class="page-wrap">
    <div class="container">
        <div>
            <div class="formbold-main-wrapper">
                <form id="account-form" action="{{ route('profil.creer') }}" method="POST">
                    @csrf
                    <div id="step1" class="form-step">
                        <div class="col-10 offset-1">
                            <br>
                            <div class="form-group row mb-3 justify-content-end">
                                <label for="neq" class="col-sm-4 col-form-label text-end">Numéro d'entreprise du Québec (NEQ)</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="neq" id="neq" class="form-control" placeholder=" 8831854938" required>
                                        <img src="Images/checkRouge.png" alt="" class="icon" id="neq-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="neq-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="nom" class="col-sm-4 col-form-label text-end">Nom de l'entreprise (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="nom" id="nom" class="form-control" required>
                                        <img src="Images/checkRouge.png" alt="" class="icon" id="nom-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="nom-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="email" class="col-sm-4 col-form-label text-end">Adresse courriel (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="email" name="email" id="email" class="form-control" required>
                                        <img src="Images/checkRouge.png" alt="" class="icon" id="email-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="email-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="password" class="col-sm-4 col-form-label text-end">Mot de passe (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="password" name="password" id="password" class="form-control" required>
                                        <img src="Images/checkRouge.png" alt="" class="icon" id="password-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="password-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="password_confirmation" class="col-sm-4 col-form-label text-end">Confirmer le mot de passe (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                        <img src="Images/checkRouge.png" alt="" class="icon" id="password_confirmation-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="password_confirmation-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="button" id="btnNext" class="btn btn-primary btn-lg">Suivant</button>
                        </div>
                    </div>

                    <div id="step2" class="form-step" style="display: none;">
                        <div class="col-10 offset-1">
                            <label for="additional_info">Informations supplémentaires:</label>
                            <input type="text" name="additional_info" id="additional_info" class="form-control">
                        </div>
                        <div class="text-center">
                            <button type="submit" id="btnsubmit" class="btn btn-primary btn-lg">Créer</button>
                            <a href="{{ route('profil.connexionNEQ') }}" class="btn btn-danger btn-lg" id="btnRetour">Retour</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/form-validation.js') }}"></script>
@endsection
