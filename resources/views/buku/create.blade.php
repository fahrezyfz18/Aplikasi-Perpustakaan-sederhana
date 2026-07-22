<div class="modal fade" id="modalTambahBuku" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header card-header-navy">
                <h5 class="modal-title fw-bold fs-6">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Buku Baru
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('buku.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4 bg-white">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Judul Buku</label>
                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Penulis</label>
                        <input type="text" name="penulis" class="form-control" placeholder="Nama penulis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Kategori</label>
                        <select name="idKategori" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->idKategori }}">{{ $k->namaKategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <!-- Tombol Batal Warna Merah -->
                    <button type="button" class="btn btn-danger btn-sm fw-semibold px-3 shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </button>
                    <!-- Tombol Simpan Warna Hijau -->
                    <button type="submit" class="btn btn-success btn-sm fw-semibold px-3 shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>