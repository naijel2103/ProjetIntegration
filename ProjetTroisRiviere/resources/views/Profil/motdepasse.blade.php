<link rel="stylesheet" href="{{ asset ('css/ProfilCss/mdp.css') }}">
@extends('layouts.app')
@section('titre', 'Réinitialisation du mot de passe')
@section('contenu')
<div class="page-wrap">
    <br>
    
    <div class="container">
        <div class="row ">
            <div class="col-10 offset-1">
                <br>
                <div class="card">
                    <div class="card-header">Réinitialisation du mot de passe</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profil.reset') }} ">
                            @csrf

                            <div class="form-group row">
                                {{-- <label for="email"
                                    class="col-md-4 col-form-label text-md-right">Adresse courriel</label> --}}
                                <br>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Adresse couriel">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('profil.connexionNEQ') }}" id="btnretour" class="btn btn-danger">Retour</a>
                                        <button type="submit" id="btnaccept" class="btn btn-primary">
                                            Réinitialiser
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
