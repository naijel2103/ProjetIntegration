@extends('layouts.app')

   
@section('contenu')

<form method="post" action="" enctype="multipart/form-data">
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
                  <button type="submit" id="inputAdminEnregistrer">Envoyez la demande</button>
               </div>

               </div>

         <div class="col-3"></div>

      </div>

   </div>

</form>


@endsection