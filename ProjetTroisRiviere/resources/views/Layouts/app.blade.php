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
          <button type="submit" id="boutonConnexion">Déconnexion</button>
        </a>
        @elseif(Auth::guard('fournisseurs')->check())  <!-- Pour le fournisseur -->
        <a href="\demandeFiche" class="header-link-top">Voir ma fiche</a>
    <a href="{{ route('profil.deconnexionFournisseur') }}">
        <button type="submit" id="boutonConnexion">Déconnexion</button>
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


<footer class="site-footer" style="background-color: #f5f5f5; padding: 20px 40px; font-family: Arial, sans-serif;">
  <div class="footer-container" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap;">

    <!-- Section de gauche -->
    <div class="footer-left" style="max-width: 40%;">
      <img src="https://www.v3r.net/wp-content/themes/v3r/Images/icons/logo-v3r-v2017.svg" alt="Ville de Trois-Rivières" style="max-width: 100px;">
      <div style="margin-top: 10px;">
        <p><strong>Ville de Trois-Rivières</strong></p>
        <p>1325, place de l'Hôtel-de-Ville, C.P. 368<br>
        Trois-Rivières, QC G9A 5H3</p>
        <p><strong>Téléphone :</strong> 311 ou 819 374-2002<br>
        <strong>Canada ou États-Unis :</strong> 1 833 374-2002<br>
        <strong>Courriel :</strong> <a href="mailto:311@v3r.net" style="color: #0073e6;">311@v3r.net</a></p>
      </div>
    </div>

    <!-- Section du milieu -->
    <div class="footer-middle" style="max-width: 20%;">
      <ul style="list-style: none; padding: 0; margin: 0;">
        <li><a href="#" style="text-decoration: none; color: #333;">› Communications</a></li>
        <li><a href="#" style="text-decoration: none; color: #333;">› FAQ</a></li>
        <li><a href="#" style="text-decoration: none; color: #333;">› Tourisme</a></li>
      </ul>
    </div>

    <!-- Section de droite -->
    <div class="footer-right">
      <div>
      <a href="/infolettre" class="social-link"><i class="fas fa-envelope"></i></a>
<a href="https://www.facebook.com/villetroisrivieres" target="_blank" class="social-link"><i class="fab fa-facebook-f"></i></a>
<a href="https://www.instagram.com/villede3rivieres" target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>
<a href="https://www.linkedin.com/company/ville-de-trois-rivi-res" target="_blank" class="social-link"><i class="fab fa-linkedin-in"></i></a>
<a href="https://www.youtube.com/channel/UC4UyW0CoJfaCFaOzcQ05yw" target="_blank" class="social-link"><i class="fab fa-youtube"></i></a>
      </div>
      <p>
        <a href="#">Intranet</a> |
        <a href="#">Portail d'accès aux organismes</a> |
        <a href="#">Politique de confidentialité</a>
      </p>
      <p>© Ville de Trois-Rivières. Tous droits réservés.</p>
    </div>

  </div>
</footer>
</body>
</html>
