<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'year',
        'country_id',
        'director_id',
        'poster_path'
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
        return $this->belongsToMany(Artist::class)->withPivot('role_name');
    }
}
