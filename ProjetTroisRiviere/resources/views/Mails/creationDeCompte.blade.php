<!DOCTYPE html>
<html>
<head>
    <title>Bienvenue</title>
</head>
<body>
    <h1>Bienvenue sur notre site, {{ $compte->nom }}!</h1>
    <p>
        Vous pouvez maintenant vérifier votre compte avec le code: {{'http://127.0.0.1:8000/confirmer/' . $compte->code }}
    </p>
</body>
</html>