@extends('layouts.app')
@section('titre', 'modification du compte')
@section('contenu')

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    var routeCreateFournisseur = "{{ route('createFournisseur') }}";
</script>

<head>
    <link rel="stylesheet" style="text/css" href="\css\GabaritCss\GabaritCss.css">
</head>
<script src="{{ asset('js/filtre.js') }}"></script>



<div class="text-center mb-3">
    <div id="progress-container" style="width: 100%; height: 5px; background-color: #ddd; margin-bottom: 20px;">
        <div id="progress-bar" style="height: 100%; width: 0%; background-color: #4CAF50;"></div>
    </div>

</div>

<div class="page-wrap">
    <div class="container">
        <div>
            <div class="formbold-main-wrapper">
                <form id="account-form" action="{{ route('fiche.update',[$fournisseur]) }}" method="POST">
                    @csrf
                    <div id="step1" class="form-step">
                        <div class="col-10 offset-1">
                            <br>
                            <div class="form-group row mb-3 justify-content-end">
                                <label for="neq" class="col-sm-4 col-form-label text-end">NEQ </label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="neq" id="neq" class="form-control" value="<?php echo $fournisseur->neq; ?>" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="neq-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="neq-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="nom" class="col-sm-4 col-form-label text-end">Nom de l'entreprise:</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="nom" id="nom" class="form-control"  value="<?php echo $fournisseur->nomFournisseur; ?>"required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="nom-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="nom-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="email" class="col-sm-4 col-form-label text-end">Adresse courriel:</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $fournisseur->email; ?>" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="email-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="email-error" style="color: red; display: none; font-size: 0.8rem;"></span>
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
                                <label for="siteInternet" class="col-sm-4 col-form-label text-end">Site Internet (Facultatif):</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="siteInternet" id="siteInternet" class="form-control" value="<?php echo $fournisseur->siteWeb; ?>" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="siteInternet-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="siteInternet-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="num" class="col-sm-4 col-form-label text-end">Adresse:</label>
                                <div class="col-sm-2">
                                    <input type="text" name="numero_civique" id="numero_civique" class="form-control" value="<?php echo $fournisseur->numCivique; ?>" placeholder="Numéro Civique" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="numero_civique-icon" style="display: none; margin-left: 10px; ">
                                    <span class="error" id="numero_civique-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="rue" id="rue" class="form-control" placeholder="Rue" value="<?php echo $fournisseur->rue; ?>" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="rue-icon" style="display: none; margin-left: 0px;">
                                    <span class="error" id="rue-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="bureau" id="bureau" class="form-control" placeholder="Bureau (Facultatif)" value="<?php echo $fournisseur->bureau; ?>">
                                    <img src="Images/XIcon.png" alt="" class="icon" id="bureau-icon" style="display: none; margin-left: 0px;">
                                    <span class="error" id="bureau-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>


                            <div class="form-group row mb-3 justify-content-end">
                                <label for="ville" class="col-sm-4 col-form-label text-end">Ville:</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="ville" id="ville" class="form-control" value="<?php echo $fournisseur->municipalite; ?>" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="ville-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="ville-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="province" class="col-sm-4 col-form-label text-end">Province:</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="province" id="province" class="form-control" value="<?php echo $fournisseur->province; ?>" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="province-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="province-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="codePostal" class="col-sm-4 col-form-label text-end">Code Postal:</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="codePostal" id="codePostal" class="form-control" value="<?php echo $fournisseur->codePostal; ?>" required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="code_postal-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="codePostal-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="num_tel_type" class="col-sm-4 col-form-label text-end">Téléphone:</label>
                                <div class="col-sm-2">
                                    <input type="text" name="num_tel_type" id="num_tel_type" class="form-control" placeholder="(Bureau, Maison etc.)" value="<?php echo $infotels->typeTel; ?>" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="num_tel_type-icon" style="display: none; margin-left: 10px;">
                                    <span class="error" id="num_tel_type-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="num_telstep2" id="num_telstep2" class="form-control" placeholder="Numéro de téléphone" value="<?php echo $infotels->numTel; ?>" required>
                                    <img src="Images/XIcon.png" alt="" class="icon" id="num_telstep2-icon" style="display: none; margin-left: 10px;">
                                    <span class="error" id="num_telstep2-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="poste" id="poste" class="form-control" placeholder="Poste" value="<?php echo $infotels->postTel; ?>">
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
                                        <input type="checkbox" name="offres[]" value="{{ $offre->codeUNSPSC }}" id="offre-{{ $offre->codeUNSPSC }}" 
                                            @if(in_array($offre->codeUNSPSC, $offreSelect)) checked @endif 
                                           >
                                  
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
                                <textarea id="detailsTextarea" class="form-control" rows="4" placeholder="Entrez les détails..."  value="<?php echo $offre->segmentNom; ?>"></textarea>
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

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-group w-50">
                                    <label for="rbqLicenseInput">Numéro de licence RBQ</label>
                                    <input 
                                        type="text" 
                                        id="rbqLicenseInput" 
                                        class="form-control" 
                                        placeholder="Entrez votre numéro de licence RBQ"
                                        value="<?php echo $liscences->numLiscence; ?>"
                                    />
                                    <span 
                                        id="rbqLicenseInput-error" 
                                        class="error-message" 
                                        style="display:none; color: red;"
                                    ></span>
                                </div>
                                <div class="form-group w-50 text-center">
                                    <label for="licenseStatus">Statut de la licence</label>
                                    @if($liscences->statut == "valide")
                                    <select id="licenseStatus" class="form-control" >
                                        <option value="">-- Sélectionnez un statut --</option>
                                        <option value="valide" selected>Valide</option>
                                        <option value="non-valide">Non valide</option>
                                        <option value="valide-restriction">Valide avec restriction</option>
                                    </select>
                                    @elseif($liscences->statut == "non-valide")
                                    <select id="licenseStatus" class="form-control" >
                                        <option value="">-- Sélectionnez un statut --</option>
                                        <option value="valide">Valide</option>
                                        <option value="non-valide" selected>Non valide</option>
                                        <option value="valide-restriction">Valide avec restriction</option>
                                    </select>
                                    @else
                                    <select id="licenseStatus" class="form-control" >
                                        <option value="">-- Sélectionnez un statut --</option>
                                        <option value="valide">Valide</option>
                                        <option value="non-valide">Non valide</option>
                                        <option value="valide-restriction" selected>Valide avec restriction</option>
                                    </select>
                                    @endif
                                    <span 
                                        id="licenseStatus-error" 
                                        class="error-message" 
                                        style="display:none; color: red;"
                                    ></span>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="entrepreneurType">Type d'entrepreneur</label>
                                @if($liscences->type == "general")
                                <select id="entrepreneurType" class="form-control">
                                    <option value="">-- Sélectionnez un type --</option>
                                    <option value="general" selected>Entrepreneur général</option>
                                    <option value="specialise">Entrepreneur spécialisé</option>
                                </select>
                                @else
                                <select id="entrepreneurType" class="form-control">
                                    <option value="">-- Sélectionnez un type --</option>
                                    <option value="general">Entrepreneur général</option>
                                    <option value="specialise" selected>Entrepreneur spécialisé</option>
                                </select>
                                @endif
                                <span 
                                        id="entrepreneurType-error" 
                                        class="error-message" 
                                        style="display:none; color: red;"
                                    ></span>
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
                                            <input 
                                                type="checkbox" 
                                                name="categories[]" 
                                                value="{{ $categorie->numCategorie }}" 
                                                id="categorie-{{ $categorie->numCategorie }}" 
                                                @if(in_array($categorie->numCategorie, $catSelect)) 
                                                    checked 
                                                @endif
                                            >
                                            <label 
                                                for="categorie-{{ $categorie->numCategorie }}" 
                                                class="form-check-label" 
                                                style="white-space: normal; overflow: hidden; text-overflow: ellipsis; flex-grow: 1;"
                                            >
                                                {{ $categorie->numCategorie }} {{ $categorie->nom }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <br><br>

                            <div class="w-100">
                                <div class="form-group">
                                    <label for="specificationsTextarea">Détails et spécifications</label>
                                    <textarea 
                                        id="specificationsTextarea" 
                                        class="form-control" 
                                        rows="4" 
                                        placeholder="Entrez les spécifications..."
                                    ></textarea>
                                    <span 
                                        id="specificationsTextarea-error" 
                                        class="error-message" 
                                        style="display:none; color: red;"
                                    ></span>
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

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="prenom" class="col-sm-4 col-form-label text-end">Prénom:</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="prenom" id="prenom-step5" class="form-control"value='<?php echo $contacts->prenom; ?>' required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="prenom-step5-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="prenom-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="nom" class="col-sm-4 col-form-label text-end">Nom:</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="nom" id="nom-step5" class="form-control"value='<?php echo $contacts->nom; ?>' required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="nom-step5-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="nom-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="fonction" class="col-sm-4 col-form-label text-end">Fonction:</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="fonction" id="fonction-step5" class="form-control" value='<?php echo $contacts->fonction; ?>' required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="fonction-step5-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="fonction-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3 justify-content-end">
                                <label for="email_contact" class="col-sm-4 col-form-label text-end">Courriel:</label>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center">
                                        <input type="email" name="email_contact" id="email_contact-step5" class="form-control" value='<?php echo $contacts->email; ?>' required>
                                        <img src="Images/XIcon.png" alt="" class="icon" id="email_contact-step5-icon" style="display: none; margin-left: 10px;">
                                    </div>
                                    <span class="error" id="email_contact-step5-error" style="color: red; display: none; font-size: 0.8rem;"></span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-2 mb-3">
                            <button type="button" id="btnRetour5" class="btn btn-danger btn-lg">Retour</button>
                            <button type="button" id="submitStep5" class="btn btn-primary btn-lg">Soumettre</button>
                        </div>
                    </div>

                    <div id="step6" style="display: none;">
                        <h3>Le formulaire a été envoyé avec succès !</h3>
                        <p>Nous avons bien reçu vos informations.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('js/validation-mod.js') }}"></script>
<script src="{{ asset('js/rechercheOffre.js') }}"></script>
@endsection
