<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        // Ici on va déclarer notre modèle pour pouvoir l'utiliser ailleurs
        'name',
        'firstname',
        'birthdate',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function hasDirected()
    {
        return $this->hasMany(Movie::class, 'director_id');
    }

    public function hasPlayed()
    {
        return $this->belongsToMany(Movie::class)->withPivot('role_name');
    }
}
