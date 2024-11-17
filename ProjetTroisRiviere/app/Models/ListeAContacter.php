<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListeAContacter extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'listeacontacter';

    public $incrementing = false;

    protected $fillable = [
        'codeListe',
        'fournisseur',
        'contacte'
    ];

    public function fournisseur()
    {
        return $this->hasMany(Fournisseurs::class, 'fournisseur');
    }
}
