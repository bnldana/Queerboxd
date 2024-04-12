<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Movie;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::with('movie')->get();
        return view('ratings.index', compact('ratings'));
    }

    public function create(Request $request)
    {
        $movie = null;
        if ($request->has('movie_id')) {
            $movie = Movie::findOrFail($request->movie_id);
        }

        $movies = Movie::all();

        return view('ratings.create', compact('movie', 'movies'));
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['publication_date'] = $request->input('publication_date', now()->format('Y-m-d'));

        Rating::create($requestData);

        return redirect()->route('ratings.index');
    }
}
