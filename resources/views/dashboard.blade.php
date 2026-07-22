<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Perpustakaan Digital</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --navy-dark: #0f172a;
            --navy-primary: #1e293b;
            --blue-accent: #2563eb;
            --teal-accent: #0d9488;
            --indigo-accent: #4f46e5;
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #0f172a;
        }

        /* Navbar Navy Custom */
        .navbar-navy {
            background-color: var(--navy-dark);
            border-bottom: 3px solid var(--blue-accent);
        }

        /* Custom Buttons Kontras */
        .btn-teal {
            background-color: var(--teal-accent);
            color: #ffffff;
            border: none;
        }
        .btn-teal:hover {
            background-color: #0f766e;
            color: #ffffff;
        }

        .btn-indigo {
            background-color: var(--indigo-accent);
            color: #ffffff;
            border: none;
        }
        .btn-indigo:hover {
            background-color: #4338ca;
            color: #ffffff;
        }

        /* Card Custom Styling */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.06), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .card-header-navy {
            background-color: var(--navy-primary);
            color: #ffffff;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }

        /* Stat Cards Border Accents & Sizing */
        .stat-card-blue {
            border-left: 5px solid #2563eb;
        }
        .stat-card-info {
            border-left: 5px solid #0891b2;
        }
        .stat-card-success {
            border-left: 5px solid #16a34a;
        }

        /* Tabel Styling Teks Jelas */
        .table-custom td, .table-custom th {
            color: #0f172a !important;
            font-weight: 500;
        }
        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body>

    <!-- Navbar Utama -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-navy py-2 shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-5" href="{{ route('dashboard') }}">
                <i class="bi bi-journal-bookmark-fill text-warning fs-4"></i>
                <span>E-Pustaka <span class="text-primary fs-6 fw-normal">| Digital Library</span></span>
            </a>

            <div class="d-flex align-items-center gap-3">
                <div class="text-white small d-none d-md-block text-end">
                    <span class="d-block fw-semibold">{{ auth()->user()->name ?? 'User' }}</span>
                    <span class="badge bg-primary text-uppercase" style="font-size: 10px;">
                        {{ auth()->user()->role ?? 'anggota' }}
                    </span>
                </div>

                <!-- Tombol Logout Merah Bold -->
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center gap-1 fw-bold px-3 shadow-sm">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container my-4">

        <!-- Baris Header Judul & Kata Sambutan (Proporsional) -->
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4 gap-3">
            <div>
                <!-- Judul Proporsional Seimbang dengan Card Statik -->
                <h2 class="fw-bold text-dark mb-1">Dashboard Utama</h2>
                <!-- Kata Sambutan Teks Biasa (Tanpa Card) -->
                <p class="text-secondary fs-6 m-0">
                    Selamat datang kembali, <strong class="text-dark">{{ auth()->user()->name ?? 'Admin' }}</strong>! Berikut adalah ringkasan aktivitas perpustakaan hari ini.
                </p>
            </div>

            @if(auth()->user()->role === 'admin')
            <div class="d-flex flex-wrap gap-2">
                <!-- Tombol Kelola Buku -->
                <a href="{{ route('buku.index') }}" class="btn btn-primary px-3 py-2 fw-semibold shadow-sm d-flex align-items-center gap-2">
                    <i class="bi bi-list-ul"></i> Kelola Buku
                </a>

                <!-- Tombol Kelola Kategori (Hijau Toska / Teal) -->
                <a href="{{ route('kategori.index') }}" class="btn btn-teal px-3 py-2 fw-semibold shadow-sm d-flex align-items-center gap-2">
                    <i class="bi bi-tags-fill"></i> Kelola Kategori
                </a>

                <!-- Tombol Tambah Buku (Warna Indigo/Purple menggantikan Hitam) -->
                <button type="button" class="btn btn-indigo px-3 py-2 fw-semibold shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambahBuku">
                    <i class="bi bi-plus-lg"></i> Tambah Buku
                </button>
            </div>
            @endif
        </div>

        <!-- Alert Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Card Statistik Sejajar dan Proporsional -->
        <div class="row row-cols-1 row-cols-md-3 g-3 mb-4">
            <div class="col">
                <div class="card card-custom p-3 bg-white stat-card-blue h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-uppercase fw-bold text-muted small">Total Koleksi Buku</span>
                            <h3 class="fw-bold text-primary m-0 mt-1">{{ $bukus->count() ?? 0 }}</h3>
                        </div>
                        <div class="p-3 bg-primary bg-opacity-10 rounded-circle text-primary">
                            <i class="bi bi-book-half fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card card-custom p-3 bg-white stat-card-info h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-uppercase fw-bold text-muted small">Total Kategori</span>
                            <h3 class="fw-bold text-info m-0 mt-1">{{ isset($kategoris) ? $kategoris->count() : 0 }}</h3>
                        </div>
                        <div class="p-3 bg-info bg-opacity-10 rounded-circle text-info">
                            <i class="bi bi-tags-fill fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card card-custom p-3 bg-white stat-card-success h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-uppercase fw-bold text-muted small">Total Peminjaman</span>
                            <h3 class="fw-bold text-success m-0 mt-1">{{ $peminjamans->count() ?? 0 }}</h3>
                        </div>
                        <div class="p-3 bg-success bg-opacity-10 rounded-circle text-success">
                            <i class="bi bi-receipt-cutoff fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL DAFTAR BUKU TERSEDIA -->
        <div class="card card-custom mb-4 overflow-hidden">
            <div class="card-header card-header-navy py-3 d-flex align-items-center gap-2">
                <i class="bi bi-journal-bookmark fs-5"></i>
                <h6 class="fw-bold m-0 fs-6">Daftar Buku Tersedia</h6>
            </div>

            <div class="table-responsive p-3 bg-white">
                <table class="table table-hover align-middle table-custom m-0">
                    <thead class="table-light">
                        <tr class="fw-bold text-dark">
                            <th width="5%">No</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($bukus as $index => $b)
                        <tr>
                            <td class="fw-bold text-dark">{{ $index + 1 }}</td>
                            <td class="fw-bold text-dark">{{ $b->judul }}</td>
                            <td class="fw-semibold text-dark">{{ $b->penulis }}</td>
                            <td>
                                <span class="badge bg-secondary fs-6 font-monospace">
                                    {{ $b->kategoriRelation->namaKategori ?? $b->kategori }}
                                </span>
                            </td>

                            <td>
                                @if($b->status == 'Tersedia' || $b->isTersedia())
                                    <span class="badge bg-success">Tersedia</span>
                                @elseif($b->status == 'Dipinjam')
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @elseif(in_array($b->status, ['Batal', 'Terlambat']))
                                    <span class="badge bg-danger">{{ $b->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $b->status }}</span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if(auth()->user()->role == 'anggota')
                                    @if($b->isTersedia())
                                        <form action="{{ route('buku.pinjam', $b->idBuku) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                                                <i class="bi bi-bookmark-plus"></i> Pinjam
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-light btn-sm text-muted rounded-pill px-3" disabled>
                                            Tidak Tersedia
                                        </button>
                                    @endif
                                @else
                                    <span class="badge bg-light text-dark border px-2 py-1">Admin Mode</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-dark py-4">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                                Belum ada data buku tersedia.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABEL DATA TRANSAKSI PEMINJAMAN -->
        <div class="card card-custom overflow-hidden">
            <div class="card-header card-header-navy py-3 d-flex align-items-center gap-2">
                <i class="bi bi-receipt fs-5"></i>
                <h6 class="fw-bold m-0 fs-6">Data Transaksi Peminjaman</h6>
            </div>

            <div class="table-responsive p-3 bg-white">
                <table class="table table-hover align-middle table-custom m-0">
                    <thead class="table-light">
                        <tr class="fw-bold text-dark">
                            <th>ID Pinjam</th>
                            <th>Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($peminjamans as $p)
                        <tr>
                            <td class="fw-bold text-primary">#{{ $p->idPinjam }}</td>
                            <td class="fw-semibold text-dark">{{ $p->user->name ?? 'Anggota' }}</td>
                            <td class="fw-bold text-dark">{{ $p->buku->judul ?? '-' }}</td>
                            <td class="fw-medium text-dark">{{ $p->tanggalPinjam }}</td>
                            <td class="fw-medium text-dark">{{ $p->tanggalKembali ?? '-' }}</td>

                            <td>
                                @if($p->status == 'Dipinjam')
                                    <span class="badge bg-warning text-dark">Dipinjam</span>
                                @elseif(in_array($p->status, ['Dikembalikan', 'Kembali', 'Selesai']))
                                    <span class="badge bg-success">Dikembalikan</span>
                                @elseif(in_array($p->status, ['Terlambat', 'Batal']))
                                    <span class="badge bg-danger">{{ $p->status }}</span>
                                @else
                                    <span class="badge bg-info text-dark">{{ $p->status }}</span>
                                @endif
                            </td>

                            <td class="fw-bold text-danger">
                                Rp {{ number_format($p->denda ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="text-center">
                                @if(auth()->user()->role == 'admin' && $p->status == 'Dipinjam')
                                    <form action="{{ route('buku.kembalikan', $p->idPinjam) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm rounded-pill px-3 shadow-sm" onclick="return confirm('Proses pengembalian buku ini?')">
                                            Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-dark font-monospace">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <!-- Tampilan Empty State Ketika Data Transaksi Belum Ada/Kosong dengan Icon -->
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="py-2">
                                    <i class="bi bi-folder-x fs-1 text-secondary opacity-75 d-block mb-2"></i>
                                    <span class="text-secondary fw-semibold">Belum ada riwayat data transaksi peminjaman.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal Tambah Buku -->
    @if(auth()->user()->role === 'admin')
        @include('buku.create', ['kategoris' => $kategoris ?? []])
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>