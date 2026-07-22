<!-- POP-UP MODAL EDIT BUKU -->
<div class="modal fade" id="modalEditBuku{{ $b->idBuku }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $b->idBuku }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header card-header-navy">
                <h5 class="modal-title fw-bold fs-6" id="modalEditLabel{{ $b->idBuku }}">
                    <i class="bi bi-pencil-square me-1"></i> Edit Buku #{{ $b->idBuku }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('buku.update', $b->idBuku) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body p-4 bg-white text-start">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Judul Buku</label>
                        <input type="text" name="judul" class="form-control" value="{{ $b->judul }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Penulis</label>
                        <input type="text" name="penulis" class="form-control" value="{{ $b->penulis }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Kategori</label>
                        <select name="idKategori" class="form-select" required>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->idKategori }}" {{ $b->idKategori == $k->idKategori ? 'selected' : '' }}>
                                    {{ $k->namaKategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Tersedia" {{ $b->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="Dipinjam" {{ $b->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <!-- Batal Merah -->
                    <button type="button" class="btn btn-danger btn-sm fw-semibold px-3 shadow-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Batal
                    </button>
                    <!-- Simpan Hijau -->
                    <button type="submit" class="btn btn-success btn-sm fw-semibold px-3 shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>