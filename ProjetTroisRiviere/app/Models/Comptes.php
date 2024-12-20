<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Comptes extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'email',
        'role',
        'code',
        'admin',
        'verifier'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
?>