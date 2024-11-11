<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infotels extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = 'idInfoTel';

    protected $fillable = [
        'typeTel',
        'numTel',
        'postTel',
        'fournisseur',
        'contact',
    ];


    public function fournisseur()
    {
        return $this->belongsTo(Fournisseurs::class, 'fournisseur', 'idFournisseur');
    }
    public function contact()
    {
        return $this->belongsTo(Contacts::class, 'contact', 'idContact');
    }
}
