<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'tmdb_id', 'movie_title', 'director', 'release_date', 'image_url'
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
