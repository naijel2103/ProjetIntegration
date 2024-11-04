<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offres extends Model
{
    use HasFactory;

    protected $primaryKey = 'codeUNSPSC';

    protected $fillable = [
        'nom',
        'segmentCode',
        'segmentNom',
        'familleCode',
        'familleNom',
        'classCode',
        'classNom',
    ];

    public function fournisseurs()
    {
        return $this->belongsToMany(Fournisseurs::class, 'offres_fournisseurs','offre', 'fournisseur');
    }
}
