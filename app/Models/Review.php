<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['movie_id', 'title', 'text', 'publication_date', 'rating'];

    public function film()
    {
        return $this->belongsTo(Film::class, 'movie_id');
    }

    public function getStarRatingAttribute()
    {
        $rating = $this->rating;
        $fullStars = floor($rating);
        $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;
        $html = '';

        for ($i = 0; $i < $fullStars; $i++) {
            $html .= '<i class="fas fa-star"></i>';
        }
        if ($halfStar) {
            $html .= '<i class="fas fa-star-half-alt"></i>';
        }
        for ($i = 0; $i < $emptyStars; $i++) {
            $html .= '<i class="far fa-star"></i>';
        }

        return $html;
    }
}
