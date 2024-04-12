<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Queerboxd</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
</head>

<body class="bg-dark" id="{{ $bodyId }}">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
            <a class="navbar-brand" href="http://85.215.133.227/">Queerboxd</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link" href="/movies">Movies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ratings">Reviews</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="px-4 d-flex flex-column align-items-center">
        <div id="content-wrap">
            @yield('content')
        </div>
    </main>

    <footer class="text-muted py-4 bg-dark ">
        <div class="container d-flex justify-content-md-center">
            <p>© 2024 Queerboxd, inspired by <a href="https://letterboxd.com/">Letterboxd</a>. All rights reserved to their respective owners.</p>
        </div>
    </footer>

    <script src="{{ asset('script.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>