<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        // Ici on va déclarer notre modèle pour pouvoir l'utiliser ailleurs
        'name', 'firstname', 'birthdate'
    ];
}
