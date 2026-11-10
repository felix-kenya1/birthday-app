<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin sign in · Birthday Surprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/birthday.css') }}" rel="stylesheet">
</head>
<body class="admin-page">
    <main class="admin-login-card">
        <div class="script-accent">A private space</div>
        <h1>Welcome back</h1>
        <p class="text-muted">The birthday experience management area.</p>
        <div class="alert alert-info">Phase 1 foundation only. Secure administrator authentication and password management will be implemented and tested in Phase 4.</div>
        <a href="{{ route('home') }}" class="btn btn-outline-rose w-100">Return to birthday website</a>
    </main>
</body>
</html>
