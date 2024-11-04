<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parametres extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'courrielAppro',
        'delaiRevision',
        'tailleFichiersMax',
        'courrielFinance',
    ];
}
