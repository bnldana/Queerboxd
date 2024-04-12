<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Film;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('film')->get();
        return view('reviews.index', compact('reviews'));
    }

    public function create(Request $request)
    {
        $film = null;
        if ($request->has('movie_id')) {
            $film = Film::findOrFail($request->movie_id);
        }

        $films = Film::all();

        return view('reviews.create', compact('film', 'films'));
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $requestData['publication_date'] = $request->input('publication_date', now()->format('Y-m-d'));

        Review::create($requestData);

        return redirect()->route('reviews.index');
    }
}
