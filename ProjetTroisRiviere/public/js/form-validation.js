function togglePasswordVisibility(inputId) {
    const inputField = document.getElementById(inputId);
    const inputType = inputField.type === 'password' ? 'text' : 'password';
    inputField.type = inputType;

    const eyeIcon = document.getElementById(`toggle-${inputId}`);
    eyeIcon.src = inputType === 'password' ? 'Images/eye.png' : 'Images/eye-open.png';
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

// Step 1 validation
document.getElementById('btnNext').addEventListener('click', function () {
    const step1Inputs = ['nom', 'email', 'password', 'password_confirmation'].map(id => document.getElementById(id));
    const validations = {
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
    }
});

// Step 2 validation
document.getElementById('btnNextStep').addEventListener('click', function () {
    const step2Inputs = ['siteInternet', 'numero_civique', 'rue', 'ville', 'province', 'code_postal', 'num_tel'].map(id => document.getElementById(id));
    const validations = {
        siteInternet: value => !value && "Le site internet est requis.",
        numero_civique: value => !/^\d+$/.test(value) && "Le numéro civique doit être un nombre.",
        rue: value => !value.trim() && "La rue est requise.",
        ville: value => !value.trim() && "La ville est requise.",
        province: value => !value.trim() && "La province est requise.",
        code_postal: value => !/^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/.test(value) && "Le code postal doit être valide.",
        num_tel: value => {
            if (!value) return "Le numéro de téléphone est requis.";
            if (!/^\d{3}-\d{3}-\d{4}$/.test(value)) return "Le numéro de téléphone doit être au format 000-000-0000.";
            return '';
        }
    };

    if (validateStep(step2Inputs, validations, 2)) {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
    }
});

// Step 3 validation
document.getElementById('btnNextStep2').addEventListener('click', function () {
    if (true) {
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step4').style.display = 'block';
    }
});

// Step 4 validation
document.getElementById('btnNextStep4').addEventListener('click', function () {
    if (true) {
        document.getElementById('step4').style.display = 'none';
        document.getElementById('step5').style.display = 'block';
    }
});

// Back buttons for navigating between steps
document.getElementById('btnRetour').addEventListener('click', () => {
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step1').style.display = 'block';
});

document.getElementById('btnRetour2').addEventListener('click', () => {
    document.getElementById('step3').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
});

document.getElementById('btnRetour3').addEventListener('click', () => {
    document.getElementById('step4').style.display = 'none';
    document.getElementById('step3').style.display = 'block';
});

document.getElementById('btnRetour5').addEventListener('click', () => {
    document.getElementById('step5').style.display = 'none';
    document.getElementById('step4').style.display = 'block';
});

// Final form validation
document.getElementById('account-form').addEventListener('submit', function (event) {
    const uniqueField = document.getElementById('uniqueField');
    if (!uniqueField.value.trim()) {
        event.preventDefault();
        document.getElementById('uniqueField-error').style.display = 'block';
    }
});

// Format telephone number
document.getElementById('num_tel').addEventListener('input', function () {
    let input = this;
    input.value = input.value.replace(/\D/g, '').slice(0, 10); // Keep only the first 10 digits
    if (input.value.length > 6) {
        input.value = input.value.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
    } else if (input.value.length > 3) {
        input.value = input.value.replace(/(\d{3})(\d{3})/, '$1-$2');
    }
});

// Format téléphone et limiter la saisie à 10 caractères dans Step 5
document.getElementById('tel_contact-step5').addEventListener('input', function () {
    let input = this;
    input.value = input.value.replace(/\D/g, '').slice(0, 10); // Garde uniquement les 10 premiers chiffres
    if (input.value.length > 6) {
        input.value = input.value.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3'); // Format : 000-000-0000
    } else if (input.value.length > 3) {
        input.value = input.value.replace(/(\d{3})(\d{3})/, '$1-$2'); // Format : 000-000
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
    const step5Inputs = ['prenom-step5', 'nom-step5', 'fonction-step5', 'email_contact-step5', 'num_tel_type-contact-step5', 'tel_contact-step5'].map(id => document.getElementById(id));
    const validations = {
        'prenom-step5': value => !value.trim() && "Le prénom est requis.",
        'nom-step5': value => !value.trim() && "Le nom est requis.",
        'fonction-step5': value => !value.trim() && "La fonction est requise.",
        'email_contact-step5': value => {
            if (!value) return "L'email est requis.";
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) return "L'email n'est pas valide.";
            return '';
        },
        'num_tel_type-contact-step5': value => !value.trim() && "Le type de téléphone est requis.",
        'tel_contact-step5': value => {
            if (!value) return "Le numéro de téléphone est requis.";
            if (!/^\d{3}-\d{3}-\d{4}$/.test(value)) return "Le numéro de téléphone doit être au format 000-000-0000.";
            return '';
        }
    };

    if (validateStep(step5Inputs, validations, 5)) {
        // Si les validations sont correctes, passer à Step 6
        document.getElementById('step5').style.display = 'none';
        document.getElementById('step6').style.display = 'block';
    }
});
