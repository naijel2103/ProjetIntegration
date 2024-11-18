
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

                        <form method="POST" action="{{route('profil.editGererModele')}}">
                        @method('PATCH')
                            @csrf
                            <div class="row">
                <div class="col-10 offset-1">
                    <label for="modele">Choisissez le modèle</label>
                    <select name="modele" id="modele" onclick="othertype()" value="Select" required>
                        <option disabled selected hidden></option>
                        <option value="Accusé de reception">Accusé de reception</option>
                        <option value="Approbation">Approuvé</option>
                        <option value="Modification">Modification</option>
                        <option value="Refus">Refus</option>
                    </select>
                    <div id="Refus">
                    <label for="texteEmail">Modifier le texte du courriel</label>
                    <textarea id="texteEmail" name="texteEmail" rows="4" cols="50"></textarea>

                   
                    </div>
                    <script>
                        function othertype() {
                            var x = document.getElementById('modele').value;
                            if(x=='Refus') {
                                const texteRefus = @json($refus->message);
                                document.getElementById('texteEmail').value =  texteRefus;
                
                            } else if(x=='Approbation'){
                                const texteAppro = @json($appro->message);
                                document.getElementById('texteEmail').value = texteAppro;
                            } else if(x=='Modification'){
                                const texteMod = @json($mod->message);
                                document.getElementById('texteEmail').value = texteMod;
                            }else{
                                const texteAccuse = @json($accuse->message);
                                document.getElementById('texteEmail').value = texteAccuse;
                            }
                        }
                    </script>
                </div>
            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{route('acceuils.index')}}" id="btnretour" class="btn btn-success">Retour</a>
                                        <button type="submit" id="btnaccept" class="btn btn-primary">
                                            Confirmer les modèles
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
