<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $reussi = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        if($reussi){
            return redirect()->route('profil') ->with('message', "Connexion réussie");
        }
        else{
            return view('Profil.connexion')->withErrors(['Informations invalides']); 
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

    public function creation()
    {
        return view('Profil.creation');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function creer(Request $request)
    {
        $compte = new Compte();
        $compte->email = $request->email;
        $compte->nomEntreprise = $request->nomEntreprise;
        $compte->password = bcrypt($request->password);
        $compte->role = $request->role;
        $compte->save();
        
            return redirect()->route('Acceuils.index');
    }

    public function motdepasseView(){
        return view('Profil.motdepasse');
    }

         
    public function reset(Request $request)
    {
        
        return redirect()->route('motdepasse')->withErrors(['error' => 'Adresse courriel invalide']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
