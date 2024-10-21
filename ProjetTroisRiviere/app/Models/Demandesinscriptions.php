<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demandesinscriptions extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'numDemande';

    protected $fillable = [
        'idFournisseur',
        'dateDemande',
        'dateDerniereMod',
        'dateChangementStatut',
        'statut',
        
    ];

    protected $hidden = [
        'raisonRefus',
    ];

}

