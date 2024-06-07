{{-- Liste des films --}}
@extends('layouts.app')

@section('content')
<div id="review-title" class="d-flex flex-row justify-content-between mb-4">
    <div class="d-flex flew-row align-items-end mb-2" style="gap: 5px;">
        <p class="text-uppercase mb-0 d-none d-md-block">SORT BY</p>
        <!-- Desktop -->
        <div class="d-none d-md-block">
            <a class="text-uppercase mb-0" href="{{ route('films.index', ['sort' => 'movie_title', 'order' => 'asc']) }}">Title (A-Z)</a> |
            <a class="text-uppercase mb-0" href="{{ route('films.index', ['sort' => 'movie_title', 'order' => 'desc']) }}">Title (Z-A)</a> |
            <a class="text-uppercase mb-0" href="{{ route('films.index', ['sort' => 'release_date', 'order' => 'asc']) }}">Year (asc)</a> |
            <a class="text-uppercase mb-0" href="{{ route('films.index', ['sort' => 'release_date', 'order' => 'desc']) }}">Year (desc)</a>
        </div>
        <!-- Mobile -->
        <select class="form-control d-md-none" onchange="location = this.value;">
            <option value="">Sort by</option>
            <option value="{{ route('films.index', ['sort' => 'movie_title', 'order' => 'asc']) }}">Title (A-Z)</option>
            <option value="{{ route('films.index', ['sort' => 'movie_title', 'order' => 'desc']) }}">Title (Z-A)</option>
            <option value="{{ route('films.index', ['sort' => 'release_date', 'order' => 'asc']) }}">Year (asc)</option>
            <option value="{{ route('films.index', ['sort' => 'release_date', 'order' => 'desc']) }}">Year (desc)</option>
        </select>
    </div>
    <button type="button" class="btn btn-light mb-2">
        <a href="{{ route('films.create') }}">
            <span class="d-none d-md-inline" style="color: white !important">Add a film</span>
            <i class="fas fa-plus d-md-none" style="color: white !important"></i>
        </a>
    </button>
</div>


<div class="container p-0">
    <div class="row ml-0 mr-0">
        @foreach($films as $film)
        <div class="col-md-3 p-0 movie-container">
            <div class="movie-wrapper" style="background-image: url('{{ $film->image_url }}');">
                <a href="{{ route('films.show', $film->id) }}">
                    <span class="overlay"></span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection