@section('titre', 'Modification du compte')
@extends('layouts.app')
@section('contenu')
<section class="main-container">
      
<form method="post" action="{{ route('profil.update',[$compte]) }}"  enctype="multipart/form-data">
@csrf
@method('PATCH')
<div class=" col-10 offset-1">
      <br>
                      

       <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom"class="form-control" value="<?php echo $compte->nom; ?>"required>

                <label for="email">Adresse courriel:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $compte->email; ?>" required>
                </br>
             
                  <label for="role" id="inputLabel">Role de l'usager</label>
                  <select id="inputAdmin" name="role">
                     <option value="<?php echo $compte->role; ?>" selected>Veuillez choisir un role</option>
                     <option value="Fournisseur">Fournisseur</option>
                     <option value="Commis">Commis</option>
                     <option value="Responsable">Responsable</option>
                     <option value="Admin">Administrateur</option>
                  </select>
               <div id="input_div">
                  <span></span>
                  <button type="submit" id="inputAdminEnregistrer">Enregistrer</button>
               </div>

               </div>

         <div class="col-3"></div>

      </div>

   </div>

</form>

   </section>

@endsection