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
        'adresse',
        'numTel',
        'postTel',
        'siteWeb',
        'detailService',
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
        return $this->belongsToMany(Offre::class, 'offres_fournisseurs');
    }

    public function licence()
    {
        return $this->hasOne(Licence::class);
    }
}
