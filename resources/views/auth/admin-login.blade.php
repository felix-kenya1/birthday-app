<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin sign in</title>
    <link rel="stylesheet" href="{{ asset('assets/css/birthday.css') }}">
</head>
<body>
<main class="section-shell">
    <div class="container" style="max-width: 520px; padding-top: 8vh">
        <div class="card p-4">
            <p class="text-uppercase">Private area</p>
            <h1>Admin sign in</h1>
            @if (session('status'))
                <p>{{ session('status') }}</p>
            @endif
            @if ($errors->any())
                <div role="alert">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf
                <label for="email">Email</label>
                <input class="form-control mb-3" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                <label for="password">Password</label>
                <input class="form-control mb-3" id="password" name="password" type="password" required autocomplete="current-password">
                <label><input type="checkbox" name="remember" value="1"> Remember me</label>
                <button class="btn btn-dark w-100 mt-3" type="submit">Sign in securely</button>
            </form>
            <p class="mt-3"><a href="{{ route('birthday.show') }}">Return to birthday page</a></p>
        </div>
    </div>
</main>
</body>
</html>
