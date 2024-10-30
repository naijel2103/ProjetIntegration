<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Comptes;
use App\Models\Modeles_courriels;
use App\Mail\resetDeMotDePasse;
use App\Mail\AccountCreated;

class ProfilsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function connexion()
    {

        if (auth()->check()) {
            return redirect()->route('profil');
        }
        else {
            return view('Profil.connexion');
        }

        
        
    }

    public function deconnexion()
    {
        Auth::logout();
        return redirect('/')->with('message', "Déconnexion réussie");
    }


    

    public function connexionNEQ()
    {
 
        if (auth()->check()) {
            return redirect()->route('profil');
        }
        else {
            return view('Profil.connexionNEQ');
        }
    }




    public function login(Request $request)
    {

        $reussi = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        $compte = Comptes::where('email', $request->email)->first();
        $role = $compte->role;
        if($reussi && $role == 'aucun'){
            
            return redirect()->route('fiche.demandeFiche') ->with('message', "Connexion réussie");
        } elseif($reussi && $role == 'admin' ||$role == 'responsable')
        {
            return redirect()->route('acceuils.index'); 
        }
        else{
            return redirect()->route('profil.connexion')->withErrors(['Informations invalides']); 
        }
    }

    public function gererModele()
    {
        $modeles = Modeles_courriels::all();
        $refus = Modeles_courriels::where('idModele',1)->first();
        $appro = Modeles_courriels::where('idModele',2)->first();
        $accuse = Modeles_courriels::where('idModele',3)->first();
   
      return view('Profil.gererModele',compact("modeles","refus","appro","accuse"));
    }

    public function editGererModele(Request $request,Modeles_courriels $modele)
    {
      if($request->modele == "Refus")
      {
        $modele = Modeles_courriels::where('idModele',1)->first();
        $modele->message = $request->texteEmail;
        $modele->save();
      }
      if($request->modele == "Approbation")
      {
        $modele = Modeles_courriels::where('idModele',2)->first();
        $modele->message = $request->texteEmail;
        $modele->save();
      }
      if($request->modele == "Accusé de reception")
      {
        $modele = Modeles_courriels::where('idModele',3)->first();
        $modele->message = $request->texteEmail;
        $modele->save();
      }


      $refus = Modeles_courriels::where('idModele',1)->first();
      $appro = Modeles_courriels::where('idModele',2)->first();
      $accuse = Modeles_courriels::where('idModele',3)->first();
      return view('Profil.gererModele',compact("refus","appro","accuse"));

    }


    public function loginNEQ(Request $request)
    {
        $reussi = Auth::attempt(['neq' => $request->neq, 'password' => $request->password]);
        if($reussi){
            return redirect()->route('fiche.demandeFiche') ->with('message', "Connexion réussie");
        }
        else{
            return redirect()->route('profil.connexionNEQ')->withErrors(['Informations invalides']); 
        }
    }

    public function creation()
    {
        return view('Profil.creation');
    }


    public function gererComptes()
    {
        $comptes = Comptes::all();
        return view('Profil.gererComptes',compact("comptes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function creer(Request $request)
    {
     
        $compte = new Comptes();
        $compte->email = $request->email;
        $compte->nom = $request->nom;
        $compte->password = bcrypt($request->password);
        $compte->role = "aucun";
        $compte->code = Str::random(60);
        $compte->verifier = false;
        $compte->save();
        Mail::to($compte-> email)->send(new AccountCreated($compte));
       
            return redirect()->route('acceuils.index');
    }

    public function motdepasseView(){
        return view('Profil.motdepasse');
    }

    
    public function confirmer(string $code){
        $compte = Comptes::where('code', '=', $code)->first();
        if($compte->code == $code && $compte->verifier == false){
            $compte->verifier = true;
            $compte->code = null;
            $compte->save();
            return redirect()->route('profil.connexionNEQ');
        }else{
            return redirect()->route('profil.confirmation')->withErrors(['error' => "Code invalide"]);
        }
    }

         
    public function reset(Request $request)
    {
        

        $compte = Comptes::where('email', $request->email)->first();
        if ($compte && $compte->verifier == 1) {
            $compte->code = Str::random(60);
            $compte->save();
            Mail::to($compte->email )->send(new resetDeMotDePasse($compte));
            return redirect()->route('profil.connexionNEQ');
        } else if($compte->verifier == 0) {
            return redirect()->route('Profil.motdepasse')->withErrors(['error' => 'Veulliez verifier votre comptre']);
           
        }else
        {
            return redirect()->route('Profil.motdepasse')->withErrors(['error' => 'Adresse courriel invalide']);
        }
    }


    public function reinitialiserPage(string $code)
    {
        return view('profil.reinitialiser', compact('code'));

    }

    public function reinitialiser(Request $request){
        $compte = Comptes::where('code', $request->code)->first();
        if($compte->code == $request->code){
            $compte->password = bcrypt($request->password);
            $compte->code = null;
            $compte->save();
            return redirect()->route('profil.connexionNEQ');
        }
    }



    public function destroy(string $id)
    {
        try{
        $compte= Comptes::findOrFail($id);

            if($compte->role =='admin')
            {

          
        $adminCount = Comptes::where('role', 'admin')->count();

        if ($adminCount <= 2) {
            return redirect()->back()->with('error', 'Il doit y avoir au moins 2 administrateurs');
        }else{
            $compte->delete();
            return redirect()->route('profil.gererComptes')->with('message', "Suppression de " . $compte->nom . " réussi!");
        }
        } else
        {
            $compte->delete();
        }


                  
                 
        }
                   catch(\Throwable $e){
                    //Gérer l'erreur
       
                    return redirect()->route('profil.gererComptes')->withErrors(['la suppression n\'a pas fonctionné']); 
                  }
                     return redirect()->route('profil.gererComptes');
                }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comptes $compte)
    {
        return View('profil.edit', compact('compte'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comptes $compte)
    {
        try{
            $compte->email = $request->email;
            $compte->nom = $request->nom;
            $compte->role = $request->role;
            $compte->save();
            
            return redirect()->route('profil.gererComptes')->with('message', "Modification de " .$compte->nom . " réussi!");
        }catch(\Throwable $e)
        {
        
            return redirect()->route('profil.gererComptes')->with('message', "Modification de " . $compte->nom . "non");
        }
        return redirect()->route('profil.gererComptes');
    }

  
}
