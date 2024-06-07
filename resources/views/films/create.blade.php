{{-- Ajouter un film --}}

@extends('layouts.app')

@section('content')
@include('components.error')
<div class="container">
    <h1>Add a film</h1>
    <p class="text-muted mb-4">Begin by typing the movie title below. Select from the dropdown to autofill the details.</p>

    <form class="d-flex flex-column" id="movie_form" action="{{ route('films.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tmdb_id" id="tmdb_id">
        <div class="d-flex flex-row" style="width: 100%; gap: 20px;">
            <div class="flex-grow-1 d-flex flex-column justify-content-between" style="flex-basis: 80%;">
                <div class="form-group position-relative">
                    <div class="input-group" id="search-input-wrapper">
                        <input type="text" id="movie_search" class="form-control" placeholder="Type in a title to autofill...">
                        <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
                <div id="movie_suggestions" class="movie-suggestions"></div>
            </div>
            <div>
                <div class="form-group">
                    <input type="text" class="mb-3 form-control" id="movie_title" name="movie_title" placeholder="Title" readonly>
                </div>
                <div class="form-group">
                    <input type="text" class="mb-3 form-control" id="director" name="director" placeholder="Director" readonly>
                </div>
                <div class="form-group">
                    <input type="text" class="mb-3 form-control" id="release_date" name="release_date" placeholder="Release year" readonly>
                </div>
            </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Add film</button>
            </div>
            <div class="flex-grow-1" style="flex-basis: 20%; display: flex; justify-content: flex-end; align-items: center;">
                <div class="form-group" style="height: 300px; width: 200px; margin-bottom: 0;">
                    <img id="poster" src="" alt="Poster" style="max-width: 200px; display: none;">
                    <input type="hidden" id="image_url" name="image_url" placeholder="Poster">
                </div>
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('movie_search.js') }}"></script>
@endsection