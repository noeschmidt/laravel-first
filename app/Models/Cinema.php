<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cinema extends Model
{
    use SoftDeletes;
    
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

}
