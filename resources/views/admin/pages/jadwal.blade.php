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
                    <h1>Data Jadwal Operasional</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahJadwal">
                        <i class="fas fa-plus"></i> Tambah Jadwal
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Manajemen Jadwal Operasional</h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('jadwal.index') }}" class="mb-4 filter-form">
                        <div class="row">

                            {{-- FILTER HARI --}}
                            <div class="col-md-4 col-sm-6 mb-2">
                                <select name="hari" class="form-control">
                                    <option value="">-- Semua Hari --</option>
                                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                        <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>
                                            {{ $hari }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- FILTER LAPANGAN --}}
                            <div class="col-md-4 col-sm-6 mb-2">
                                <select name="lapangan_id" class="form-control">
                                    <option value="">-- Semua Lapangan --</option>
                                    @foreach($lapangan as $l)
                                        <option value="{{ $l->id }}" {{ request('lapangan_id') == $l->id ? 'selected' : '' }}>
                                            {{ $l->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- FILTER WAKTU --}}
                            <div class="col-md-4 col-sm-6 mb-2">
                                <select name="waktu" class="form-control">
                                    <option value="">-- Semua Waktu --</option>
                                    @foreach($jadwal->pluck('waktu')->unique() as $waktu)
                                        <option value="{{ $waktu }}" {{ request('waktu') == $waktu ? 'selected' : '' }}>
                                            {{ $waktu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- FILTER Status --}}
                            <div class="col-md-4 col-sm-6 mb-2">
                                <select name="status" class="form-control">
                                    <option value="">-- Semua Status --</option>
                                    @foreach(['Tersedia', 'Booked', 'Blokir'] as $status)
                                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- BUTTON --}}
                            <div class="col-md-12 mt-2 d-flex align-items-center">
                                <button class="btn btn-primary btn-sm mr-2">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-redo"></i> Reset
                                </a>

                                <span class="ml-auto badge badge-light">
                                    Total: {{ $jadwal->total() }} Jadwal
                                </span>
                            </div>

                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th width="40">#</th>
                                    <th width="120">Hari</th>
                                    <th width="120">Lapangan</th>
                                    <th width="120">Jadwal</th>
                                    <th width="120">Status</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwal as $j)
                                    <tr>
                                        <td>{{ ($jadwal->currentPage() - 1) * $jadwal->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="font-weight-bold">{{ Str::limit($j->hari, 30) }}</td>
                                        <td>
                                            <span class="badge badge-info badge-custom">
                                                {{ $j->lap->nama ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $j->waktu }}</td>
                                        <td>
                                            @php
                                                $status = $j->status ?? '-';

                                                $badgeClass = match ($status) {
                                                    'Tersedia' => 'badge-success',
                                                    'Booked' => 'badge-warning',
                                                    'Blokir' => 'badge-danger',
                                                    default => 'badge-secondary',
                                                };
                                            @endphp

                                            <span class="badge {{ $badgeClass }} badge-custom">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-action-group">
                                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $j->id }}" title="Edit">
                                                    <i class="fas fa-edit"></i> <span class="d-none d-md-inline">Edit
                                                        Status</span>
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-calendar-alt fa-2x mb-3"></i>
                                                <p>Tidak ada jadwal ditemukan</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="tambahJadwal">
    <div class="modal-dialog modal-lg-custom">
        <div class="modal-content">
            <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus"></i> Tambah Jadwal Baru
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lapangan <span class="text-danger">*</span></label>
                                <select name="lapangan" id="lapangan" class="form-control" required>
                                    <option value="">-- Pilih Lapangan --</option>
                                    @foreach($lapangan as $lap)
                                        <option value="{{ $lap->id }}">{{ $lap->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hari <span class="text-danger">*</span></label>
                                <select name="hari" id="hari" class="form-control" required>
                                    <option value="">-- Pilih Hari --</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Waktu <span class="text-danger">*</span></label>
                                <select name="waktu" id="waktu" class="form-control" required>
                                    <option value="">-- Pilih Waktu --</option>
                                    @php
                                        $listWaktu = [
                                            '08.00-09.00',
                                            '09.00-10.00',
                                            '10.00-11.00',
                                            '11.00-12.00',
                                            '12.00-13.00',
                                            '13.00-14.00',
                                            '14.00-15.00',
                                            '15.00-16.00',
                                            '16.00-17.00',
                                            '17.00-18.00',
                                            '18.00-19.00',
                                            '19.00-20.00',
                                            '20.00-21.00',
                                            '21.00-22.00',
                                            '22.00-23.00'
                                        ];
                                    @endphp

                                    @foreach($listWaktu as $w)
                                        <option value="{{ $w }}">{{ $w }}</option>
                                    @endforeach
                                </select>

                            </div>
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
@foreach($jadwal as $j)
    <div class="modal fade" id="edit{{ $j->id }}">
        <div class="modal-dialog modal-lg-custom">
            <div class="modal-content">
                <form action="{{ route('jadwal.update', $j->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">
                            <i class="fas fa-edit"></i> Edit Status Jadwal
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="">-- Pilih Status --</option>

                                    @foreach(['Tersedia', 'Booked', 'Blokir'] as $status)
                                        <option value="{{ $status }}" {{ old('status', $j->status) === $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
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
<script>
    const jadwalTerpakai = @json($jadwalTerpakai);

    const lapanganSelect = document.getElementById('lapangan');
    const hariSelect = document.getElementById('hari');
    const waktuSelect = document.getElementById('waktu');

    function filterWaktu() {
        const lapangan = lapanganSelect.value;
        const hari = hariSelect.value;

        Array.from(waktuSelect.options).forEach(opt => {
            if (!opt.value) return;

            const bentrok = jadwalTerpakai.some(j =>
                j.lapangan == lapangan &&
                j.hari == hari &&
                j.waktu == opt.value
            );

            opt.disabled = bentrok;
        });

        waktuSelect.value = "";
    }

    lapanganSelect.addEventListener('change', filterWaktu);
    hariSelect.addEventListener('change', filterWaktu);
</script>