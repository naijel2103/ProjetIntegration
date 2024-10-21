<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificationLiscences extends Model
{
    use HasFactory;

    
    public $timestamps = false;

    protected $primaryKey = 'idSpecification';

    protected $fillable = [
        'numLiscence',
        'numCategorie'
    ];

    public function liscence()
    {
        return $this->belongsTo(Liscences::class, 'numLiscence');
    }

    public function categorieLiscences()
    {
        return $this->belongsTo(CategorieLiscences::class, 'numCategorie');
    }
}
