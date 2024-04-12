{{-- Ajouter un avis --}}
@extends('layouts.app')

@section('content')
<h1>Add a review for {{ $film->movie_title }}</h1>
<form class="w-50 d-flex flex-column" action="{{ route('reviews.store') }}" method="POST">
    @csrf
    <input type="hidden" name="movie_id" value="{{ request('movie_id') }}">

    <label class="mb-0" for="title">Title</label>
    <input class="mb-3 form-control" type="text" name="title" id="title" required>

    <label class="mb-0" for="text">Review</label>
    <textarea class="mb-3 form-control" name="text" id="text" required></textarea>

    <label class="mb-0" for="rating">Rating</label>
    <select class="mb-3 form-control" name="rating" id="rating">
        @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }}</option>
            @if ($i < 5) <option value="{{ $i + 0.5 }}">{{ $i + 0.5 }}</option> @endif
                @endfor
    </select>

    <button type="submit" class="btn btn-light my-3">Add review</button>
</form>
@endsection