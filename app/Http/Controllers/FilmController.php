<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'movie_title');
        $order = $request->query('order', 'asc');

        $query = Film::query();

        if ($sort === 'release_date') {
            $query->orderBy('release_date', $order);
        } elseif ($sort === 'movie_title') {
            $query->orderBy('movie_title', $order);
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
        $validatedData = $request->validate([
            'tmdb_id' => 'required',
            'movie_title' => 'required',
            'director' => 'required',
            'release_date' => 'required',
            'image_url' => 'required|url'
        ]);

        $existingFilm = Film::where('tmdb_id', $validatedData['tmdb_id'])->first();
        if ($existingFilm) {
            return redirect()->back()->withErrors(['tmdb_id' => 'This film has already been added! <a href="' . route('films.show', $existingFilm->id) . '" class="alert-link">See film page<i class="fas fa-chevron-right"></i></a>'])->withInput();
        }

        $film = Film::create($validatedData);
        return redirect()->route('films.show', $film->id)
            ->with('success', 'Film added successfully! <a href="' . route('films.create') . '" class="alert-link">Add another film<i class="fas fa-chevron-right"></i></a>');
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
            $originalTitle = $tmdbDetails['original_title'] ?? 'No original title available.';

            $backdropPath = $tmdbDetails['backdrop_path'] ?? null;
            $backdropUrl = $backdropPath ? 'https://image.tmdb.org/t/p/original' . $backdropPath : null;
        } else {
            $plot = 'Failed to fetch plot.';
            $originalTitle = 'No original title available.';
            $backdropUrl = null;
        }

        return view('films.show', compact('film', 'plot', 'backdropUrl', 'originalTitle'));
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
