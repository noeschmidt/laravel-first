<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'year'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function director()
    {
        return $this->belongsTo(Artist::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Artist::class);
    }
}
