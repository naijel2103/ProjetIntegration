

function togglePasswordVisibility(inputId) {
    const inputField = document.getElementById(inputId);
    const inputType = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
    inputField.setAttribute('type', inputType);

    const eyeIcon = document.getElementById(`toggle-${inputId}`);
    eyeIcon.src = inputType === 'password' ? 'Images/eye.png' : 'Images/eye-open.png'; // Replace with appropriate icon paths
}

// Validation for step1
document.getElementById('btnNext').addEventListener('click', function () {
    const errorMessages = document.querySelectorAll('.error');
    errorMessages.forEach(error => error.style.display = 'none');

    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.style.borderColor = ''; // Reset border color
        const existingCheckmark = input.parentNode.querySelector('.check-icon');
        if (existingCheckmark) {
            existingCheckmark.remove();
        }
    });

    const neq = document.getElementById('neq').value;
    const nom = document.getElementById('nom').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;

    let isValid = true;

    function addCheckmark(input, isValid) {
        const existingCheckmark = input.parentNode.querySelector('.check-icon');

        if (!existingCheckmark) {
            const img = document.createElement('img');
            img.src = isValid ? 'Images/checkVert.png' : 'Images/XIcon.png';
            img.alt = '';
            img.classList.add('icon', 'check-icon');
            img.style.marginLeft = '10px';
            input.parentNode.appendChild(img);
        } else {
            existingCheckmark.src = isValid ? 'Images/checkVert.png' : 'Images/XIcon.png';
        }
    }

    // Validation for nom
    if (!nom) {
        document.getElementById('nom-error').textContent = 'Nom de l\'entreprise est requis.';
        document.getElementById('nom-error').style.display = 'block';
        document.getElementById('nom').style.borderColor = 'red';
        isValid = false;
        addCheckmark(document.getElementById('nom'), false);
    } else {
        document.getElementById('nom').style.borderColor = 'green';
        addCheckmark(document.getElementById('nom'), true);
    }

    // Validation for email
    if (!email) {
        document.getElementById('email-error').textContent = 'Adresse courriel est requise.';
        document.getElementById('email-error').style.display = 'block';
        document.getElementById('email').style.borderColor = 'red';
        isValid = false;
        addCheckmark(document.getElementById('email'), false);
    } else {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            document.getElementById('email-error').textContent = 'Adresse courriel invalide.';
            document.getElementById('email-error').style.display = 'block';
            document.getElementById('email').style.borderColor = 'red';
            isValid = false;
            addCheckmark(document.getElementById('email'), false);
        } else {
            document.getElementById('email').style.borderColor = 'green';
            addCheckmark(document.getElementById('email'), true);
        }
    }

    // Validation for password
    if (!password) {
        document.getElementById('password-error').textContent = 'Mot de passe est requis.';
        document.getElementById('password-error').style.display = 'block';
        document.getElementById('password').style.borderColor = 'red';
        isValid = false;
        addCheckmark(document.getElementById('password'), false);
    } else if (password.length < 8) {
        document.getElementById('password-error').textContent = 'Le mot de passe doit contenir au moins 8 caractères.';
        document.getElementById('password-error').style.display = 'block';
        document.getElementById('password').style.borderColor = 'red';
        isValid = false;
        addCheckmark(document.getElementById('password'), false);
    } else {
        document.getElementById('password').style.borderColor = 'green';
        addCheckmark(document.getElementById('password'), true);
    }

    // Validation for password confirmation
    if (passwordConfirmation !== password || !passwordConfirmation) {
        document.getElementById('password_confirmation-error').textContent = 'Les mots de passe ne correspondent pas.';
        document.getElementById('password_confirmation-error').style.display = 'block';
        document.getElementById('password_confirmation').style.borderColor = 'red';
        isValid = false;
        addCheckmark(document.getElementById('password_confirmation'), false);
    } else {
        document.getElementById('password_confirmation').style.borderColor = 'green';
        addCheckmark(document.getElementById('password_confirmation'), true);
    }

    // If all validations pass, go to step2
    if (isValid) {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
    }
});

// Function to format telephone number and automatically add hyphens
function formatTelephoneNumber(input) {
    let digits = input.value.replace(/\D/g, ''); // Remove non-digit characters

    // Format to "000-000-0000"
    if (digits.length > 10) {
        digits = digits.slice(0, 10); // Limit to 10 digits
    }

    let formattedNumber = '';
    if (digits.length > 0) {
        formattedNumber += digits.slice(0, 3); // First 3 digits
    }
    if (digits.length > 3) {
        formattedNumber += '-' + digits.slice(3, 6); // Next 3 digits
    }
    if (digits.length > 6) {
        formattedNumber += '-' + digits.slice(6); // Remaining digits
    }

    input.value = formattedNumber; // Update the input value
}

