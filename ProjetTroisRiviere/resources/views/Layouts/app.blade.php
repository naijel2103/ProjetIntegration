<!DOCTYPE html>
<html lang="fr-CA">
<head>
<meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title> @yield('titre') </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
        <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" style="text/css" href="\css\GabaritCss\GabaritCss.css">
   
<meta charset="UTF-8">
</head>

<body>

<header>
  <div class="sticky-container">
    <div class="navbar contrast">
      <!-- Logo -->
      <img src="{{ asset('images/LogoTrNoir.png') }}" id="imgLogo" />

      <!-- Hamburger Button -->
      <button id="hamburger" class="hamburger">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </button>

      <script>
  document.getElementById('hamburger').addEventListener('click', function () {
    const menu = document.getElementById('menu');
    menu.classList.toggle('show');
  });
</script>

      <!-- Navigation principale -->
      <nav id="menu" class="menu">
        <a href="\" class="header-link-top">Accueil</a>

        @role('Fournisseur')
        <a href="\demandeFiche" class="header-link-top">Voir ma fiche</a>
        @endrole

        @role('Commis')
        <a href="\listeFournisseur" class="header-link-top">Fiches fournisseur</a>
        <a href="\listeAContacter" class="header-link-top">Listes à contacter</a>
        <a href="\listeDemande" class="header-link-top">Demandes fournisseur</a>
        @endrole

        @role('Responsable')
        <a href="\listeFournisseur" class="header-link-top">Fiches fournisseur</a>
        <a href="\listeAContacter" class="header-link-top">Listes à contacter</a>
        <a href="\listeDemande" class="header-link-top">Demandes fournisseur</a>
        @endrole

        @role('Admin')
        <a href="\gererModele" class="header-link-top">Gérer les modèles de courriels</a>
        <a href="\creationCompte" class="header-link-top">Créer des comptes</a>
        <a href="\gererComptes" class="header-link-top">Gérer les comptes</a>
        <a href="\gererParametres" class="header-link-top">Gérer les paramètres</a>
        <a href="\listeFournisseur" class="header-link-top">Fiches fournisseur</a>
        <a href="\listeAContacter" class="header-link-top">Listes à contacter</a>
        <a href="\listeDemande" class="header-link-top">Demandes fournisseur</a>
        @endrole

        @auth
        <a href="{{ route('profil.deconnexion') }}">
          <button type="submit" id="boutonDeconnexion">Déconnexion</button>
        </a>
        @else
        <a href="{{ route('profil.connexionNEQ') }}">
          <button type="submit" id="boutonConnexion">Connexion / S'inscrire</button>
        </a>
        @endauth
      </nav>
    </div>
  </div>
</header>

@yield('contenu')

<!-- Mettre le footer -->


<footer class="site-footer">
  <div class="footer contrast">
    <div class="footer-content">
      <div class="footer-left">
        <a href=""><img src="https://www.v3r.net/wp-content/themes/v3r/Images/icons/logo-v3r-v2017.svg" alt="Ville de Trois-Rivières"></a>
        <div class="footer-title">Ville de Trois-Rivières</div>
        <div class="footer-link">
          <a class="link-foot" href="https://www.google.ca/maps/place/H%C3%B4tel+de+ville/@46.3430042,-72.545511,17z/data=!4m12!1m6!3m5!1s0x41aa0c6a9ae1712b:0xc5f7bf52c7282858!2sH%C3%B4tel+de+ville!8m2!3d46.3430005!4d-72.5433223!3m4!1s0x41aa0c6a9ae1712b:0xc5f7bf52c7282858!8m2!3d46.3430005!4d-72.5433223" target="blank">
            1325, place de l'Hôtel-de-Ville, C.P. 368
            <br>
            Trois-Rivières, QC G9A 5H3
          </a>
        </div>
        <div class="footer-phone">
          Téléphone : <a href="tel" class="link-foot">311</a> ou <a href="tel" class="link-foot">819 374-2002</a>
        </div>
        <div class="footer-link">
          <a class="link-foot" href="tel">
            Canada ou Étas-Unis : 1 833 374-2002
          </a>
        </div>
        <div class="footer-link">
          <a class="link-foot" href="mailto:311@v3r.net">
            Courriel : 311@v3r.net
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
