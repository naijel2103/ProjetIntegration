<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liscences extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'numLiscence';

    protected $fillable = [
        'statut',
        'type'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseurs::class, 'fournisseur');
    }

    public function categorieLiscences()
    {
        return $this->belongsToMany(CategorieLiscences::class, 'specification_liscences','numLiscence','categorie_liscence');
    }
}
