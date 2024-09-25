function togglePasswordVisibility(inputId) {
    const inputField = document.getElementById(inputId);
    const inputType = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
    inputField.setAttribute('type', inputType);

    // Change the eye icon based on visibility
    const eyeIcon = document.getElementById(`toggle-${inputId}`);
    eyeIcon.src = inputType === 'password' ? 'Images/eye.png' : 'Images/eye-open.png'; // Replace with appropriate icon paths
}

document.getElementById('btnNext').addEventListener('click', function () {
    // Réinitialise les messages d'erreur
    const errorMessages = document.querySelectorAll('.error');
    errorMessages.forEach(error => error.style.display = 'none');

    // Réinitialise la couleur des bordures
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.style.borderColor = ''; // Réinitialiser la couleur de bordure
        // Remove existing checkmarks
        const existingCheckmark = input.parentNode.querySelector('.check-icon');
        if (existingCheckmark) {
            existingCheckmark.remove();
        }
    });

    // Validation des inputs de la première étape
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
            img.src = isValid ? 'Images/checkVert.png' : 'Images/checkRouge.png';
            img.alt = '';
            img.classList.add('icon', 'check-icon'); // Add the check-icon class
            img.style.marginLeft = '10px'; // Adjust margin if necessary
            input.parentNode.appendChild(img);
        } else {
            // If it exists, update the source
            existingCheckmark.src = isValid ? 'Images/checkVert.png' : 'Images/checkRouge.png';
        }
    }

    // Vérification des conditions


    if (!nom) {
        document.getElementById('nom-error').textContent = 'Nom de l\'entreprise est requis.';
        document.getElementById('nom-error').style.display = 'block';
        document.getElementById('nom').style.borderColor = 'red'; // Bordure rouge
        isValid = false;
        addCheckmark(document.getElementById('nom'), false);
    } else {
        document.getElementById('nom').style.borderColor = 'green'; // Bordure verte
        addCheckmark(document.getElementById('nom'), true);
    }

    if (!email) {
        document.getElementById('email-error').textContent = 'Adresse courriel est requise.';
        document.getElementById('email-error').style.display = 'block';
        document.getElementById('email').style.borderColor = 'red'; // Bordure rouge
        isValid = false;
        addCheckmark(document.getElementById('email'), false);
    } else {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            document.getElementById('email-error').textContent = 'Adresse courriel invalide.';
            document.getElementById('email-error').style.display = 'block';
            document.getElementById('email').style.borderColor = 'red'; // Bordure rouge
            isValid = false;
            addCheckmark(document.getElementById('email'), false);
        } else {
            document.getElementById('email').style.borderColor = 'green'; // Bordure verte
            addCheckmark(document.getElementById('email'), true);
        }
    }

    if (!password) {
        document.getElementById('password-error').textContent = 'Mot de passe est requis.';
        document.getElementById('password-error').style.display = 'block';
        document.getElementById('password').style.borderColor = 'red'; // Bordure rouge
        isValid = false;
        addCheckmark(document.getElementById('password'), false);
    } else if (password.length < 8) {
        document.getElementById('password-error').textContent = 'Le mot de passe doit contenir au moins 8 caractères.';
        document.getElementById('password-error').style.display = 'block';
        document.getElementById('password').style.borderColor = 'red'; // Bordure rouge
        isValid = false;
        addCheckmark(document.getElementById('password'), false);
    } else {
        document.getElementById('password').style.borderColor = 'green'; // Bordure verte
        addCheckmark(document.getElementById('password'), true);
    }

    if (passwordConfirmation !== password || !passwordConfirmation) {
        document.getElementById('password_confirmation-error').textContent = 'Les mots de passe ne correspondent pas.';
        document.getElementById('password_confirmation-error').style.display = 'block';
        document.getElementById('password_confirmation').style.borderColor = 'red'; // Bordure rouge
        isValid = false;
        addCheckmark(document.getElementById('password_confirmation'), false);
    } else {
        document.getElementById('password_confirmation').style.borderColor = 'green'; // Bordure verte
        addCheckmark(document.getElementById('password_confirmation'), true);
    }

    // Si toutes les validations passent, passer à l'étape suivante
    if (isValid) {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
    }
});
