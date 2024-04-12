document.addEventListener('DOMContentLoaded', function () {
    const movieSearchInput = document.getElementById('movie_search');
    const movieSuggestionsContainer = document.getElementById('movie_suggestions');
    const titleInput = document.getElementById('movie_title');
    const directorInput = document.getElementById('director');
    const releaseDateInput = document.getElementById('release_date');
    const posterImage = document.getElementById('poster');
    const imageUrlInput = document.getElementById('image_url');
    const tmdbIdInput = document.getElementById('tmdb_id');
    const apiKey = '3908af2e11750b73394c5fea9b1a6202';

    async function fetchMovieDetails(movieId) {
        const response = await fetch(`https://api.themoviedb.org/3/movie/${movieId}?api_key=${apiKey}&language=en-US`);
        return await response.json();
    }

    async function fetchMovieCredits(movieId) {
        const response = await fetch(`https://api.themoviedb.org/3/movie/${movieId}/credits?api_key=${apiKey}`);
        return await response.json();
    }

    async function handleMovieSelection(movie) {
        let details, credits;

        const cachedDetails = localStorage.getItem(`movie_${movie.id}_details`);
        const cachedCredits = localStorage.getItem(`movie_${movie.id}_credits`);

        if (cachedDetails && cachedCredits) {
            details = JSON.parse(cachedDetails);
            credits = JSON.parse(cachedCredits);
        } else {
            [details, credits] = await Promise.all([
                fetchMovieDetails(movie.id),
                fetchMovieCredits(movie.id)
            ]);

            localStorage.setItem(`movie_${movie.id}_details`, JSON.stringify(details));
            localStorage.setItem(`movie_${movie.id}_credits`, JSON.stringify(credits));
        }

        const director = credits.crew.find(member => member.job === 'Director');
        const directorName = director ? director.name : '';

        titleInput.value = movie.title;
        directorInput.value = directorName;
        releaseDateInput.value = details.release_date ? details.release_date.substring(0, 4) : '';
        posterImage.src = movie.poster_path ? `https://image.tmdb.org/t/p/w780${movie.poster_path}` : '';
        posterImage.style.display = movie.poster_path ? 'block' : 'none';
        tmdbIdInput.value = movie.id || '';
        imageUrlInput.value = posterImage.src;

        movieSuggestionsContainer.style.display = 'none';
    }

    function renderMovieSuggestions(movies) {
        if (movies.length === 0) {
            movieSuggestionsContainer.style.display = 'none';
            return;
        }
    
        movieSuggestionsContainer.innerHTML = '';
        movies.forEach(movie => {
            const suggestion = document.createElement('div');
            suggestion.classList.add('movie-suggestion');
            
            const poster = document.createElement('img');
            poster.src = movie.poster_path ? `https://image.tmdb.org/t/p/w92${movie.poster_path}` : '';
            poster.alt = 'Movie Poster';
            suggestion.appendChild(poster);
            
            const title = document.createElement('span');
            title.textContent = movie.title;
            suggestion.appendChild(title);
    
            suggestion.addEventListener('click', async () => await handleMovieSelection(movie));
            movieSuggestionsContainer.appendChild(suggestion);
        });
    
        movieSuggestionsContainer.style.display = 'block';
    }
    
    movieSearchInput.addEventListener('input', async function (event) {
        const query = event.target.value.trim();
        if (query.length === 0) {
            movieSuggestionsContainer.innerHTML = '';
            movieSuggestionsContainer.style.display = 'none'; 
        } else {
            const response = await fetch('/tmdb-search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ query })
            });
            const movies = await response.json();
            renderMovieSuggestions(movies);
        }
    });
    
    document.addEventListener('click', function(event) {
        const withinBoundaries = event.composedPath().includes(movieSearchInput) || event.composedPath().includes(movieSuggestionsContainer);
        
        if (!withinBoundaries) {
            movieSuggestionsContainer.style.display = 'none';
            movieSuggestionsContainer.innerHTML = '';
        }
    });
});