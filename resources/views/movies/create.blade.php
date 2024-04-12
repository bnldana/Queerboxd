{{-- Ajouter un film --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add a movie</h1>

    <form class="d-flex flex-column" id="movie_form" style="display:none;" action="{{ route('movies.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tmdb_id" id="tmdb_id">
        <div class="form-group">
            <input type="text" id="movie_search" class="form-control" placeholder="Write a movie title to autofill the form">
            <div id="movie_suggestions"></div>
        </div>
        <div class="d-flex flex-row" style="width: 100%;">
            <div class="flex-grow-1" style="flex-basis: 70%;">
                <div class="form-group">
                    <label class="mb-0" for="title">Title</label>
                    <input type="text" class="mb-3 form-control" id="movie_title" name="movie_title">
                </div>
                <div class="form-group">
                    <label class="mb-0" for="director">Director</label>
                    <input type="text" class="mb-3 form-control" id="director" name="director">
                </div>
                <div class="form-group">
                    <label class="mb-0" for="release_date">Release year</label>
                    <input type="text" class="mb-3 form-control" id="release_date" name="release_date">
                </div>
                <button type="submit" class="btn btn-primary">Add movie</button>
            </div>
            <div class="flex-grow-1" style="flex-basis: 30%; display: flex; justify-content: center; align-items: center;">
                <div class="form-group">
                    <img id="poster" src="" alt="Poster" style="max-width: 200px; display: none;">
                    <input type="hidden" id="image_url" name="image_url">
                </div>
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('movie_search.js') }}"></script>
@endsection