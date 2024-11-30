<!DOCTYPE html>
<html>
<head>
    <title>Réponse de votre demande </title>
</head>
<body>
    <h1>Votre demande a été refusé</h1>
    <p>
    {{ $modele->message }}
 

    </p>
    <p>
        Raison du refu: <b>{{ $raison }}</b>
    </p>
  
</body>
</html>