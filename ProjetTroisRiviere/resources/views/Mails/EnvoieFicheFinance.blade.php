<!DOCTYPE html>
<html>
<head>
    <title>Fiche fournisseur de {{ $fournisseur->nomFournisseur }}</title>
</head>
<body>
<li>Nom du founisseur: <b>{{ $fournisseur->nomFournisseur }}</b></li>
<li>Numero de liscense: <b>{{ $fournisseur->numLiscence }}</b></li>
<li>Numero Civil: <b>{{ $fournisseur->numCivique }}</b></li>
<li>Rue: <b>{{ $fournisseur->rue }}</b></li>
<li>Bureau: <b>{{ $fournisseur->bureau }}</b></li>
<li>Municipalité: <b>{{ $fournisseur->municipalite }}</b></li>
<li>Province: <b>{{ $fournisseur->province }}</b></li>
<li>code postal: <b>{{ $fournisseur->codePostal }}</b></li>
<li>region: <b>{{ $fournisseur->region }}</b></li>
<li>Code de la region: <b>{{ $fournisseur->codeRegion }}</b></li>
<li>Site Web: <b>{{ $fournisseur->siteWeb }}</b></li>
<li>Detail du service: <b>{{ $fournisseur->detailService}}</b></li>
<li>Numero TPS: <b>{{ $fournisseur->numTPS }}</b></li>
<li>Numero TVQ: <b>{{ $fournisseur->numTVQ }}</b></li>
<li>Condition de paiement: <b>{{ $fournisseur->conditionPaiement }}</b></li>
<li>Code de condition: <b>{{ $fournisseur->codeCondition }}</b></li>
<li>Devise: <b>{{ $fournisseur->devise }}</b></li>
<li>Mode de communication: <b>{{ $fournisseur->modCom }}</b></li>
  <li>Statut: <b>{{ $fournisseur->statut}}</b></li>
   
</body>
</html>