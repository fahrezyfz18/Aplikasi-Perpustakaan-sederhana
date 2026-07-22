<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan Sederhana</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="card shadow-sm p-4" style="width: 100%; max-width: 380px; border-radius: 12px;">
        <div class="text-center mb-3">
            <h4 class="fw-bold">Login Perpustakaan</h4>
            <p class="text-muted small">Masuk sebagai Admin atau Anggota</p>
        </div>

        <!-- Alert jika ada error -->
        @if(session('error'))
            <div class="alert alert-danger p-2 small">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="admin@gmail.com / anggota@gmail.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="admin123/anggota123" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">Masuk</button>
        </form>
    </div>

</body>
</html>