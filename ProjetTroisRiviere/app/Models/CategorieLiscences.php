<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieLiscences extends Model
{
    use HasFactory;

    
    protected $primaryKey = 'numCategorie';

    protected $fillable = [
        'nom',
        'classe',
    ];

    protected $casts = [
        'numCategorie' => 'string'
    ];

    public function liscences()
    {
        return $this->belongsToMany(Liscences::class, 'specification_liscences','numCategorie','numLiscence');
    }
}
