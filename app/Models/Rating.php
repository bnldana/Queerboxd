<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'title', 'text', 'publication_date', 'rating'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function getFormattedRatingAttribute()
    {
        $rating = floatval($this->rating);
        return is_float($rating) && floor($rating) != $rating ? $rating : number_format($rating, 0);
    }
}
