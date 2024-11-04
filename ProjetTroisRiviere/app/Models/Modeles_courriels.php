<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modeles_courriels extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idModele';

    protected $fillable = [
        'nom',
        'objet',
        'message',
    ];
}
