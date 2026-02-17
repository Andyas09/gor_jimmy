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
                    <h1>Data Booking</h1>
                </div>
                @if(Auth::user()->role === 'Admin')
                <div class="col-sm-6 text-right">
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahBooking">
                        <i class="fas fa-plus"></i> Tambah Booking
                    </button>
                </div>
                @endif
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ Auth::user()->role === 'Member' ? 'Riwayat Booking' : 'Manajemen Booking' }}</h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('booking.index') }}" class="mb-4 filter-form">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 mb-2">
                                <div class="form-group">
                                    <input type="text" name="kode" class="form-control"
                                        placeholder="Cari kode booking..." value="{{ request('kode') }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-2">
                                <div class="form-group">
                                    <input type="text" name="nama" class="form-control" placeholder="Cari nama..."
                                        value="{{ request('nama') }}">
                                </div>
                            </div>
                            @if(Auth::user()->role === 'Admin')
                            <div class="col-md-4 col-sm-6 mb-2">
                                <select name="jenis" class="form-control">
                                    <option value="">-- Semua Jenis User --</option>
                                    @foreach(['Biasa', 'Member'] as $jenis)
                                        <option value="{{ $jenis }}" {{ request('jenis') == $jenis ? 'selected' : '' }}>
                                            {{ $jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="col-md-4 col-sm-6 mb-2">
                                <select name="lapangan" class="form-control">
                                    <option value="">-- Semua Lapangan --</option>
                                    @foreach($lapangan as $l)
                                        <option value="{{ $l->id }}" {{ request('lapangan') == $l->id ? 'selected' : '' }}>
                                            {{ $l->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-2">
                                <select name="status" class="form-control">
                                    <option value="">-- Semua Status --</option>
                                    @foreach(['Pending', 'Booked', 'Selesai', 'Dibatalkan'] as $status)
                                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-2">
                                <select name="urutkan" class="form-control">
                                    <option value="">-- Urutkan --</option>
                                    <option value="terbaru" {{ request('urutkan') == 'terbaru' ? 'selected' : '' }}>
                                        Terbaru
                                    </option>
                                    <option value="terlama" {{ request('urutkan') == 'terlama' ? 'selected' : '' }}>
                                        Terlama
                                    </option>
                                </select>
                            </div>
                            {{-- BUTTON --}}
                            <div class="col-md-12 mt-2 d-flex align-items-center">
                                <button class="btn btn-primary btn-sm mr-2">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('booking.index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-redo"></i> Reset
                                </a>

                                <span class="ml-auto badge badge-light">
                                    Total: {{ $booking->total() }} Booking
                                </span>
                            </div>

                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th width="40">#</th>
                                    <th width="120">Kode</th>
                                    @if(Auth::user()->role === 'Admin')
                                    <th width="120">Nama</th>
                                    <th width="120">Whatsapp</th>
                                    @endif
                                    @if(Auth::user()->role === 'Admin')
                                    <th width="120">Jenis User</th>
                                    @endif
                                    @if(Auth::user()->role === 'Admin')
                                    <th width="120">Lapangan</th>
                                    <th width="120">Tanggal</th>
                                    <th width="120">Waktu</th>
                                    @else
                                    <th width="200">Lapangan & Waktu</th>
                                    <th width="120">Tanggal</th>
                                    @endif
                                    <th width="120">Total (DP)</th>
                                    <th width="120">Total Harga</th>
                                    <th width="120">Status</th>
                                    @if(Auth::user()->role === 'Member')
                                    <th width="120">Status Pembayaran</th>
                                    @endif
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($booking as $b)
                                    <tr>
                                        <td>{{ ($booking->currentPage() - 1) * $booking->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="font-weight-bold">{{ Str::limit($b->kode, 30) }}</td>
                                        @if(Auth::user()->role === 'Admin')
                                        <td>{{ $b->nama }}</td>
                                        <td>{{ $b->whatsapp }}</td>
                                        @endif
                                        @if(Auth::user()->role === 'Admin')
                                        <td>
                                            @php
                                                $jenis = $b->jenis ?? '-';

                                                $badgeClass = match ($jenis) {
                                                    'Member' => 'badge-success',
                                                    'Biasa' => 'badge-warning',
                                                    default => 'badge-secondary',
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }} badge-custom">
                                                {{ $jenis }}
                                            </span>
                                        </td>
                                        @endif
                                        
                                        @if(Auth::user()->role === 'Admin')
                                        <td>{{ $b->lap->nama }}</td>
                                        <td>{{ $b->hari }}, {{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}</td>
                                        <td>{{ $b->jad->waktu }}</td>
                                        @else
                                        {{-- Member: Gabungkan Lapangan & Waktu --}}
                                        <td>
                                            <strong>{{ $b->lap->nama }}</strong><br>
                                            @if(isset($b->slots))
                                                @foreach($b->slots as $slot)
                                                    <span class="badge badge-info badge-sm">{{ $slot->jad->waktu }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge badge-info badge-sm">{{ $b->jad->waktu }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $b->hari }}, {{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('d F Y') }}</td>
                                        @endif
                                        
                                        <td>{{ $b->dp ? 'Rp ' . number_format($b->dp, 0, ',', '.') : '-' }}</td>
                                        @if(Auth::user()->role === 'Member' && isset($b->slots))
                                        {{-- Untuk Member dengan grouped data, hitung total yang benar --}}
                                        @php
                                            $totalBayarValues = $b->slots->pluck('total_bayar')->map(function($val) {
                                                return (int) preg_replace('/[^0-9]/', '', $val);
                                            });
                                            $uniqueValues = $totalBayarValues->unique();
                                            $totalHargaDisplay = $uniqueValues->count() === 1 ? $uniqueValues->first() : $totalBayarValues->sum();
                                        @endphp
                                        <td>{{ 'Rp ' . number_format($totalHargaDisplay, 0, ',', '.') }}</td>
                                        @else
                                        <td>{{ $b->total_bayar ? 'Rp ' . number_format($b->total_bayar, 0, ',', '.') : '-' }}</td>
                                        @endif
                                        
                                        <td>
                                            @php
                                                $status = $b->status ?? '-';

                                                $badgeClass = match ($status) {
                                                    'Selesai' => 'badge-success',
                                                    'Booked' => 'badge-warning',
                                                    'Dibatalkan' => 'badge-danger',
                                                    'Pending' => 'badge-secondary',
                                                };
                                            @endphp

                                            <span class="badge {{ $badgeClass }} badge-custom">
                                                {{ $status }}
                                            </span>
                                        </td>
                                        @if(Auth::user()->role === 'Member')
                                        <td>
                                            @php
                                                if(isset($b->slots)) {
                                                    // Grouped data - calculate correct total
                                                    $totalBayarValues = $b->slots->pluck('total_bayar')->map(function($val) {
                                                        return (int) preg_replace('/[^0-9]/', '', $val);
                                                    });
                                                    $uniqueValues = $totalBayarValues->unique();
                                                    $totalHargaNumeric = $uniqueValues->count() === 1 ? $uniqueValues->first() : $totalBayarValues->sum();
                                                } else {
                                                    $totalHargaNumeric = (int) preg_replace('/[^0-9]/', '', $b->total_bayar);
                                                }
                                                $dpNumeric = (int) $b->dp;
                                                $isLunas = $dpNumeric >= $totalHargaNumeric;
                                            @endphp
                                            <span class="badge badge-{{ $isLunas ? 'success' : 'danger' }} badge-custom">
                                                {{ $isLunas ? 'Lunas' : 'Belum Lunas' }}
                                            </span>
                                        </td>
                                        @endif
                                        <td>
                                            <a href="{{ route('booking.invoice', $b->kode) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-detail"></i> Lihat Invoice
                                </a>
                                            @if(Auth::user()->role === 'Admin')
                                            <div class="btn-action-group">
                                                <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $b->id }}" title="Edit">
                                                    <i class="fas fa-edit"></i> <span class="d-none d-md-inline">Edit</span>
                                                </button>
                                            </div>
                                            @endif
                                            @if(Auth::user()->role === 'Member' && !$isLunas)
                                            <div class="btn-action-group">
                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#bayar{{ $b->id }}" title="Bayar">
                                                    <i class="fas fa-money-bill-wave"></i> <span class="d-none d-md-inline">Bayar</span>
                                                </button>
                                            </div>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-calendar-alt fa-2x mb-3"></i>
                                                <p>Tidak ada booking ditemukan</p>
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
<div class="modal fade" id="tambahBooking">
    <div class="modal-dialog modal-lg-custom">
        <div class="modal-content">
            <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus"></i> Tambah Booking Manual
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        {{-- NAMA --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                        </div>

                        {{-- WHATSAPP --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Whatsapp <span class="text-danger">*</span></label>
                                <input type="text" name="whatsapp" class="form-control" placeholder="08xxxxxxxxxx"
                                    required>
                            </div>
                        </div>

                        {{-- JENIS USER --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis User <span class="text-danger">*</span></label>
                                <select name="jenis" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Member">Member</option>
                                    <option value="Biasa">Non Member</option>
                                </select>
                            </div>
                        </div>

                        {{-- LAPANGAN (FK) --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lapangan <span class="text-danger">*</span></label>
                                <select name="lapangan" id="lapangan" class="form-control" required>
    <option value="">-- Pilih Lapangan --</option>
    @foreach($lapangan as $lap)
        <option value="{{ $lap->id }}">{{ $lap->nama }}</option>
    @endforeach
</select>

                            </div>
                        </div>
<div class="col-md-6">
    <div class="form-group">
        <label>Tanggal <span class="text-danger">*</span></label>
        <input
            type="date"
            name="tanggal"
            id="tanggal"
            class="form-control"
            required
            min="{{ date('Y-m-d') }}">
    </div>
</div>

                        <div class="col-md-6">
    <div class="form-group">
        <label>Hari <span class="text-danger">*</span></label>
        <input type="text" id="hari_text" class="form-control" readonly>
        <input type="hidden" name="hari" id="hari">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label>Jam <span class="text-danger">*</span></label>
        <select name="jadwal" id="jadwal" class="form-control" required disabled>
    <option value="">-- Pilih Jam --</option>
    @foreach($jadwal as $j)
        <option
            value="{{ $j->id }}"
            data-hari="{{ $j->hari }}"
            data-waktu="{{ $j->waktu }}"
            data-lapangan="{{ $j->lapangan }}">
            {{ $j->waktu }}
        </option>
    @endforeach
</select>

    </div>
</div>



                        {{-- STATUS --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="Booked">Booked</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Cancel">Cancel</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
    <div class="form-group">
        <label>Jumlah Bayar (DP)</label>
        <input type="number" name="dp" id="dp" class="form-control" placeholder="Masukkan DP">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Total Bayar</label>
        <input type="text" name="total_bayar" id="total_bayar" class="form-control" readonly>
    </div>
</div>


                        {{-- BUKTI BOOKING --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bukti Booking</label>
                                <input type="file" name="bukti_booking" class="form-control" accept="image/*">
                                <small class="text-muted">Opsional (jpg/png)</small>
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

@foreach($booking as $b)
    {{-- Modal Bayar untuk Member --}}
    @if(Auth::user()->role === 'Member')
    <div class="modal fade" id="bayar{{ $b->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-money-bill-wave"></i> Pelunasan Pembayaran</h5>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @php
                        $totalHargaNumeric = (int) preg_replace('/[^0-9]/', '', $b->total_bayar);
                        $dpNumeric = (int) $b->dp;
                        $sisa = $totalHargaNumeric - $dpNumeric;
                    @endphp
                    <div class="text-center mb-4">
                        <h6 class="text-muted">Sisa yang harus dibayar:</h6>
                        <h2 class="text-success font-weight-bold">Rp {{ number_format($sisa, 0, ',', '.') }}</h2>
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle mr-2"></i> 
                        Silakan lakukan pelunasan melalui halaman invoice atau di lokasi saat kunjungan.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" onclick="payRemaining('{{ $b->kode }}')">
                        <i class="fas fa-file-invoice-dollar"></i> Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="modal fade" id="edit{{ $b->id }}">
        <div class="modal-dialog modal-lg-custom">
            <div class="modal-content">
                <form action="{{ route('booking.update', $b->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">
                            <i class="fas fa-edit"></i> Edit Status Booking
                        </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control" required>
                                    <option value="">-- Pilih Status --</option>

                                    @foreach(['Pending', 'Booked', 'Selesai', 'Dibatalkan'] as $status)
                                        <option value="{{ $status }}" {{ old('status', $b->status) === $status ? 'selected' : '' }}>
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
document.addEventListener('DOMContentLoaded', function () {
    const hariSelect = document.getElementById('hari');
    const jamSelect  = document.getElementById('jadwal');

    function filterJam() {
        const hari = hariSelect.value;
        let hasOption = false;

        jamSelect.value = '';
        jamSelect.disabled = !hari;

        Array.from(jamSelect.options).forEach(option => {
            if (!option.value) return;

            if (option.dataset.hari === hari) {
                option.hidden = false;
                hasOption = true;
            } else {
                option.hidden = true;
            }
        });

        if (!hasOption) {
            jamSelect.disabled = true;
        }
    }

    hariSelect.addEventListener('change', filterJam);
    if (hariSelect.value) {
        filterJam();
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const hariSelect = document.getElementById('hari');
    const jamSelect  = document.getElementById('jadwal');

    hariSelect.addEventListener('change', function () {
        const hari = this.value;
        let aktif = false;

        jamSelect.value = '';
        jamSelect.disabled = !hari;

        Array.from(jamSelect.options).forEach(option => {
            if (!option.value) return;

            if (option.dataset.hari === hari) {
                option.hidden = false;
                aktif = true;
            } else {
                option.hidden = true;
            }
        });

        if (!aktif) jamSelect.disabled = true;
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tanggal   = document.getElementById('tanggal');
    const hariText  = document.getElementById('hari_text');
    const hariInput = document.getElementById('hari');
    const jamSelect = document.getElementById('jadwal');

    const namaHari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

    tanggal.addEventListener('change', function () {
        if (!this.value) return;

        const date = new Date(this.value);
        const hari = namaHari[date.getDay()];

        // set hari
        hariText.value  = hari;
        hariInput.value = hari;

        // reset jam
        jamSelect.value = '';
        jamSelect.disabled = false;

        let adaJam = false;

        Array.from(jamSelect.options).forEach(option => {
            if (!option.value) return;

            if (option.dataset.hari === hari) {
                option.hidden = false;
                adaJam = true;
            } else {
                option.hidden = true;
            }
        });

        if (!adaJam) jamSelect.disabled = true;
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tanggal   = document.getElementById('tanggal');
    const lapangan  = document.getElementById('lapangan');
    const hariText  = document.getElementById('hari_text');
    const hariInput = document.getElementById('hari');
    const jamSelect = document.getElementById('jadwal');

    const namaHari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

    function filterJam() {
        const lapanganId = lapangan.value;
        const hari       = hariInput.value;

        jamSelect.value = '';
        jamSelect.disabled = true;

        let adaJam = false;

        Array.from(jamSelect.options).forEach(option => {
            if (!option.value) return;

            if (
                option.dataset.hari === hari &&
                option.dataset.lapangan === lapanganId
            ) {
                option.hidden = false;
                adaJam = true;
            } else {
                option.hidden = true;
            }
        });

        if (adaJam) jamSelect.disabled = false;
    }

    tanggal.addEventListener('change', function () {
        const date = new Date(this.value);
        const hari = namaHari[date.getDay()];

        hariText.value  = hari;
        hariInput.value = hari;

        filterJam();
    });

    lapangan.addEventListener('change', filterJam);
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const hariInput  = document.getElementById('hari');
    const jamSelect  = document.getElementById('jadwal');
    const totalInput = document.getElementById('total_bayar');

    function hitungTotal() {
        const hari  = hariInput.value;
        const jamEl = jamSelect.options[jamSelect.selectedIndex];

        if (!hari || !jamEl || !jamEl.dataset.waktu) {
            totalInput.value = '';
            return;
        }

        const waktu = jamEl.dataset.waktu; // contoh: "18:00 - 19:00"
        const jamAwal = parseInt(waktu.substring(0,2));

        let total = 0;

        const weekday = ['Senin','Selasa','Rabu','Kamis','Jumat'];
        const weekend = ['Sabtu','Minggu'];

        // 🌞 WEEKDAY PAGI-SORE
        if (weekday.includes(hari) && jamAwal >= 8 && jamAwal < 16) {
            total = 75000;
        }
        // 🌞 WEEKEND PAGI
        else if (weekend.includes(hari) && jamAwal >= 8 && jamAwal < 11) {
            total = 100000;
        }
        // 🌙 JAM MALAM
        else if (jamAwal >= 18 && jamAwal < 23) {
            total = 90000;
        }

        totalInput.value = 'Rp ' + total.toLocaleString('id-ID');
    }

    jamSelect.addEventListener('change', hitungTotal);
});
</script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    function payRemaining(kode) {
        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('existing_kode', kode);

        // UI Loading
        Swal.fire({
            title: 'Memproses...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // USER CODE START
        fetch("{{ route('booking.submit') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                Swal.close();
                if (data.error) {
                    Swal.fire('Gagal', data.error, 'error');
                    return;
                }
                const orderId = data.order_id;
                snap.pay(data.snap_token, {
                    onSuccess: function (result) {
                        window.location.href = "/invoice/" + orderId;
                    },
                    onPending: function (result) {
                        Swal.fire('Pending', 'Menunggu pembayaran', 'info');
                    },
                    onError: function (result) {
                        Swal.fire('Error', 'Pembayaran gagal', 'error');
                    }
                });
            })
            .catch(err => {
                Swal.close();
                Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                console.error(err);
            });
        // USER CODE END
    }
</script>


