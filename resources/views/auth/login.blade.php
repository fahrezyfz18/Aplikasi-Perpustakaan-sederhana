<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan</title>
    
    <!-- CDN Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Custom Warna Biru Soft & Elegan */
        :root {
            --brand-color: #4f46e5;       /* Biru Indigo yang adem di mata */
            --brand-hover: #4338ca;       /* Warna tombol saat di-hover */
            --bg-accent: #e0e7ff;         /* Warna aksen icon lembut */
        }

        body {
            background-color: #f8fafc;    /* Background agak keabuan/soft */
        }

        /* Styling Tombol Primary Custom */
        .btn-brand {
            background-color: var(--brand-color);
            color: #ffffff;
            border: none;
            transition: all 0.2s ease-in-out;
        }

        .btn-brand:hover {
            background-color: var(--brand-hover);
            color: #ffffff;
        }

        /* Styling Icon Container */
        .icon-circle {
            background-color: var(--bg-accent);
            color: var(--brand-color);
        }

        /* Focus state input agar garisnya tidak menyilaukan */
        .form-control:focus {
            border-color: var(--brand-color);
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.15);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; margin: 0;">

    <!-- Card Login -->
    <div class="card shadow-sm border-0 overflow-hidden" style="width: 100%; max-width: 390px; border-radius: 16px;">
        <!-- Garis Aksen Warna Soft di Atas -->
        <div style="height: 5px; background: linear-gradient(90deg, #6366f1, #818cf8);"></div>
        
        <div class="card-body p-4">
            <div class="text-center mb-4">
                <!-- Icon dengan latar soft -->
                <div class="icon-circle d-inline-flex p-3 rounded-circle mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
                        <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                    </svg>
                </div>
                <h4 class="fw-bold text-dark mb-1">Selamat Datang</h4>
                <p class="text-muted small mb-0">Silakan masuk ke akun perpustakaan Anda</p>
            </div>

            <!-- Alert Error -->
            @if(session('error'))
                <div class="alert alert-danger p-2 small rounded-3">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form Login -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold text-secondary">Email</label>
                    <input type="email" name="email" class="form-control py-2 bg-light border-0" placeholder="admin@gmail.com / anggota@gmail.com" required>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-semibold text-secondary">Password</label>
                    <input type="password" name="password" class="form-control py-2 bg-light border-0" placeholder="admin123/anggota123" required>
                </div>

                <button type="submit" class="btn btn-brand w-100 fw-semibold py-2 rounded-3 shadow-sm">
                    Masuk 
                </button>
            </form>
        </div>
    </div>

    <!-- CDN Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>