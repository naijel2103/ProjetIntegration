@extends('layouts.app')

@section('titre','Demande d inscription ')
   
@section('contenu')

<form method="get" action="{{ route('fiche.envoieDemandeFiche') }}" enctype="multipart/form-data">
@csrf
    <div class="container-fluid">

        <div class="row form-group" id="input_groupe">

            <div class="col-3"></div>

            <div class="col-6">

               <div id="input_div">
                  <span></span>
                  <h5>Voici votre fiche</h5>
               </div>

              

               <div id="input_div">
                  <span></span>
                  <button type="submit" id="EnvoieDemance">Envoyez la demande</button>
                  <button type="submit" id="ModifierFiche">Modifier votre fiche</button>
                  <button type="submit" id="SupprimerFiche">Supprimer ma fiche</button>
               </div>

               </div>

         <div class="col-3"></div>

      </div>

   </div>

</form>


@endsection