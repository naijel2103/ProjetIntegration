function togglePasswordVisibility(inputId) {
    const inputField = document.getElementById(inputId);
    const inputType = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
    inputField.setAttribute('type', inputType);

    // Change the eye icon based on visibility
    const eyeIcon = document.getElementById(`toggle-${inputId}`);
    eyeIcon.src = inputType === 'password' ? 'Images/eye.png' : 'Images/eye-open.png'; // Replace with appropriate icon paths
}

// Validation for step1
document.getElementById('btnNext').addEventListener('click', function () {
    // Reset error messages
    const errorMessages = document.querySelectorAll('.error');
    errorMessages.forEach(error => error.style.display = 'none');

    // Reset input borders
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.style.borderColor = ''; // Reset border color
        // Remove existing checkmarks
        const existingCheckmark = input.parentNode.querySelector('.check-icon');
        if (existingCheckmark) {
            existingCheckmark.remove();
        }
    });

    // Validate inputs in step1
    const neq = document.getElementById('neq').value;
    const nom = document.getElementById('nom').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;

    let isValid = true;

    function addCheckmark(input, isValid) {
        const existingCheckmark = input.parentNode.querySelector('.check-icon');

        // Check if the checkmark already exists
        if (!existingCheckmark) {
            const img = document.createElement('img');
            img.src = isValid ? 'Images/checkVert.png' : 'Images/XIcon.png';
            img.alt = '';
            img.classList.add('icon', 'check-icon'); // Add the check-icon class
            img.style.marginLeft = '10px'; // Adjust margin if necessary
            input.parentNode.appendChild(img);
        } else {
            // If it exists, update the source
            existingCheckmark.src = isValid ? 'Images/checkVert.png' : 'Images/XIcon.png';
        }
    }

    // Validation for nom
    if (!nom) {
        document.getElementById('nom-error').textContent = 'Nom de l\'entreprise est requis.';
        document.getElementById('nom-error').style.display = 'block';
        document.getElementById('nom').style.borderColor = 'red'; // Red border
        isValid = false;
        addCheckmark(document.getElementById('nom'), false);
    } else {
        document.getElementById('nom').style.borderColor = 'green'; // Green border
        addCheckmark(document.getElementById('nom'), true);
    }

    // Validation for email
    if (!email) {
        document.getElementById('email-error').textContent = 'Adresse courriel est requise.';
        document.getElementById('email-error').style.display = 'block';
        document.getElementById('email').style.borderColor = 'red'; // Red border
        isValid = false;
        addCheckmark(document.getElementById('email'), false);
    } else {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            document.getElementById('email-error').textContent = 'Adresse courriel invalide.';
            document.getElementById('email-error').style.display = 'block';
            document.getElementById('email').style.borderColor = 'red'; // Red border
            isValid = false;
            addCheckmark(document.getElementById('email'), false);
        } else {
            document.getElementById('email').style.borderColor = 'green'; // Green border
            addCheckmark(document.getElementById('email'), true);
        }
    }

    // Validation for password
    if (!password) {
        document.getElementById('password-error').textContent = 'Mot de passe est requis.';
        document.getElementById('password-error').style.display = 'block';
        document.getElementById('password').style.borderColor = 'red'; // Red border
        isValid = false;
        addCheckmark(document.getElementById('password'), false);
    } else if (password.length < 8) {
        document.getElementById('password-error').textContent = 'Le mot de passe doit contenir au moins 8 caractères.';
        document.getElementById('password-error').style.display = 'block';
        document.getElementById('password').style.borderColor = 'red'; // Red border
        isValid = false;
        addCheckmark(document.getElementById('password'), false);
    } else {
        document.getElementById('password').style.borderColor = 'green'; // Green border
        addCheckmark(document.getElementById('password'), true);
    }

    // Validation for password confirmation
    if (passwordConfirmation !== password || !passwordConfirmation) {
        document.getElementById('password_confirmation-error').textContent = 'Les mots de passe ne correspondent pas.';
        document.getElementById('password_confirmation-error').style.display = 'block';
        document.getElementById('password_confirmation').style.borderColor = 'red'; // Red border
        isValid = false;
        addCheckmark(document.getElementById('password_confirmation'), false);
    } else {
        document.getElementById('password_confirmation').style.borderColor = 'green'; // Green border
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
    // Reset error messages and borders
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

    // Validate inputs in step 2
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

    // Validation for adresse
    if (!siteInternet) {
        document.getElementById('siteInternet-error').textContent = 'Site internet est requis.';
        document.getElementById('siteInternet-error').style.display = 'block';
        document.getElementById('siteInternet').style.borderColor = 'red'; // Red border
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('siteInternet'), false);
    } else {
        document.getElementById('siteInternet').style.borderColor = 'green'; // Green border
        addCheckmarkStep2(document.getElementById('siteInternet'), true);
    }

    // Validation for numéro civique (only numbers)
    if (!numeroCivique || !/^\d+$/.test(numeroCivique) ) {
        document.getElementById('numero_civique-error').textContent = 'Numéro civique est requis et doit contenir uniquement des chiffres.';
        document.getElementById('numero_civique-error').style.display = 'block';
        document.getElementById('numero_civique').style.borderColor = 'red'; // Red border
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('numero_civique'), false);
    } else {
        document.getElementById('numero_civique').style.borderColor = 'green'; // Green border
        addCheckmarkStep2(document.getElementById('numero_civique'), true);
    }

    // Validation for rue (only letters)
    if (!rue || !/^[A-Za-zÀ-ÿ\s]+$/.test(rue)) {
        document.getElementById('rue-error').textContent = 'Rue est requise et doit contenir uniquement des lettres.';
        document.getElementById('rue-error').style.display = 'block';
        document.getElementById('rue').style.borderColor = 'red'; // Red border
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('rue'), false);
    } else {
        document.getElementById('rue').style.borderColor = 'green'; // Green border
        addCheckmarkStep2(document.getElementById('rue'), true);
    }

    // Validation for bureau
    if (!bureau) {
        document.getElementById('bureau-error').textContent = 'Bureau est requis.';
        document.getElementById('bureau-error').style.display = 'block';
        document.getElementById('bureau').style.borderColor = 'red'; // Red border
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('bureau'), false);
    } else {
        document.getElementById('bureau').style.borderColor = 'green'; // Green border
        addCheckmarkStep2(document.getElementById('bureau'), true);
    }

    // Validation for ville
    if (!ville) {
        document.getElementById('ville-error').textContent = 'Ville est requise.';
        document.getElementById('ville-error').style.display = 'block';
        document.getElementById('ville').style.borderColor = 'red'; // Red border
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('ville'), false);
    } else {
        document.getElementById('ville').style.borderColor = 'green'; // Green border
        addCheckmarkStep2(document.getElementById('ville'), true);
    }

    // Validation for province
    if (!province) {
        document.getElementById('province-error').textContent = 'Province est requise.';
        document.getElementById('province-error').style.display = 'block';
        document.getElementById('province').style.borderColor = 'red'; // Red border
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('province'), false);
    } else {
        document.getElementById('province').style.borderColor = 'green'; // Green border
        addCheckmarkStep2(document.getElementById('province'), true);
    }

    // Validation for code postal (format "G8T 2R7")
    const codePostalPattern = /^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/;
    if (!codePostal || !codePostalPattern.test(codePostal)) {
        document.getElementById('code_postal-error').textContent = 'Code postal est requis et doit être au format "G8T 2R7".';
        document.getElementById('code_postal-error').style.display = 'block';
        document.getElementById('code_postal').style.borderColor = 'red'; // Red border
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('code_postal'), false);
    } else {
        document.getElementById('code_postal').style.borderColor = 'green'; // Green border
        addCheckmarkStep2(document.getElementById('code_postal'), true);
    }

    // Validation for numTelType
    if (!numTelType) {
        document.getElementById('num_tel_type-error').textContent = 'Type de numéro de téléphone est requis.';
        document.getElementById('num_tel_type-error').style.display = 'block';
        document.getElementById('num_tel_type').style.borderColor = 'red'; // Red border
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('num_tel_type'), false);
    } else {
        document.getElementById('num_tel_type').style.borderColor = 'green'; // Green border
        addCheckmarkStep2(document.getElementById('num_tel_type'), true);
    }

    // Validation for numTel (format "000-000-0000")
    const numTelPattern = /^\d{3}-\d{3}-\d{4}$/;
    if (!numTel || !numTelPattern.test(numTel)) {
        document.getElementById('num_tel-error').textContent = 'Format du numéro de téléphone invalide. Ex: 000-000-0000';
        document.getElementById('num_tel-error').style.display = 'block';
        document.getElementById('num_tel').style.borderColor = 'red'; // Red border
        isValidStep2 = false;
        addCheckmarkStep2(numTelInput, false);
    } else {
        numTelInput.style.borderColor = 'green'; // Green border
        addCheckmarkStep2(numTelInput, true);
    }

    // Validation for poste
    if (!poste) {
        document.getElementById('poste-error').textContent = 'Poste est requis.';
        document.getElementById('poste-error').style.display = 'block';
        document.getElementById('poste').style.borderColor = 'red'; // Red border
        isValidStep2 = false;
        addCheckmarkStep2(document.getElementById('poste'), false);
    } else {
        document.getElementById('poste').style.borderColor = 'green'; // Green border
        addCheckmarkStep2(document.getElementById('poste'), true);
    }

    // Proceed to next step if valid
    if (isValidStep2) {
        console.log('Step 2 is valid. Proceeding to the next step...');
        // Add your code to proceed to the next step
    }
});


    if (isValidStep2) {
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block'; // Ensure step3 exists and is correctly defined
    }

// Go back to step1 from step2
document.getElementById('btnRetour').addEventListener('click', function () {
document.getElementById('step2').style.display = 'none';
document.getElementById('step1').style.display = 'block';
});