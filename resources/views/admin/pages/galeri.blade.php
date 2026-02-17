@include('admin.layouts.header')
@include('admin.layouts.menu')
<style>
    .ukuran-box {
        border: 2px solid #dee2e6;
        border-radius: 6px;
        padding: 8px 18px;
        cursor: pointer;
        font-weight: 500;
        transition: all .2s ease;
        background: #fff;
    }

    .ukuran-box input {
        display: none;
    }

    .ukuran-box:hover {
        border-color: #28a745;
        background: #eafaf0;
    }

    .ukuran-box input:checked+span {
        color: #155724;
        font-weight: 600;
    }

    .ukuran-box:has(input:checked) {
        border-color: #28a745;
        background: #28a745;
        color: #fff;
    }

    .ukuran-box:has(input:checked):hover {
        background: #218838;
        border-color: #1e7e34;
    }

    /* Gaya responsif tambahan */
    .img-thumbnail-sm {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #dee2e6;
    }

    .badge-custom {
        font-size: 0.85em;
        padding: 4px 10px;
    }

    .modal-lg-custom {
        max-width: 800px;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Gaya untuk tombol aksi di tabel */
    .btn-action-group {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .btn-action-group .btn {
        flex: 1;
        min-width: 70px;
        font-size: 0.85rem;
        padding: 4px 8px;
    }

    .filter-form .form-group {
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {
        .btn-action-group .btn {
            min-width: 60px;
            font-size: 0.8rem;
            padding: 3px 6px;
        }

        .img-thumbnail-sm {
            width: 50px;
            height: 50px;
        }

        .modal-dialog {
            margin: 10px;
        }

        .card-header h3 {
            font-size: 1.2rem;
        }

        .content-header h1 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .btn-action-group {
            flex-direction: column;
        }

        .btn-action-group .btn {
            width: 100%;
        }

        .img-thumbnail-sm {
            width: 40px;
            height: 40px;
        }

        .badge-custom {
            font-size: 0.75em;
            padding: 3px 6px;
        }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}'
        });
    </script>
@endif

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Galeri</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahLapangan">
                        <i class="fas fa-plus"></i> Tambah Galeri
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Manajemen Galeri</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th width="40">#</th>
                                    <th width="120">Gambar</th>
                                    <th width="150" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($galeri as $g)
                                    <tr>
                                        <td>{{ ($galeri->currentPage() - 1) * $galeri->perPage() + $loop->iteration }}
                                        </td>
                                        <td>
                                            @if($g->gambar)
                                                <img src="{{ asset('storage/' . $g->gambar) }}" class="img-thumbnail-sm"
                                                    alt="Gambar">
                                            @else
                                                <div
                                                    class="img-thumbnail-sm bg-light d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-action-group">
                                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $g->id }}" title="Edit">
                                                    <i class="fas fa-edit"></i> <span class="d-none d-md-inline">Edit</span>
                                                </button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#hapus{{ $g->id }}" title="Hapus">
                                                    <i class="fas fa-trash"></i> <span
                                                        class="d-none d-md-inline">Hapus</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-image fa-2x mb-3"></i>
                                                <p>Tidak ada Gambar ditemukan</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($galeri->hasPages())
                        <div class="mt-3">
                            {{ $galeri->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="tambahLapangan">
    <div class="modal-dialog modal-lg-custom">
        <div class="modal-content">
            <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus"></i> Tambah Galeri Baru
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label>Gambar</label>
                            <div class="custom-file">
                                <input type="file" name="gambar" class="custom-file-input" id="gambarInput"
                                    accept="image/*">
                                <label class="custom-file-label" for="gambarInput">Pilih file...</label>
                            </div>
                            <small class="text-muted">Format: JPG, PNG, JPEG (Maks: 2MB)</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($galeri as $g)
    <div class="modal fade" id="edit{{ $g->id }}">
        <div class="modal-dialog modal-lg-custom">
            <div class="modal-content">
                <form action="{{ route('galeri.update', $g->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">
                            <i class="fas fa-edit"></i> Edit Lapangan
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <div class="custom-file">
                                        <input type="file" name="gambar" class="custom-file-input"
                                            id="editGambar{{ $g->id }}">
                                        <label class="custom-file-label" for="editGambar{{ $g->id }}">Pilih file...</label>
                                    </div>
                                    @if($g->gambar)
                                        <div class="form-group">
                                            <label>Gambar Saat Ini</label>
                                            <div>
                                                <img src="{{ asset('storage/' . $g->gambar) }}" width="100"
                                                    class="img-thumbnail">
                                            </div>
                                        </div>
                                    @endif
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="hapus{{ $g->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('galeri.destroy', $g->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-trash"></i> Konfirmasi Hapus
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                        </div>
                        <p>Anda yakin ingin menghapus lapangan:</p>
                        <h5 class="text-danger font-weight-bold">{{ $g->nama }}</h5>
                        <p class="text-muted">Tindakan ini tidak dapat dibatalkan!</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Ya, Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script>
    document.querySelectorAll('.custom-file-input').forEach(function (input) {
        input.addEventListener('change', function (e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : "Pilih file...";
            var label = e.target.nextElementSibling;
            label.textContent = fileName;
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        var forms = document.querySelectorAll('form');
        forms.forEach(function (form) {
            form.addEventListener('submit', function (e) {
                var required = form.querySelectorAll('[required]');
                var valid = true;

                required.forEach(function (field) {
                    if (!field.value.trim()) {
                        valid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!valid) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Harap isi semua field yang wajib diisi!'
                    });
                }
            });
        });
    });
</script>