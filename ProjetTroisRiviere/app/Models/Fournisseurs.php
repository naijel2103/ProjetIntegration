<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseurs extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'idFournisseur';

    protected $fillable = [
        'neq',
        'nomFournisseur',
        'numLiscence',
        'email',
        'mdp',
        'numCivique',
        'rue',
        'bureau',
        'municipalite',
        'province',
        'codePostal',
        'region',
        'codeRegion',
        'siteWeb',
        'detailService',
        'numTPS',
        'numTVQ',
        'conditionPaiement',
        'codeCondition',
        'devise',
        'modCom',
        'statut',
    ];

    protected $hidden = [
        'mdp',
        'numTPS',
        'numTVQ',
    ];

    public function offres()
    {
        return $this->belongsToMany(Offres::class, 'offres_fournisseurs', 'fournisseur', 'offre');
    }

    public function licence()
    {
        return $this->belongsTo(Liscences::class, 'numLiscence', 'numLiscence');
    }

    public function demandeInscription()
    {
        return $this->hasOne(Demandesinscriptions::class, 'idFournisseur');
    }

    public function listeAContacte()
    {
        return $this->belongsTo(ListeAContacte::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contacts::class, 'fournisseur', 'idFournisseur');
    }
    
    public function infotels()
    {
        return $this->hasMany(Infotels::class, 'fournisseur');
    }
}
