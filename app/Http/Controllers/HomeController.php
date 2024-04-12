<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;

class HomeController extends Controller
{
    public function index()
    {
        $latestMovies = Movie::orderBy('created_at', 'desc')->take(3)->get();
        $latestRatings = Rating::with('movie')->latest()->take(3)->get();

        return view('welcome', compact('latestMovies', 'latestRatings'));
    }
}
