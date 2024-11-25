<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FournisseurRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'neq' => 'nullable|integer|unique:fournisseurs,neq',  // L'NEQ peut être nul, mais s'il est fourni, il doit être unique
            'nomFournisseur' => 'nullable|string|max:64',  // Le nom peut être nul, sinon il doit être une chaîne de max 64 caractères
            'numLiscence' => 'nullable|string|max:10|exists:liscences,numLiscence',  // Si présent, doit être valide et correspondre à un enregistrement dans la table 'liscences'
            'email' => 'required|email|max:64|unique:fournisseurs,email',  // L'email est requis, unique et doit être valide
            'mdp' => 'nullable|string|min:6',  // Le mot de passe est optionnel mais doit avoir au moins 6 caractères s'il est fourni
            'numCivique' => 'required|string|max:8',  // Le numéro civique est requis et doit être une chaîne de max 8 caractères
            'rue' => 'required|string|max:64',  // La rue est requise et doit être une chaîne de max 64 caractères
            'bureau' => 'nullable|string|max:8',  // Le bureau est optionnel et peut avoir jusqu'à 8 caractères
            'municipalite' => 'required|string|max:64',  // La municipalité est requise et doit être une chaîne de max 64 caractères
            'province' => 'required|string|max:25',  // La province est requise et doit être une chaîne de max 25 caractères
            'codePostal' => 'required|string|max:6',  // Le code postal est requis et doit être une chaîne de max 6 caractères
            'region' => 'nullable|string|max:50',  // La région est optionnelle, mais si présente, elle ne doit pas dépasser 50 caractères
            'codeRegion' => 'nullable|integer',  // Le code de région est optionnel, mais s'il est fourni, il doit être un entier
            'siteWeb' => 'nullable|url|max:64',  // Le site web est optionnel, mais doit être une URL valide et ne pas dépasser 64 caractères
            'detailService' => 'nullable|string|max:500',  // Les détails du service sont optionnels et peuvent avoir jusqu'à 500 caractères
            'numTPS' => 'nullable|string|max:15',  // Le numéro TPS est optionnel et peut avoir jusqu'à 15 caractères
            'numTVQ' => 'nullable|string|max:16',  // Le numéro TVQ est optionnel et peut avoir jusqu'à 16 caractères
            'conditionPaiement' => 'nullable|string|max:128',  // Les conditions de paiement sont optionnelles et peuvent avoir jusqu'à 128 caractères
            'codeCondition' => 'nullable|string|max:5',  // Le code de condition est optionnel et peut avoir jusqu'à 5 caractères
            'devise' => 'nullable|string|max:3',  // La devise est optionnelle et peut avoir jusqu'à 3 caractères
            'modCom' => 'nullable|string|max:25',  // Le mode de communication est optionnel et peut avoir jusqu'à 25 caractères
            'statut' => 'nullable|string|max:25',  // Le statut est optionnel et peut avoir jusqu'à 25 caractères
        ];
    }
}