// Event listener for telephone number input
const numTelInput = document.getElementById('num_tel');
numTelInput.addEventListener('input', function () {
    formatTelephoneNumber(numTelInput);
});

// Validation for step 2
document.getElementById('btnNextStep').addEventListener('click', function () {
    const errorMessages = document.querySelectorAll('.error');
    errorMessages.forEach(error => error.style.display = 'none');

    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.style.borderColor = ''; // Reset border color
        const existingCheckmark = input.parentNode.querySelector('.check-icon');
        if (existingCheckmark) {
            existingCheckmark.remove(); // Remove checkmark icon
        }
    });

    const siteInternet = document.getElementById('siteInternet').value;
    const numeroCivique = document.getElementById('numero_civique').value;
    const rue = document.getElementById('rue').value;
    const bureau = document.getElementById('bureau').value;
    const ville = document.getElementById('ville').value;
    const province = document.getElementById('province').value;
    const codePostal = document.getElementById('code_postal').value;
    const numTelType = document.getElementById('num_tel_type').value;
    const numTel = document.getElementById('num_tel').value;
    const poste = document.getElementById('poste').value;

    let isValidStep2 = true;

    function addCheckmarkStep2(input, isValid) {
        const existingCheckmark = input.parentNode.querySelector('.check-icon');
        if (!existingCheckmark) {
            const img = document.createElement('img');
            img.src = isValid ? 'Images/checkVert.png' : 'Images/XIcon.png';
            img.alt = '';
            img.classList.add('icon', 'check-icon');
            img.style.marginLeft = '10px';
            input.parentNode.appendChild(img);
        } else {
            existingCheckmark.src = isValid ? 'Images/checkVert.png' : 'Images/XIcon.png';
        }
    }

    // Validation for site internet
    if (!siteInternet) {
        document.getElementById('siteInternet-error').textContent = 'Site internet est requis.';
        document.getElementById('siteInternet-error').style.display = 'block';
        document.getElementById('siteInternet').style.borderColor = 'red';
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('siteInternet'), false);
    } else {
        document.getElementById('siteInternet').style.borderColor = 'green';
        addCheckmarkStep2(document.getElementById('siteInternet'), true);
    }

    // Validation for numéro civique (only numbers)
    if (!numeroCivique || !/^\d+$/.test(numeroCivique)) {
        document.getElementById('numero_civique-error').textContent = 'Numéro civique doit contenir uniquement des chiffres.';
        document.getElementById('numero_civique-error').style.display = 'block';
        document.getElementById('numero_civique').style.borderColor = 'red';
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('numero_civique'), false);
    } else {
        document.getElementById('numero_civique').style.borderColor = 'green';
        addCheckmarkStep2(document.getElementById('numero_civique'), true);
    }

    // Validation for rue
    if (!rue) {
        document.getElementById('rue-error').textContent = 'Rue est requise.';
        document.getElementById('rue-error').style.display = 'block';
        document.getElementById('rue').style.borderColor = 'red';
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('rue'), false);
    } else {
        document.getElementById('rue').style.borderColor = 'green';
        addCheckmarkStep2(document.getElementById('rue'), true);
    }

    // Validation for bureau
    if (bureau) {
        document.getElementById('bureau').style.borderColor = 'green';
        addCheckmarkStep2(document.getElementById('bureau'), true);
    }

    // Validation for ville
    if (!ville) {
        document.getElementById('ville-error').textContent = 'Ville est requise.';
        document.getElementById('ville-error').style.display = 'block';
        document.getElementById('ville').style.borderColor = 'red';
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('ville'), false);
    } else {
        document.getElementById('ville').style.borderColor = 'green';
        addCheckmarkStep2(document.getElementById('ville'), true);
    }

    // Validation for province
    if (!province) {
        document.getElementById('province-error').textContent = 'Province est requise.';
        document.getElementById('province-error').style.display = 'block';
        document.getElementById('province').style.borderColor = 'red';
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('province'), false);
    } else {
        document.getElementById('province').style.borderColor = 'green';
        addCheckmarkStep2(document.getElementById('province'), true);
    }

    // Validation for code postal
    if (!codePostal) {
        document.getElementById('code_postal-error').textContent = 'Code postal est requis.';
        document.getElementById('code_postal-error').style.display = 'block';
        document.getElementById('code_postal').style.borderColor = 'red';
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('code_postal'), false);
    } else {
        const postalPattern = /^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/; // Canada postal code pattern
        if (!postalPattern.test(codePostal)) {
            document.getElementById('code_postal-error').textContent = 'Code postal invalide.';
            document.getElementById('code_postal-error').style.display = 'block';
            document.getElementById('code_postal').style.borderColor = 'red';
            isValidStep2 = false;
            addCheckmarkStep2(document.getElementById('code_postal'), false);
        } else {
            document.getElementById('code_postal').style.borderColor = 'green';
            addCheckmarkStep2(document.getElementById('code_postal'), true);
        }
    }

    // Validation for num_tel
    if (!numTel) {
        document.getElementById('num_tel-error').textContent = 'Numéro de téléphone est requis.';
        document.getElementById('num_tel-error').style.display = 'block';
        document.getElementById('num_tel').style.borderColor = 'red';
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('num_tel'), false);
    } else {
        document.getElementById('num_tel').style.borderColor = 'green';
        addCheckmarkStep2(document.getElementById('num_tel'), true);
    }

    document.getElementById('btnRetour').addEventListener('click', function() {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step1').style.display = 'block';
    });

    // If all validations pass, go to step3
    if (isValidStep2) {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
    }


    
});

