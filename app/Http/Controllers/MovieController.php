<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'title');
        $order = $request->query('order', 'asc');

        $query = Movie::query();

        if ($sort === 'movie_title') {
            $query->orderBy('movie_title', $order);
        } elseif ($sort === 'release_date') {
            $query->orderBy('release_date', $order);
        } elseif ($sort === 'created_at') {
            $query->orderBy('created_at', $order);
        }

        $movies = $query->get();

        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        Movie::create($request->all());
        return redirect()->route('movies.index');
    }

    public function show(int $id)
    {
        $movie = Movie::findOrFail($id);
        $apiKey = env('TMDB_API_KEY');
        $tmdbId = $movie->tmdb_id;

        $response = Http::get("https://api.themoviedb.org/3/movie/{$tmdbId}?api_key={$apiKey}&language=en-US");
        if ($response->successful()) {
            $tmdbDetails = $response->json();
            $plot = $tmdbDetails['overview'] ?? 'No plot available.';
        } else {
            $plot = 'Failed to fetch plot.';
        }

        return view('movies.show', compact('movie', 'plot'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $apiKey = env('TMDB_API_KEY');
        $language = 'en-US';

        $url = "https://api.themoviedb.org/3/search/movie?api_key={$apiKey}&language={$language}&query=" . urlencode($query);

        $response = Http::get($url);

        $movies = $response->json()['results'] ?? [];
        $movieList = array_map(function ($movie) {
            return [
                'id' => $movie['id'],
                'title' => $movie['title'],
                'release_date' => $movie['release_date'] ? date('Y', strtotime($movie['release_date'])) : '',
                'poster_path' => $movie['poster_path'] ?? null
            ];
        }, $movies);

        return response()->json($movieList);
    }
}
