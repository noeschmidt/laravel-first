<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'name'
    ];

    public function artists()
    {
        return $this->hasMany(Artist::class);
    }
}
