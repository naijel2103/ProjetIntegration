<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
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
        if($reussi){
            return redirect()->route('acceuil.index') ->with('message', "Connexion réussie");
        }
        else{
            return redirect()->route('profil.connexion')->withErrors(['Informations invalides']); 
        }
    }




    public function loginNEQ(Request $request)
    {
        $reussi = Auth::attempt(['neq' => $request->neq, 'password' => $request->password]);
        if($reussi){
            return redirect()->route('acceuil.index') ->with('message', "Connexion réussie");
        }
        else{
            return redirect()->route('profil.connexionNEQ')->withErrors(['Informations invalides']); 
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
        

        $compte = Compte::where('email', $request->email)->first();
        if ($compte && $compte->verifier == 1) {
            $compte->code = Str::random(60);
            $compte->save();
            Mail::to($compte->email )->send(new PasswordReset($compte));
            return redirect()->route('login');
        } else {
            return redirect()->route('motdepasse')->withErrors(['error' => 'Adresse courriel invalide']);
        }
    }


    public function reinitialiserPage(string $code)
    {
        return view('Profil.reinitialiser', compact('code'));

    }

    public function reinitialiser(Request $request){
        $compte = Compte::where('code', $request->code)->first();
        if($compte->code == $request->code){
            $compte->password = bcrypt($request->password);
            $compte->code = null;
            $compte->save();
            return redirect()->route('login');
        }
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
