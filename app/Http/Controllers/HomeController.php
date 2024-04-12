<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $latestFilms = Film::orderBy('created_at', 'desc')->take(3)->get();
        $latestReviews = Review::with('film')->latest()->take(3)->get();

        return view('welcome', compact('latestFilms', 'latestReviews'));
    }
}
