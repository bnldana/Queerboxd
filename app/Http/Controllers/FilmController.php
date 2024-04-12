<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'title');
        $order = $request->query('order', 'asc');

        $query = Film::query();

        if ($sort === 'movie_title') {
            $query->orderBy('movie_title', $order);
        } elseif ($sort === 'release_date') {
            $query->orderBy('release_date', $order);
        } elseif ($sort === 'created_at') {
            $query->orderBy('created_at', $order);
        }

        $films = $query->get();

        return view('films.index', compact('films'));
    }

    public function create()
    {
        return view('films.create');
    }

    public function store(Request $request)
    {
        Film::create($request->all());
        return redirect()->route('films.index');
    }

    public function show(int $id)
    {
        $film = Film::findOrFail($id);
        $apiKey = env('TMDB_API_KEY');
        $tmdbId = $film->tmdb_id;

        $response = Http::get("https://api.themoviedb.org/3/movie/{$tmdbId}?api_key={$apiKey}&language=en-US&append_to_response=images");

        if ($response->successful()) {
            $tmdbDetails = $response->json();
            $plot = $tmdbDetails['overview'] ?? 'No plot available.';

            $backdropPath = $tmdbDetails['backdrop_path'] ?? null;
            $backdropUrl = $backdropPath ? 'https://image.tmdb.org/t/p/original' . $backdropPath : null;
        } else {
            $plot = 'Failed to fetch plot.';
            $backdropUrl = null;
        }

        return view('films.show', compact('film', 'plot', 'backdropUrl'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $apiKey = env('TMDB_API_KEY');
        $language = 'en-US';

        $url = "https://api.themoviedb.org/3/search/movie?api_key={$apiKey}&language={$language}&query=" . urlencode($query);

        $response = Http::get($url);

        $films = $response->json()['results'] ?? [];
        $movieList = array_map(function ($film) {
            return [
                'id' => $film['id'],
                'title' => $film['title'],
                'release_date' => $film['release_date'] ? date('Y', strtotime($film['release_date'])) : '',
                'poster_path' => $film['poster_path'] ?? null
            ];
        }, $films);

        return response()->json($movieList);
    }
}
