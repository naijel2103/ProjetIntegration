document.addEventListener('DOMContentLoaded', function() {

    function updateProgressBar(step) {
        const progressBar = document.getElementById('progress-bar');
        const progress = (step / 6) * 100; // Calcul du pourcentage en fonction de l'étape
        progressBar.style.width = `${progress}%`;
    }    

function addCheckmark(input, isValid, errorMessage, step) {
    const existingCheckmark = input.parentNode.querySelector('.check-icon');
    const img = existingCheckmark || document.createElement('img');
    img.src = isValid ? 'Images/checkVert.png' : 'Images/XIcon.png';
    img.alt = '';
    img.classList.add('icon', 'check-icon');
    img.style.marginLeft = '10px';

    if (!existingCheckmark) {
        input.parentNode.appendChild(img);
    } else {
        existingCheckmark.src = img.src;
    }
    
    input.style.borderColor = isValid ? 'green' : 'red';
    document.getElementById(`${input.id}-error`).style.display = isValid ? 'none' : 'block';
    if (errorMessage) {
        document.getElementById(`${input.id}-error`).innerText = errorMessage;
    }
}

function validateStep(inputs, validations, step) {
    let isValid = true;
    inputs.forEach(input => {
        const validation = validations[input.id];
        const errorMessage = validation(input.value);
        if (errorMessage) {
            addCheckmark(input, false, errorMessage, step);
            isValid = false;
        } else {
            addCheckmark(input, true, '', step);
        }
    });
    return isValid;
}
updateProgressBar(1);  // Étape 2

document.getElementById('neq').addEventListener('blur', function () {
    const neq = this.value.trim();
    if (!neq) return; // Ne rien faire si le champ est vide
    let neqData = {}
    const nameInput = document.getElementById('nom');

    fetch(`/api/data/${neq}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                alert("Aucun utilisateur trouvé pour ce NEQ.");
                return;
            }

            neqData = data.result.records[0];

            console.log(neqData["Autre nom"]);

            // Autofill du champ 'nom' avec la valeur renvoyée par le contrôleur
            nameInput.value = neqData["Autre nom"] || '';
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des données:', error);
        });
});




const formData = new FormData();



// Step 1 validation
// Step 1 validation
document.getElementById('btnNext').addEventListener('click', function () {
    const step1Inputs = ['neq', 'nom', 'email', 'password', 'password_confirmation'].map(id => document.getElementById(id));
    const validations = {
        neq: value => {
            if (value && value.length !== 10) {
                return "Le NEQ doit contenir 10 chiffres.";
            }
            if (value && !/^\d{10}$/.test(value)) {
                return "Le NEQ doit être composé uniquement de chiffres.";
            }
            return '';  // Si l'utilisateur ne met rien, la validation passe
        },
        nom: value => !value.trim() && "Le nom est requis.",
        email: value => !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value) && "L'email n'est pas valide.",
        password: value => value.length < 8 && "Le mot de passe doit contenir au moins 8 caractères.",
        password_confirmation: (value) => {
            if (!value) return "La confirmation du mot de passe est requise.";
            if (value !== document.getElementById('password').value) return "Les mots de passe ne correspondent pas.";
            return '';
        }
    };

    if (validateStep(step1Inputs, validations, 1)) {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
        updateProgressBar(2);  // Étape 2
    }
});


// Step 2 validation
document.getElementById('btnNextStep').addEventListener('click', function () {
    const step2Inputs = ['siteInternet', 'numero_civique', 'rue', 'bureau', 'ville', 'province', 'codePostal', 'num_telstep2'].map(id => document.getElementById(id));
    const validations = {
        siteInternet: value => !value && "Le site internet est requis.",
        numero_civique: value => !/^\d+$/.test(value) && "Le numéro civique doit être un nombre.",
        rue: value => !value.trim() && "La rue est requise.",
        bureau: value => !value.trim() && "Le bureau est requis.",
        ville: value => !value.trim() && "La ville est requise.",
        province: value => !value.trim() && "La province est requise.",
        codePostal: value => !/^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/.test(value) && "Le code postal doit être valide.",
        num_telstep2: value => {
            if (!value){
               return "Le numéro de téléphone est requis"; 
            } 

            if (value && value.length !== 10) {
                return "Le numéro de téléphone doit contenir 10 chiffres.";
            }
            if (value && !/^\d{10}$/.test(value)) {
                return "Le numéro de téléphone doit être composé uniquement de chiffres.";
            }
        }
    };

    console.log(num_telstep2)

    if (validateStep(step2Inputs, validations, 2)) {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
        updateProgressBar(3);  // Étape 2

    }
});

document.getElementById('btnNextStep2').addEventListener('click', function () { 
    const detailsTextarea = document.getElementById('detailsTextarea');
    const offerCheckboxes = document.querySelectorAll('input[name="offres[]"]:checked');
    
    const selectedOffers = Array.from(offerCheckboxes).map(checkbox => {
        const label = document.querySelector(`label[for="${checkbox.id}"]`);
        return {
            codeUNSPSC: checkbox.value,
            nomOffre: label ? label.textContent.trim() : ''
        };
    });

    const validations = {
        detailsTextarea: value => !value.trim() && "Le champ 'Détails et spécifications' est requis.",
        offres: value => value.length === 0 && "Veuillez sélectionner au moins une offre."
    };

    // Collect selected offers
    selectedOffers.forEach((offer, index) => {
        formData.append(`offres[${index}]`, `${offer.codeUNSPSC}`); // Add code and name of selected offer
    });

    // If everything is valid, move to Step 4
    const isValid = validateStep([detailsTextarea], validations, 3);
    
    if (isValid) {
        // Log selected offers (optional)
        console.log("Offres sélectionnées : ");
        selectedOffers.forEach(offer => {
            console.log(`Code UNSPSC: ${offer.codeUNSPSC}, Nom: ${offer.nomOffre}`);
        });

        console.log(detailsTextarea.value);

        document.getElementById('step3').style.display = 'none';
        document.getElementById('step4').style.display = 'block';
        updateProgressBar(4); // Move to the next step
    }
});



// Step 4 validation
document.getElementById('btnNextStep4').addEventListener('click', function () { 
    const step4Inputs = ['specificationsTextarea', 'rbqLicenseInput', 'licenseStatus', 'entrepreneurType'].map(id => document.getElementById(id));
    
    const categoryCheckboxes = document.querySelectorAll('input[name="categories[]"]:checked');
    const selectedCategories = Array.from(categoryCheckboxes).map(checkbox => {
        const label = document.querySelector(`label[for="${checkbox.id}"]`);
        return {
            numCategorie: checkbox.value,
            nomCategorie: label ? label.textContent.trim() : ''
        };
    });

    const validations = {
        specificationsTextarea: value => !value.trim() && "Le champ 'Détails et spécifications' est requis.",
        rbqLicenseInput: value => {
            if (!value.trim()) return "Veuillez entrer votre licence.";
            if (value.length !== 10 || !/^\d+$/.test(value)) return "La licence RBQ doit être composée de 10 chiffres.";
            return null;
        },        
        licenseStatus: value => !value.trim() && "Veuillez choisir le statut de la licence.",
        entrepreneurType: value => !value.trim() && "Veuillez choisir le type d'entrepreneur.",
        categories: value => value.length === 0 && "Veuillez sélectionner au moins une catégorie."
    };

    // Validation des champs avec messages d'erreur
    const validationsResult = {
        ...validations,
        categories: selectedCategories
    };

    selectedCategories.forEach((category, index) => {
        formData.append(`categories[${index}]`, `${category.numCategorie}`); // Ajout du numéro et du nom
    });

    // Si tout est valide, passer à l'étape suivante
    if (validateStep(step4Inputs, validationsResult, 4)) {
        // Afficher les catégories sélectionnées avec leur nom
        console.log("Catégories sélectionnées : ");
        selectedCategories.forEach(category => {
            console.log(`Numéro de catégorie: ${category.numCategorie}, Nom: ${category.nomCategorie}`);
        });

        console.log(specificationsTextarea.value, rbqLicenseInput.value, licenseStatus.value, entrepreneurType.value);

        document.getElementById('step4').style.display = 'none';
        document.getElementById('step5').style.display = 'block';
        updateProgressBar(5); // Étape suivante
    }
});




// Back buttons for navigating between steps
document.getElementById('btnRetour').addEventListener('click', () => {
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step1').style.display = 'block';
    updateProgressBar(1);  // Étape 1

});

document.getElementById('btnRetour2').addEventListener('click', () => {
    document.getElementById('step3').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
    updateProgressBar(2);  // Étape 2

});

document.getElementById('btnRetour3').addEventListener('click', () => {
    document.getElementById('step4').style.display = 'none';
    document.getElementById('step3').style.display = 'block';
    updateProgressBar(3);  // Étape 3

});

document.getElementById('btnRetour5').addEventListener('click', () => {
    document.getElementById('step5').style.display = 'none';
    document.getElementById('step4').style.display = 'block';
    updateProgressBar(4);  // Étape 4

});

// Final form validation
document.getElementById('account-form').addEventListener('submit', function (event) {
    const uniqueField = document.getElementById('uniqueField');
    if (!uniqueField.value.trim()) {
        event.preventDefault();
        document.getElementById('uniqueField-error').style.display = 'block';
    }
});


// Handle selected offers and specifications
document.getElementById('btnNextStep2').addEventListener('click', function () {
    const selectedOffers = Array.from(document.querySelectorAll('.offer-checkbox:checked')).map(checkbox => checkbox.value);
    const specifications = document.getElementById('specificationsInput').value;

    const offersDisplay = document.getElementById('offersDisplay');
    offersDisplay.innerHTML = selectedOffers.length ? selectedOffers.join('<br>') : 'Aucune offre sélectionnée.';
    
    const specificationsDisplay = document.getElementById('specificationsDisplay');
    specificationsDisplay.textContent = specifications || 'Aucune spécification.';
});


document.getElementById('submitStep5').addEventListener('click', function () {
    const step5Inputs = ['prenom-step5', 'nom-step5', 'fonction-step5', 'email_contact-step5'].map(id => document.getElementById(id));

    const validations = {
        'prenom-step5': value => !value.trim() && "Le prénom est requis.",
        'nom-step5': value => !value.trim() && "Le nom est requis.",
        'fonction-step5': value => !value.trim() && "La fonction est requise.",
        'email_contact-step5': value => {
            if (!value) return "L'email est requis.";
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) return "L'email n'est pas valide.";
            return '';
        }
        
    };



    if (validateStep(step5Inputs, validations, 5)) {
        // Collecte les données de toutes les étapes
    
        // Étape 1
        formData.append('neq', document.getElementById('neq').value);
        formData.append('nom', document.getElementById('nom').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('password', document.getElementById('password').value);
        formData.append('password_confirmation', document.getElementById('password_confirmation').value);
    
        // Étape 2
        formData.append('siteInternet', document.getElementById('siteInternet').value);
        formData.append('numero_civique', document.getElementById('numero_civique').value);
        formData.append('bureau', document.getElementById('bureau').value);
        formData.append('rue', document.getElementById('rue').value);
        formData.append('ville', document.getElementById('ville').value);
        formData.append('province', document.getElementById('province').value);
        formData.append('codePostal', document.getElementById('codePostal').value);
        formData.append('num_telstep2', document.getElementById('num_telstep2').value);

        // Étape 4
        formData.append('rbqLicenseInput', document.getElementById('rbqLicenseInput').value);
        formData.append('specificationsTextarea', document.getElementById('specificationsTextarea').value);
        formData.append('licenseStatus', document.getElementById('licenseStatus').value);
        formData.append('entrepreneurType', document.getElementById('entrepreneurType').value);

    
        // Étape 5
        formData.append('prenom-step5', document.getElementById('prenom-step5').value);
        formData.append('nom-step5', document.getElementById('nom-step5').value);
        formData.append('fonction-step5', document.getElementById('fonction-step5').value);
        formData.append('email_contact-step5', document.getElementById('email_contact-step5').value);
    
        // Création de l'objet JSON à envoyer
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });
    
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Envoi des données avec fetch (AJAX) en JSON
        fetch(routeCreateFournisseur, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(jsonData) // Sérialisation en JSON
        })
        .then(response => {
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Si tout s'est bien passé, passer à l'étape 6
                document.getElementById('step5').style.display = 'none';
                document.getElementById('step6').style.display = 'block';
                updateProgressBar(6);  // Étape 6
            } else {
                alert('Erreur lors de l\'enregistrement des données. Veuillez réessayer.');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue. Veuillez réessayer plus tard.');
        });
    }
    
});





function updateProgressBar(step) {
    const progressBar = document.getElementById('progress-bar');
    const progress = (step / 6) * 100; // Calcul du pourcentage en fonction de l'étape
    progressBar.style.width = `${progress}%`;
}
});
