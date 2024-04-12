{{-- Page d'accueil --}}
@extends('layouts.app')

@section('content')
<div id="banner" class="container-fluid px-0 overflow-hidden">
    <p><a href="/movies/3">Carol (2015)</a></p>
    <div class="bg-image">
        <div class="gradient-overlay">
        </div>
    </div>
</div>

<div class="d-flex flex-column align-items-center" style="gap: 20px">
    <div class="d-flex flex-column align-items-center mb-5" style="gap: 20px">
        <h2 class="text-center mb-0">The reference for LGBTQI+ films.<br>
            Contribute to the list. Give your opinion. <br>
            Discover your new favorite movie.</h2>
        <button type="button" class="btn btn-light"><a href="{{ route('movies.index') }}">See all movies</a></button>
    </div>

    <div class="d-flex flex-column align-items-center mb-5" style="gap: 20px">
        @if($latestMovies->count() > 0)
        <h2>Latest movies</h2>
        <div class="latest-movies d-flex flex-row align-items-center gap-5">
            @foreach($latestMovies as $movie)
            <div class="d-flex flex-column align-items-center mb-4">
                <a href="{{ route('movies.show', $movie->id) }}">
                    <img src="{{ $movie->image_url }}" alt="Movie poster" style="max-width: 200px; height: auto;">
                </a>
            </div>
            @endforeach
        </div>

        <div class="d-flex flex-row align-items-center" style="gap: 20px">
            <button type="button" class="btn btn-light"><a href="{{ route('movies.create') }}">Add a movie</a></button>
        </div>
        @endif
    </div>

    <div class="d-flex flex-column align-items-center mb-5">
        @if($latestRatings->count() > 0)
        <h2>Latest reviews</h2>
        <div id="ratingsCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($latestRatings as $index => $rating)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="carousel-caption">
                        <p><strong>{{ $rating->movie->movie_title }}</strong> — {{ $rating->formatted_rating }}/5</p>
                        <p><em>"{{ $rating->text }}"</em></p>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#ratingsCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">
                    << /span>
            </a>
            <a class="carousel-control-next" href="#ratingsCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">></span>
            </a>
        </div>
        <div class="d-flex flex-row align-items-center" style="gap: 20px">
            <button type="button" class="btn btn-light"><a href="{{ route('ratings.index') }}">See all reviews</a></button>
        </div>
        @endif
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.carousel').carousel();
    });
</script>

@endsection