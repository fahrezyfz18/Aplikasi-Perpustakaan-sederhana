<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --navy-dark: #0f172a;
            --navy-primary: #1e293b;
            --blue-accent: #2563eb;
            --teal-accent: #0d9488;
        }
        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #0f172a;
        }
        .navbar-navy {
            background-color: var(--navy-dark);
            border-bottom: 3px solid var(--blue-accent);
        }
        .btn-teal {
            background-color: var(--teal-accent);
            color: #ffffff;
            border: none;
        }
        .btn-teal:hover {
            background-color: #0f766e;
            color: #ffffff;
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.06);
        }
        .card-header-navy {
            background-color: var(--navy-primary);
            color: #ffffff;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }
        .table-custom td, .table-custom th {
            color: #0f172a !important;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-navy py-2 shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-5" href="{{ route('dashboard') }}">
                <i class="bi bi-journal-bookmark-fill text-warning fs-4"></i>
                <span>E-Pustaka <span class="text-primary fs-6 fw-normal">| Digital Library</span></span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm fw-semibold d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h2 class="fw-bold text-dark mb-1">Kelola Data Kategori</h2>
                <p class="text-secondary fs-6 m-0">Tambah, ubah, dan hapus master kategori buku perpustakaan.</p>
            </div>
            <!-- Trigger Modal Create -->
            <button type="button" class="btn btn-teal px-3 py-2 fw-semibold shadow-sm d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                <i class="bi bi-plus-lg fs-6"></i> Tambah Kategori Baru
            </button>
        </div>

        <!-- Alert Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Card Tabel -->
        <div class="card card-custom overflow-hidden mb-4">
            <div class="card-header card-header-navy py-3 d-flex align-items-center gap-2">
                <i class="bi bi-tags-fill fs-5"></i>
                <h6 class="fw-bold m-0 fs-6">Daftar Seluruh Kategori</h6>
            </div>

            <div class="table-responsive p-3 bg-white">
                <table class="table table-hover align-middle table-custom m-0">
                    <thead class="table-light">
                        <tr class="fw-bold text-dark">
                            <th width="8%">No</th>
                            <th>Nama Kategori</th>
                            <th class="text-center" width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($kategoris as $index => $k)
                        <tr>
                            <td class="fw-bold text-dark">{{ $index + 1 }}</td>
                            <td class="fw-bold text-dark fs-6">{{ $k->namaKategori }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Trigger Modal Edit -->
                                    <button type="button" class="btn btn-warning btn-sm fw-semibold shadow-sm d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modalEditKategori{{ $k->idKategori }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>

                                    <!-- Form Hapus -->
                                    <form action="{{ route('kategori.destroy', $k->idKategori) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm fw-semibold shadow-sm d-flex align-items-center gap-1">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Include Modal Edit Per Kategori -->
                        @include('kategori.edit', ['k' => $k])

                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">
                                <i class="bi bi-tags fs-1 text-secondary opacity-75 d-block mb-2"></i>
                                <span class="text-secondary fw-semibold">Belum ada data kategori tersimpan.</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include Modal Create -->
    @include('kategori.create')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>