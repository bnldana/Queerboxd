<div class="rating d-flex flex-row w-100 pb-3" style="gap: 20px;">
    <div class="d-flex align-items-center">
        <div class="movie-wrapper" style="background-image: url('{{ $review->film->image_url }}'); width: 74px; height: 109px;">
            <a href="{{ route('films.show', $review->film->id) }}">
                <span class="overlay"></span>
            </a>
        </div>
    </div>
    <div class="d-flex flex-column" style="gap: 5px;">
        <div class="d-flex flex-row align-items-center" style="gap: 5px;">
            <h2 class="rating-movie-title mb-0">
                <a href="{{ route('films.show', $review->film->id) }}">
                    {{ $review->film->movie_title }}
                </a>
            </h2>
            <p class="mt-3 mb-0">{{ $review->film->release_date }}</p>
        </div>
        <div class="d-flex flex-row align-items-center" style="gap: 5px;">
            <div class="star-rating" style="color: #00c030; font-size: 0.75em;">
                {!! $review->starRating !!}
            </div>
            <p class="mb-0 text-uppercase" style="font-size: .7em;">{{ \Carbon\Carbon::parse($review->publication_date)->toFormattedDateString() }}</p>
        </div>
        <p class="rating-text">{{ $review->text }}</p>
    </div>
</div>