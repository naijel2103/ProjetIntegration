
@section('titre', 'Gerer les modeles')
@extends('layouts.app')
@section('contenu')
<div class="page-wrap">
    <br>
    
    <div class="container">
        <div class="row ">
            <div class="col-10 offset-1">
                <br>
                <div class="card">
                    <div class="card-header">Gestion des modèles</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{route('profil.editGererParametres')}}">
                        @method('PATCH')
                            @csrf
                            <div class="row">
                <div class="col-10 offset-1">
                    <label for="emailFinance">Courriels des Finances</label>
                    <input type="email" name="emailFinance" id="emailFinance" class="form-control" value="<?php echo $finance->courrielFinance; ?>" required>
                    
                    <label for="emailAppro">Courriel de l'appro</label>
                    <input type="email" name="emailAppro" id="emailAppro" class="form-control" value="<?php echo $finance->courrielAppro; ?>" required>
                    <label for="delai">Délai avant la révision (mois)</label>
                    <input type="number" name="delai" id="delai" class="form-control" value="<?php echo $finance->delaiRevision; ?>" required>
                    <label for="taille">Taille maximale des fichiers joints (Mo)</label>
                    <input type="number" name="taille" id="taille" class="form-control" value="<?php echo $finance->tailleFichiersMax; ?>" required>

                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{route('acceuils.index')}}" id="btnretour" class="btn btn-success">Retour</a>
                                        <button type="submit" id="btnaccept" class="btn btn-primary">
                                            Confirmer les paramètres
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
