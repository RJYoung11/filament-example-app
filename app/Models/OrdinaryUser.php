<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class OrdinaryUser extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'fullname', 'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];
}
