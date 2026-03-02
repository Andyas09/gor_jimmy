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
                    <h1>Laporan Pendapatan & Booking</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Filter Card -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title"><i class="fas fa-filter mr-2"></i> Filter Laporan</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.index') }}" method="GET" class="filter-form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Semua Status</option>
                                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="Booked" {{ request('status') == 'Booked' ? 'selected' : '' }}>
                                            Booked</option>
                                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>
                                            Selesai</option>
                                        <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success"><i class="fas fa-search mr-1"></i>
                                Tampilkan</button>
                            <a href="{{ route('laporan.index') }}" class="btn btn-secondary"><i
                                    class="fas fa-sync mr-1"></i> Reset</a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                            <p>Total Pendapatan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalBooking }}</h3>
                            <p>Total Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $bookingSelesai }}</h3>
                            <p>Booking Selesai</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $bookingPending }}</h3>
                            <p>Booking Pending</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Transaction Table -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Transaksi</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID Booking</th>
                                            <th>Pelanggan</th>
                                            <th>Tanggal</th>
                                            <th>Lapangan</th>
                                            <th>Waktu</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bookings as $b)
                                            <tr>
                                                <td><code>{{ $b->id }}</code></td>
                                                <td>{{ $b->nama }}</td>
                                                <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d/m/Y') }}</td>
                                                <td>{{ $b->lap->nama ?? '-' }}</td>
                                                <td>{{ $b->jad->waktu ?? '-' }}</td>
                                                <td>Rp
                                                    {{ number_format((int) preg_replace('/[^0-9]/', '', $b->total_bayar), 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    @php
                                                        $badgeClass = 'secondary';
                                                        if ($b->status == 'Booked')
                                                            $badgeClass = 'info';
                                                        if ($b->status == 'Selesai')
                                                            $badgeClass = 'success';
                                                        if ($b->status == 'Pending')
                                                            $badgeClass = 'warning';
                                                        if ($b->status == 'Dibatalkan')
                                                            $badgeClass = 'danger';
                                                    @endphp
                                                    <span class="badge badge-{{ $badgeClass }}">{{ $b->status }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">Tidak ada data ditemukan untuk
                                                    periode ini</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popularity Stats -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Popularitas Lapangan</h3>
                        </div>
                        <div class="card-body">
                            @foreach($lapanganStats as $stat)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-1">
                                        <strong>{{ $stat['nama'] }}</strong>
                                        <span>{{ $stat['count'] }} Booking</span>
                                    </div>
                                    @php
                                        $percent = $totalBooking > 0 ? ($stat['count'] / $totalBooking) * 100 : 0;
                                    @endphp
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: {{ $percent }}%"></div>
                                    </div>
                                    <small class="text-muted">Pendapatan: Rp
                                        {{ number_format($stat['income'], 0, ',', '.') }}</small>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>