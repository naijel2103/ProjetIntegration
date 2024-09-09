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
        if (auth()->check()) {
            return redirect()->route('profil');
        }
        else {
            return view('Profil.connexion');
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
            return redirect()->route('index');
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
