<link rel="stylesheet" href="{{ asset ('css/ProfilCss/mdp.css') }}">
@extends('layouts.app')
@section('titre', 'Gestion de la demande')
@section('contenu')
<div class="page-wrap">
    <br>
    
    <div class="container">
        <div class="row ">
            <div class="col-10 offset-1">
                <br>
                <div class="card">
                    <div class="card-header">Gestion de la demande de {{ $fournisseur->nomFournisseur }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('fiche.reponseDemande',[$fournisseur]) }} ">
                        @method('PATCH')
                            @csrf
                            <div class="row">
                <div class="col-10 offset-1">
                    <label for="statut">Choisissez le statut</label>
                    <select name="statut" id="statut" onclick="othertype()" value="Select" required>
                        <option disabled selected hidden></option>
                        <option value="En attente">En attente</option>
                        <option value="Acceptee">Accepte</option>
                        <option value="Refusee">Refusee</option>
                    </select>
                    <div id="refuse">
                    <label for="raisonRefus">Entrez la raison du refus</label>
                    <textarea id="raisonRefus" name="raisonRefus" rows="4" cols="50"></textarea>
                    <label for="envoyerRaison">Envoyer la raison</label>
                    <input type="checkbox" name="envoyerRaison" value="1">
                    </div>
                    <script>
                        function othertype() {
                            var x = document.getElementById('statut').value;
                            if(x=='Refusee') {
                                document.getElementById('refuse').style.display = "block";
                                document.getElementById('raisonRefus').required = true;
                            } else {
                                document.getElementById('refuse').style.display = "none";
                                document.getElementById('raisonRefus').required = false;
                                document.getElementById('raisonRefus').value = "";
                            }
                        }
                    </script>
                </div>
            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('fiche.show', [$fournisseur]) }}" id="btnretour" class="btn btn-danger">Retour</a>
                                        <button type="submit" id="btnaccept" class="btn btn-primary">
                                            Confirmer la demande
                                        </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
