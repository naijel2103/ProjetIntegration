document.addEventListener('DOMContentLoaded', function () {
    // Step navigation buttons
    const btnNext = document.getElementById('btnNext');
    const btnNextStep = document.getElementById('btnNextStep');
    const btnSkipStep3 = document.getElementById('btnSkipStep3');
    const btnRetour = document.getElementById('btnRetour');
    const btnRetourStep2 = document.getElementById('btnRetourStep2');

    // Step containers
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');

    // Button to go to Step 2
    btnNext.addEventListener('click', function () {
        step1.style.display = 'none';
        step2.style.display = 'block';
    });

    // Button to go to Step 3
    btnNextStep.addEventListener('click', function () {
        step2.style.display = 'none';
        step3.style.display = 'block';
    });

    // Button to skip to Step 3
    btnSkipStep3.addEventListener('click', function () {
        step1.style.display = 'none'; // Hide step 1
        step2.style.display = 'none'; // Hide step 2
        step3.style.display = 'block'; // Show step 3
    });

    // Back button for Step 2
    btnRetour.addEventListener('click', function () {
        step1.style.display = 'block';
        step2.style.display = 'none';
    });

    // Back button for Step 3
    btnRetourStep2.addEventListener('click', function () {
        step2.style.display = 'block';
        step3.style.display = 'none';
    });
});


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

    // If all validations pass, go to step3
    if (isValidStep2) {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
    }
});