document.getElementById('btnNextStep2').addEventListener('click', function() {
    // Validation for step 3 (add your validation logic here if needed)
    const isValid = true; // Placeholder for validation logic

    if (isValid) {
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step4').style.display = 'block';
    } else {
        // Handle invalid case (show error messages, etc.)
    }
});

document.getElementById('btnNextStep4').addEventListener('click', function() {
    // Validation for step 3 (add your validation logic here if needed)
    const isValid = true; // Placeholder for validation logic

    if (isValid) {
        document.getElementById('step4').style.display = 'none';
        document.getElementById('step5').style.display = 'block';
    } else {
        // Handle invalid case (show error messages, etc.)
    }
});

document.getElementById('btnRetour2').addEventListener('click', function() {
    document.getElementById('step3').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
});

document.getElementById('btnRetour3').addEventListener('click', function() {
    document.getElementById('step4').style.display = 'none';
    document.getElementById('step3').style.display = 'block';
});

document.getElementById('btnRetour5').addEventListener('click', function() {
    document.getElementById('step5').style.display = 'none';
    document.getElementById('step4').style.display = 'block';
});



// Optionally add validation for Step 4 before submitting the form
document.getElementById('account-form').addEventListener('submit', function(event) {
    const uniqueField = document.getElementById('uniqueField');
    const uniqueFieldError = document.getElementById('uniqueField-error');

    if (uniqueField.value.trim() === '') {
        uniqueFieldError.textContent = 'Ce champ est requis.';
        uniqueFieldError.style.display = 'block';
        event.preventDefault(); // Prevent form submission
    } else {
        uniqueFieldError.style.display = 'none'; // Hide error if valid
    }
});

document.getElementById('btnNextStep2').addEventListener('click', function() {
    // Récupérer les offres sélectionnées
    const selectedOffers = [];
    const offerCheckboxes = document.querySelectorAll('.offer-checkbox:checked'); // Assurez-vous que vos cases à cocher ont la classe 'offer-checkbox'
    
    offerCheckboxes.forEach(checkbox => {
        selectedOffers.push(checkbox.value); // Valeur de l'offre sélectionnée
    });

    // Récupérer les détails et spécifications de l'utilisateur
    const specifications = document.getElementById('specificationsInput').value; // Remplacez 'specificationsInput' par l'ID réel de votre champ d'entrée

    // Afficher les offres et spécifications au step 4
    const offersDisplay = document.getElementById('offersDisplay'); // Remplacez 'offersDisplay' par l'ID de l'élément où vous voulez afficher les offres
    offersDisplay.innerHTML = ''; // Réinitialiser l'affichage

    if (selectedOffers.length > 0) {
        selectedOffers.forEach(offer => {
            const offerItem = document.createElement('div');
            offerItem.textContent = offer; // Affiche l'offre sélectionnée
            offersDisplay.appendChild(offerItem);
        });
    } else {
        offersDisplay.textContent = 'Aucune offre sélectionnée.';
    }

    const specificationsDisplay = document.getElementById('specificationsDisplay'); // Remplacez 'specificationsDisplay' par l'ID de l'élément où vous voulez afficher les spécifications
    specificationsDisplay.textContent = specifications ? specifications : 'Aucune spécification fournie.';

    // Passer au step 4
    document.getElementById('step3').style.display = 'none';
    document.getElementById('step4').style.display = 'block';
});

