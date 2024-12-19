<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'age', 'biodata', 'avatar'];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'cast_movies');
    }
}
