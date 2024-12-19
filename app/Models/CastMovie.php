<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CastMovie extends Model
{
    use HasFactory;

    protected $table = 'cast_movies'; // Nama tabel pivot
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['movie_id', 'cast_id'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function cast()
    {
        return $this->belongsTo(Cast::class);
    }
}
