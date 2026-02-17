@include('admin.layouts.header')
@include('admin.layouts.menu')
<style>
    /* Custom Styles for Dashboard */
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3a0ca3;
        --success-color: #4cc9f0;
        --warning-color: #f72585;
        --info-color: #7209b7;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }

    .dashboard-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        margin-bottom: 20px;
        height: 100%;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .card-gradient-1 {
        background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
    }

    .card-gradient-2 {
        background: linear-gradient(135deg, #4cc9f0 0%, #4361ee 100%);
    }

    .card-gradient-3 {
        background: linear-gradient(135deg, #7209b7 0%, #3a0ca3 100%);
    }

    .card-gradient-4 {
        background: linear-gradient(135deg, #f72585 0%, #b5179e 100%);
    }

    .card-gradient-5 {
        background: linear-gradient(135deg, #ff9a00 0%, #ff6a00 100%);
    }

    .card-gradient-6 {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
    }

    .stat-card {
        padding: 25px 20px;
        color: white;
        position: relative;
    }

    .stat-card .inner {
        position: relative;
        z-index: 2;
    }

    .stat-card h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 5px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .stat-card p {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 0;
        font-weight: 500;
    }

    .stat-card .icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 4rem;
        opacity: 0.2;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .dashboard-card:hover .icon {
        transform: translateY(-50%) scale(1.1);
        opacity: 0.3;
    }

    .progress-card {
        background: white;
        border-left: 4px solid var(--primary-color);
    }

    .chart-container {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
        height: 100%;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eef2f7;
    }

    .chart-header h3 {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark-color);
        margin: 0;
    }

    .recent-activity {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        height: 100%;
    }

    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        padding: 15px 0;
        border-bottom: 1px solid #f1f3f4;
        transition: background-color 0.2s;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin: 0 -15px;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .activity-icon.product {
        background: rgba(67, 97, 238, 0.1);
        color: #4361ee;
    }

    .activity-icon.user {
        background: rgba(76, 201, 240, 0.1);
        color: #4cc9f0;
    }

    .activity-icon.order {
        background: rgba(247, 37, 133, 0.1);
        color: #f72585;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 600;
        margin-bottom: 5px;
        color: var(--dark-color);
    }

    .activity-time {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .view-all {
        text-align: center;
        padding-top: 15px;
    }

    .dashboard-header {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .welcome-message h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 5px;
    }

    .welcome-message p {
        color: #6c757d;
        margin-bottom: 0;
    }

    .date-info {
        text-align: right;
        color: #6c757d;
        font-weight: 500;
    }

    .quick-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .quick-action-btn {
        padding: 8px 15px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        color: var(--dark-color);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .quick-action-btn:hover {
        background: var(--primary-color);
        color: white;
        text-decoration: none;
        border-color: var(--primary-color);
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .stat-card h3 {
            font-size: 2rem;
        }

        .stat-card .icon {
            font-size: 3rem;
        }

        .welcome-message h1 {
            font-size: 1.5rem;
        }

        .date-info {
            text-align: left;
            margin-top: 10px;
        }

        .quick-actions {
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .stat-card {
            padding: 20px 15px;
        }

        .stat-card h3 {
            font-size: 1.8rem;
        }

        .chart-container,
        .recent-activity {
            padding: 15px;
        }

        .activity-item {
            padding: 12px 0;
        }
    }

    /* Animation for numbers */
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .count-animation {
        animation: countUp 0.8s ease-out;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<div class="content-wrapper" style="background-color: #f8fafc; min-height: 100vh;">
    <!-- Header Dashboard -->
    <div class="dashboard-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="welcome-message">
                    <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p>Selamat datang di panel {{ Auth::user()->role }}. Berikut adalah ringkasan aktivitas sistem.</p>
                    @if(Auth::user()->role === 'Admin')
                        <div class="quick-actions">
                            <a href="" class="quick-action-btn">
                                <i class="fas fa-table-tennis"></i> Kelola Lapangan
                            </a>
                            <a href="" class="quick-action-btn">
                                <i class="fas fa-calendar-alt"></i> Kelola Jadwal & Slot Waktu
                            </a>
                            <a href="" class="quick-action-btn">
                                <i class="fas fa-shopping-bag"></i> Kelola Booking
                            </a>
                            <a href="" class="quick-action-btn">
                                <i class="fas fa-clipboard-list"></i> Kelola Harga
                            </a>
                            <a href="" class="quick-action-btn">
                                <i class="fas fa-chart-line"></i> Kelola Laporan
                            </a>
                            <a href="" class="quick-action-btn">
                                <i class="fas fa-credit-card"></i> Kelola Pembayaran
                            </a>
                            <a href="" class="quick-action-btn">
                                <i class="fas fa-users"></i> Kelola User
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="date-info">
                    <i class="far fa-calendar-alt mr-2"></i>
                    <span id="current-date"></span>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if(Auth::user()->role === 'Admin')
                <!-- Statistik Utama Admin -->
                <div class="row">
                    <!-- Total Lapangan -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-card">
                            <div class="stat-card card-gradient-1">
                                <div class="inner">
                                    <h3></h3>
                                    <p>Total Lapangan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-table-tennis"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Jadwal -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-card">
                            <div class="stat-card card-gradient-2">
                                <div class="inner">
                                    <h3 id="totalJadwal"></h3>
                                    <p>Total Jadwal & Slot Waktu</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total User -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-card">
                            <div class="stat-card card-gradient-3">
                                <div class="inner">
                                    <h3 id="totalUser">{{ $totalUser }}</h3>
                                    <p>Total Member & User</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Booking -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-card">
                            <div class="stat-card card-gradient-3">
                                <div class="inner">
                                    <h3 id="totalBooking">{{ $totalPesanan }}</h3>
                                    <p>Total Booking</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pendapatan -->
                    <div class="col-lg-3 col-md-6">
                        <div class="dashboard-card">
                            <div class="stat-card card-gradient-4">
                                <div class="inner">
                                    <h3 id="totalPendapatan">
                                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                                    </h3>
                                    <p>Total Pendapatan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Statistik Member (Riwayat Booking) -->
                <div class="row">
                    <div class="col-12">
                        <div class="recent-activity">
                            <div class="chart-header">
                                <h3><i class="fas fa-history mr-2"></i> Riwayat Booking Anda</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Kode Booking</th>
                                            <th>Lapangan</th>
                                            <th>Tanggal</th>
                                            <th>Sesi / Waktu</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold">BK20250601</td>
                                            <td>Lapangan Futsal A</td>
                                            <td>01 Juni 2025</td>
                                            <td>
                                                <span class="badge badge-info">08:00 - 09:00</span>
                                                <span class="badge badge-info">09:00 - 10:00</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-success">Booked</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-file-invoice"></i> Invoice
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold">BK20250605</td>
                                            <td>Lapangan Badminton 1</td>
                                            <td>05 Juni 2025</td>
                                            <td>
                                                <span class="badge badge-info">15:00 - 16:00</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-warning">Pending</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-file-invoice"></i> Invoice
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold">BK20250610</td>
                                            <td>Lapangan Futsal B</td>
                                            <td>10 Juni 2025</td>
                                            <td>
                                                <span class="badge badge-info">19:00 - 20:00</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-secondary">Selesai</span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-file-invoice"></i> Invoice
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Jika ingin kosong -->
                                        <!--
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Belum ada riwayat booking.
                                </td>
                            </tr>
                            -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>

<script>
    // Set current date
    document.getElementById('current-date').textContent = new Date().toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    // Count up animation for stats
    function animateValue(element, start, end, duration, prefix = '', suffix = '') {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            element.textContent = prefix + value.toLocaleString() + suffix;
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }



    // Add hover effect to dashboard cards
    document.querySelectorAll('.dashboard-card').forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.style.transform = 'translateY(-5px)';
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = 'translateY(0)';
        });
    });

    // Auto refresh stats every 5 minutes
    setInterval(() => {
        // In real application, you would fetch new data from API here
        console.log('Refreshing dashboard data...');
    }, 300000);
</script>