// Function to format telephone number and automatically add hyphens
function formatTelephoneNumber(input) {
    let digits = input.value.replace(/\D/g, ''); // Remove non-digit characters

    // Format to "000-000-0000"
    if (digits.length > 10) {
        digits = digits.slice(0, 10); // Limit to 10 digits
    }

    let formattedNumber = '';
    if (digits.length > 0) {
        formattedNumber += digits.slice(0, 3); // First 3 digits
    }
    if (digits.length > 3) {
        formattedNumber += '-' + digits.slice(3, 6); // Next 3 digits
    }
    if (digits.length > 6) {
        formattedNumber += '-' + digits.slice(6); // Remaining digits
    }

    input.value = formattedNumber; // Update the input value
}

// Event listener for telephone number input
const telContactInput = document.getElementById('tel_contact');
telContactInput.addEventListener('input', function () {
    formatTelephoneNumber(telContactInput);
});

// Validation for Step 5
document.getElementById('btnNextStep5').addEventListener('click', function () {
    const errorMessages = document.querySelectorAll('.error');
    errorMessages.forEach(error => error.style.display = 'none');

    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.style.borderColor = ''; // Reset border color
        const existingCheckmark = input.parentNode.querySelector('.check-icon');
        if (existingCheckmark) {
            existingCheckmark.remove(); // Remove checkmark icon
        }
    });

    const prenom = document.getElementById('prenom').value;
    const nom = document.getElementById('nom').value;
    const fonction = document.getElementById('fonction').value;
    const emailContact = document.getElementById('email_contact').value;
    const telContact = document.getElementById('tel_contact').value;

    let isValidStep5 = true;

    function addCheckmark(input, isValid) {
        const existingCheckmark = input.parentNode.querySelector('.check-icon');
        if (!existingCheckmark) {
            const img = document.createElement('img');
            img.src = isValid ? 'Images/checkVert.png' : 'Images/XIcon.png';
            img.alt = '';
            img.classList.add('icon', 'check-icon');
            img.style.marginLeft = '10px';
            input.parentNode.appendChild(img);
        } else {
            existingCheckmark.src = isValid ? 'Images/checkVert.png' : 'Images/XIcon.png';
        }
    }

    // Validation for Prénom
    if (!prenom) {
        document.getElementById('prenom-error').textContent = 'Prénom est requis.';
        document.getElementById('prenom-error').style.display = 'block';
        document.getElementById('prenom').style.borderColor = 'red';
        isValidStep5 = false;
        addCheckmark(document.getElementById('prenom'), false);
    } else {
        document.getElementById('prenom').style.borderColor = 'green';
        addCheckmark(document.getElementById('prenom'), true);
    }

    // Validation for Nom
    if (!nom) {
        document.getElementById('nom-error').textContent = 'Nom est requis.';
        document.getElementById('nom-error').style.display = 'block';
        document.getElementById('nom').style.borderColor = 'red';
        isValidStep5 = false;
        addCheckmark(document.getElementById('nom'), false);
    } else {
        document.getElementById('nom').style.borderColor = 'green';
        addCheckmark(document.getElementById('nom'), true);
    }

    // Validation for Fonction
    if (!fonction) {
        document.getElementById('fonction-error').textContent = 'Fonction est requise.';
        document.getElementById('fonction-error').style.display = 'block';
        document.getElementById('fonction').style.borderColor = 'red';
        isValidStep5 = false;
        addCheckmark(document.getElementById('fonction'), false);
    } else {
        document.getElementById('fonction').style.borderColor = 'green';
        addCheckmark(document.getElementById('fonction'), true);
    }

    // Validation for Email
    if (!emailContact) {
        document.getElementById('email_contact-error').textContent = 'Courriel est requis.';
        document.getElementById('email_contact-error').style.display = 'block';
        document.getElementById('email_contact').style.borderColor = 'red';
        isValidStep5 = false;
        addCheckmark(document.getElementById('email_contact'), false);
    } else {
        document.getElementById('email_contact').style.borderColor = 'green';
        addCheckmark(document.getElementById('email_contact'), true);
    }

    // Validation for Phone
    if (!telContact) {
        document.getElementById('num_tel-error').textContent = 'Numéro de téléphone est requis.';
        document.getElementById('num_tel-error').style.display = 'block';
        document.getElementById('tel_contact').style.borderColor = 'red';
        isValidStep5 = false;
        addCheckmark(document.getElementById('tel_contact'), false);
    } else {
        document.getElementById('tel_contact').style.borderColor = 'green';
        addCheckmark(document.getElementById('tel_contact'), true);
    }

    // If all validations pass, go to Step 6
    if (isValidStep5) {
        document.getElementById('step5').style.display = 'none';
        document.getElementById('step6').style.display = 'block';
    }
});
