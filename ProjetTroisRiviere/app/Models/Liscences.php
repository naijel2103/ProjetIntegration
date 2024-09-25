<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liscences extends Model
{
    use HasFactory;

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function categorieLiscences()
    {
        return $this->belongsToMany(CategorieLiscences::class, 'specification_liscences');
    }
}
