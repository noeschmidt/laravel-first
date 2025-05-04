<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cinema extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $table = 'cinema';
    protected $fillable = [
        'name',
        'address',
        'poster_path'
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
