<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offres extends Model
{
    use HasFactory;

    public function fournisseurs()
    {
        return $this->belongsToMany(Fournisseur::class, 'offres_fournisseurs');
    }
}
