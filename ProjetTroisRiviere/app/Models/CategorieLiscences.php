<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieLiscences extends Model
{
    use HasFactory;

    public function liscences()
    {
        return $this->belongsToMany(Liscences::class, 'specification_liscences');
    }
}
