<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de mot de passe</title>
</head>
<body>
    <h1>Réinitialisation de mot de passe, {{ $compte->nom }}!</h1>
    <p>
        Vous pouvez réinitialiser le mot de passe de votre compte avec le code: {{'http://127.0.0.1:8080/reinitialiser/' . $compte->code }}
    </p>
</body>
</html>