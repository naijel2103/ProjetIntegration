@extends('layouts.app')
@section('titre', 'Création du compte')
@section('contenu')
<head>
    <link rel="stylesheet" style="text/css" href="\css\GabaritCss\GabaritCss.css">
</head>
<script src="{{ asset('js/filtre.js') }}"></script>

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
                                <label for="neq" class="col-sm-4 col-form-label text-end">NEQ (Facultatif)</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="neq" id="neq" class="form-control" placeholder=" 8831854938" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="neq-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="neq-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="nom" class="col-sm-4 col-form-label text-end">Nom de l'entreprise (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="nom" id="nom" class="form-control" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="nom-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="nom-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="email" class="col-sm-4 col-form-label text-end">Adresse courriel (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="email" name="email" id="email" class="form-control" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="email-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="email-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="password" class="col-sm-4 col-form-label text-end">Mot de passe (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="input-container">
                                        <input type="password" name="password" id="password" class="form-control" required>
                                        <img src="Images/eye.png" alt="Toggle Password" class="icon eye-icon" id="toggle-password" onclick="togglePasswordVisibility('password')" style="cursor: pointer;">
                                        <img src="Images/XIcon.png" alt="" class="icon" id="password-icon" style="display: none;">
                                    </div>
                                    <span class="error" id="password-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="password_confirmation" class="col-sm-4 col-form-label text-end">Confirmer le mot de passe (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="input-container">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                        <img src="Images/eye.png" alt="Toggle Password Confirmation" class="icon eye-icon" id="toggle-password-confirmation" onclick="togglePasswordVisibility('password_confirmation')" style="cursor: pointer;">
                                        <img src="Images/XIcon.png" alt="" class="icon" id="password_confirmation-icon" style="display: none;">
                                    </div>
                                    <span class="error" id="password_confirmation-error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('profil.connexionNEQ') }}" class="btn btn-danger btn-lg" >Retour</a>
                            <button type="button" id="btnNext" class="btn btn-primary btn-lg">Suivant</button>
                            <button type="button" id="btnSkipStep3" class="btn btn-secondary btn-lg">Passer à l'étape 3</button> <!-- New Button -->
                        </div>
                    </div>

                    <div id="step2" class="form-step" style="display: none;">
                        <div class="col-10 offset-1">
                            <br>
                            <div class="form-group row mb-3 justify-content-end">
                                <label for="siteInternet" class="col-sm-4 col-form-label text-end">Site Internet (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="siteInternet" id="siteInternet" class="form-control" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="siteInternet-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="siteInternet-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <!-- Address Inputs in Same Row -->
                            <div class="form-group row mb-3 justify-content-end">
                                <label for="num" class="col-sm-4 col-form-label text-end">Adresse:</label>
                                <div class="col-sm-2">
                                    <input type="text" name="numero_civique" id="numero_civique" class="form-control" placeholder="Numéro Civique (Obligatoire)" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="numero_civique-icon" style="display: none; margin-left: 10px; ">
                                    <span class="error" id="numero_civique-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="rue" id="rue" class="form-control form-control1" placeholder="Rue (Obligatoire)" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="rue-icon" style="display: none; margin-left: 10px;">
                                    <span class="error" id="rue-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="bureau" id="bureau" class="form-control" placeholder="Bureau (Facultatif)">
                                    <img src="Images/XIcon.png" alt="" class="icon" id="bureau-icon" style="display: none; margin-left: 0px;">
                                    <span class="error" id="bureau-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>


                            <!-- Other Inputs -->
                            <div class="form-group row mb-3 justify-content-end">
                                <label for="ville" class="col-sm-4 col-form-label text-end">Ville (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="ville" id="ville" class="form-control" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="ville-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="ville-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="province" class="col-sm-4 col-form-label text-end">Province (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="province" id="province" class="form-control" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="province-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="province-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="code_postal" class="col-sm-4 col-form-label text-end">Code Postal (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="code_postal" id="code_postal" class="form-control" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="code_postal-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="code_postal-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="num_tel_type" class="col-sm-4 col-form-label text-end">Téléphone (Obligatoire):</label>
                                <div class="col-sm-2">
                                    <input type="text" name="num_tel_type" id="num_tel_type" class="form-control" placeholder="(Bureau, Maison etc.)" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="num_tel_type-icon" style="display: none; margin-left: 10px;">
                                    <span class="error" id="num_tel_type-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="num_tel" id="num_tel" class="form-control form-control1" placeholder="Numéro de téléphone" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="num_tel-icon" style="display: none; margin-left: 10px;">
                                    <span class="error" id="num_tel-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="poste" id="poste" class="form-control" placeholder="Poste">
                                    <img src="Images/XIcon.png" alt="" class="icon" id="poste-icon" style="display: none; margin-left: 0px;">
                                    <span class="error" id="poste-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>


                        </div>

                        

                        <div class="text-center">
                            <button type="button" id="btnRetour" class="btn btn-danger btn-lg">Retour</button>
                            <button type="button" id="btnNextStep" class="btn btn-primary btn-lg">Suivant</button>
                        </div>
                    </div>
                    <div id="step3" class="form-step" style="display: none;">
                        <div class="col-10 offset-1">
                            <div class="text-center mb-4">
                                <h4>Services :</h4>
                            </div>

                            <div class="cols-4 grid-filtre d-flex flex-column align-items-center">  
                                <div class="rows-3 container-filtre w-100">
                                    <div class="recherche-filtre mb-3">
                                        <input placeholder="Recherche d'offre" class="searchBar-filtre form-control" />
                                    </div>
                                    
                                    <div class="liste-filtre w-100" style="max-height: 150px; margin-top: -25px;">
                                        @foreach ($listeOffres as $offre)
                                        <div class="uneOffre form-check">
                                            <input type="checkbox" class="form-check-input" name="offres[]" value="{{ $offre->codeUNSPSC }}" id="offre-{{ $offre->codeUNSPSC }}" @if(in_array($offre->codeUNSPSC, $offreSelect)) checked @endif>
                                            <label for="offre-{{ $offre->codeUNSPSC }}" class="form-check-label">
                                                {{ $offre->codeUNSPSC }}  ---  {{ $offre->nom }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"> <!-- Added margin-bottom for spacing -->
                                <label for="">détails</label>
                                    <textarea name="" id="" cols="133" rows="2" class="form-control w-100"></textarea>
                            </div>
                        </div> 
                        <div class="text-center mt-2 mb-3"> <!-- Added margin-top to button container -->
                            <button type="button" id="btnRetourStep2" class="btn btn-danger btn-lg">Retour</button>
                            <button type="submit" id="btnSubmit" class="btn btn-primary btn-lg">Soumettre</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/form-validation.js') }}"></script>
<script src="{{ asset('js/filtre.js') }}"></script>
@endsection
