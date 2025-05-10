<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'title',
        'year',
        'country_id',
        'director_id',
        'poster_path',
        'user_id'
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

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
