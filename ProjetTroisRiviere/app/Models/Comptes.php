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
        'neq',
        'role',
        'code',
        'admin',
  
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
?>