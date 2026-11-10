<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#681c36">
    <meta name="description" content="@yield('description', 'A birthday celebration created with love.')">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'A Birthday Made Just for You')">
    <meta property="og:description" content="@yield('description', 'A birthday celebration created with love.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary">
    <title>@yield('title', 'A Birthday Made Just for You') · A Birthday Made Just for You</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/birthday.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="ambient ambient-one"></div>
    <div class="ambient ambient-two"></div>
    <nav class="navbar navbar-expand-lg birthday-nav">
        <div class="container">
            <a class="navbar-brand brand-script" href="{{ route('home') }}">just for you <span>♡</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#birthdayNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="birthdayNav">
                <div class="navbar-nav ms-auto align-items-lg-center">
                    <a class="nav-link" href="{{ route('birthday.show') }}">The celebration</a>
                    <a class="nav-link" href="{{ route('birthday.section', 'memories') }}">Our memories</a>
                    <a class="nav-link" href="{{ route('birthday.section', 'love-letter') }}">My letter</a>
                    <button class="music-toggle ms-lg-3" type="button" id="musicToggle" aria-pressed="false">♫ <span>Music off</span></button>
                </div>
            </div>
        </div>
    </nav>

    <main>@yield('content')</main>

    <footer class="birthday-footer">
        <div class="container text-center">
            <div class="footer-heart">♡</div>
            <p>Made with love, just for you.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/birthday.js') }}"></script>
    @stack('scripts')
</body>
</html>
