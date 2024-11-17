@extends('layouts.app')
@section('titre', 'Création du compte')
@section('contenu')
<head>
    <link rel="stylesheet" style="text/css" href="\css\GabaritCss\GabaritCss.css">
</head>
<script src="{{ asset('js/filtre.js') }}"></script>



<div class="text-center mb-3">
    <!-- Barre de progression placée juste au-dessus du bouton -->
    <div id="progress-container" style="width: 100%; height: 5px; background-color: #ddd; margin-bottom: 20px;">
        <div id="progress-bar" style="height: 100%; width: 0%; background-color: #4CAF50;"></div>
    </div>

    <button type="button" id="btnDirectStep3" class="btn btn-warning btn-lg">Aller à l'étape 3</button>
</div>

<script>
    document.getElementById('btnDirectStep3').addEventListener('click', function() {
        // Cacher les autres étapes
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step4').style.display = 'none';
        
        // Afficher l'étape 3
        document.getElementById('step3').style.display = 'block';
    });
</script>

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
                                    <input type="text" name="rue" id="rue" class="form-control" placeholder="Rue (Obligatoire)" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="rue-icon" style="display: none; margin-left: 0px;">
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
                                    <input type="text" name="num_tel" id="num_tel" class="form-control" placeholder="Numéro de téléphone" required>
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
                                    <br>
                                    <div class="liste-filtre w-100" style="max-height: 150px; overflow-y: auto; margin-top: -25px;">
                                        @foreach ($listeOffres as $offre)
                                        <div class="uneOffre form-check">
                                            <input type="checkbox" name="offres[]" value="{{ $offre->codeUNSPSC }}" id="offre-{{ $offre->codeUNSPSC }}" @if(in_array($offre->codeUNSPSC, $offreSelect)) checked @endif>
                                            <label for="offre-{{ $offre->codeUNSPSC }}" class="form-check-label">
                                                {{ $offre->codeUNSPSC }} --- {{ $offre->nom }}
                                            </label>
                                        </div>
                                        @endforeach
                                        <div id="offers-error" class="error" style="display:none;color:red;"></div>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="w-100">
                            <div class="form-group">
                                <label for="detailsTextarea">Détails et spécifications</label>
                                <textarea id="detailsTextarea" class="form-control" rows="4" placeholder="Entrez les détails..."></textarea>
                                <span id="detailsTextarea-error" class="error-message" style="display:none; color: red;"></span>
                            </div>
                            </div>
                        </div>
                        <div class="text-center mt-2 mb-3">
                            <button type="button" id="btnRetour2" class="btn btn-danger btn-lg">Retour</button>
                            <button type="button" id="btnNextStep2" class="btn btn-primary btn-lg">Suivant</button>
                        </div>
                    </div>


                    
                    <div id="step4" class="form-step" style="display: none;">
                        <div class="col-10 offset-1">
                            <div class="text-center mb-4">
                                <h4>Catégories de licence</h4>
                            </div>

                            <div class="cols-4 grid-filtre d-flex flex-column align-items-center">
                                <div class="rows-3 container-filtre w-100">
                                    <div class="recherche-filtre mb-3">
                                        <input placeholder="Catégorie" class="searchBar-filtre form-control" />
                                    </div>
                                    <br>
                                    <div class="liste-filtre w-100" style="max-height: 150px; overflow-y: auto; margin-top: -25px;">
                                        @foreach ($listeCategories as $categorie)
                                        <div class="uneCategorie form-check" style="margin-bottom: 150px; display: flex; align-items: center;">
                                            <input type="checkbox" name="categories[]" value="{{ $categorie->numCategorie }}" id="categorie-{{ $categorie->numCategorie }}" @if(in_array($categorie->numCategorie, $catSelect)) checked @endif>
                                            <label for="categorie-{{ $categorie->numCategorie }}" class="form-check-label" style="white-space: normal; overflow: hidden; text-overflow: ellipsis; flex-grow: 1;">
                                                {{ $categorie->numCategorie }} {{ $categorie->nom }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div>
                            <br>
                            <br>
                            <div class="w-100">
                            <div class="form-group">
                                <label for="specificationsTextarea">Détails et spécifications</label>
                                <textarea id="specificationsTextarea" class="form-control" rows="4" placeholder="Entrez les spécifications..."></textarea>
                                <span id="specificationsTextarea-error" class="error-message" style="display:none; color: red;"></span>
                            </div>

                            </div>
                        </div>
                        <div class="text-center mt-2 mb-3">
                            <button type="button" id="btnRetour3" class="btn btn-danger btn-lg">Retour</button>
                            <button type="button" id="btnNextStep4" class="btn btn-primary btn-lg">Suivant</button>
                        </div>
                    </div>

                    <div id="step5" class="form-step" style="display: none;">
                        <div class="col-10 offset-1">
                            <br>
                            <h4 class="text-center mb-4">Personne ressource</h4>

                            <!-- Prénom -->
                            <div class="form-group row mb-3 justify-content-end">
                                <label for="prenom" class="col-sm-4 col-form-label text-end">Prénom (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="prenom" id="prenom-step5" class="form-control" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="prenom-step5-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="prenom-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <!-- Nom -->
                            <div class="form-group row mb-3 justify-content-end">
                                <label for="nom" class="col-sm-4 col-form-label text-end">Nom (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="nom" id="nom-step5" class="form-control" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="nom-step5-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="nom-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <!-- Fonction -->
                            <div class="form-group row mb-3 justify-content-end">
                                <label for="fonction" class="col-sm-4 col-form-label text-end">Fonction (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="fonction" id="fonction-step5" class="form-control" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="fonction-step5-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="fonction-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row mb-3 justify-content-end">
                                <label for="email_contact" class="col-sm-4 col-form-label text-end">Courriel (Obligatoire):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="email" name="email_contact" id="email_contact-step5" class="form-control" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="email_contact-step5-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="email_contact-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <!-- Téléphone -->
                            <div class="form-group row mb-3 justify-content-end">
                                <label for="tel_contact" class="col-sm-4 col-form-label text-end">Téléphone (Obligatoire):</label>
                                <div class="col-sm-2">
                                    <input type="text" name="num_tel_type_contact" id="num_tel_type-contact-step5" class="form-control" placeholder="(Bureau, Maison etc.)" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="num_tel_type-contact-step5-icon" style="display: none; margin-left: 10px;">
                                    <span class="error" id="num_tel_type-contact-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="tel_contact" id="tel_contact-step5" class="form-control" placeholder="Numéro de téléphone" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="tel_contact-step5-icon" style="display: none; margin-left: 10px;">
                                    <span class="error" id="tel_contact-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="poste" id="poste-step5" class="form-control" placeholder="Poste">
                                    <img src="Images/XIcon.png" alt="" class="icon" id="poste-step5-icon" style="display: none; margin-left: 0px;">
                                    <span class="error" id="poste-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-2 mb-3">
                            <button type="button" id="btnRetour5" class="btn btn-danger btn-lg">Retour</button>
                            <button type="button" id="submitStep5" class="btn btn-primary btn-lg">Soumettre</button>
                        </div>
                    </div>

                    <!-- Step 6 (initialement masqué) -->
                    <div id="step6" style="display: none;">
                        <h3>Le formulaire a été envoyé avec succès !</h3>
                        <p>Nous avons bien reçu vos informations.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/form-validation.js') }}"></script>
<script src="{{ asset('js/rechercheOffre.js') }}"></script>
@endsection
