<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffresFournisseurs extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'idRefOffre';

    protected $fillable = [
        'fournisseur',
        'offre'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseurs::class, 'fournisseur');
    }

    public function offre()
    {
        return $this->belongsTo(Offres::class, 'offre');
    }

}
