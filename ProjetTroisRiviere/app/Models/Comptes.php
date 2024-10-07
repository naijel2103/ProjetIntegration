<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Comptes extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

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