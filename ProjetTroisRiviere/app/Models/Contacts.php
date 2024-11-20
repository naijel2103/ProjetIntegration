<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'idContact';

    protected $fillable = [
        'fournisseur',
        'prenom',
        'nom',
        'fonction',
        'email',
        "telephone",
    ];


    public function fournisseur()
    {
        return $this->belongsTo(Fournisseurs::class, 'fournisseur', 'idFournisseur');
    }

    public function infotels()
    {
        return $this->hasMany(Infotels::class, 'fournisseur');
    }
}
