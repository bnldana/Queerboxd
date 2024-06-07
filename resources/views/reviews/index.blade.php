{{-- Liste des avis --}}
@extends('layouts.app')

@section('content')
<div class="d-flex flex-column align-items-start w-100" style="gap: 20px;">
    @php
    $randomKeys = $reviews->pluck('id')->random(min(3, $reviews->count()))->all();
    $additionalReviewsCount = $reviews->count() - count($randomKeys);
    @endphp

    {{-- Afficher les avis aléatoires --}}
    @foreach($reviews as $review)
    @if(in_array($review->id, $randomKeys))
    @include('components.review', ['review' => $review])
    @endif
    @endforeach

    @if($additionalReviewsCount > 0)
    <button id="showAllRatings" type="button" class="btn btn-light">
        <p class="mb-0">Show {{ $additionalReviewsCount }} additional reviews</p>
    </button>
    @endif

    <div id="allRatings" style="display:none;">
        @foreach($reviews as $review)
        @if(!in_array($review->id, $randomKeys))
        @include('components.review', ['review' => $review])
        @endif
        @endforeach
    </div>
</div>

<script>
    var showAllRatingsButton = document.getElementById('showAllRatings');
    showAllRatingsButton.addEventListener('click', function() {
        var allRatings = document.getElementById('allRatings');
        allRatings.style.display = 'block';
        allRatings.style.gap = '20px';
        allRatings.classList.add('d-flex', 'flex-column', 'align-items-start', 'w-100');
        this.style.display = 'none';
    });
</script>
@endsection