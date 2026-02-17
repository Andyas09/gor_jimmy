@include('admin.layouts.header')
@include('admin.layouts.menu')
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

    <!-- HEADER -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Profil Pengguna</h1>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- PROFIL KIRI -->
                <div class="col-md-4">
                    <!-- Member Card Section -->
                    <div class="card card-success card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-id-card mr-2"></i>Kartu Member</h3>
                        </div>
                        <div class="card-body">
                            <!-- Card Container for Download -->
                            <div id="memberCardContainer" class="p-4 bg-light rounded text-center mb-3">
                                <div id="memberCard" class="premium-card">
                                    <div class="card-glow"></div>
                                    <div class="card-content">
                                        <div class="card-header-inner">
                                            <div class="brand">
                                                <div class="brand-logo">GOR JIMMY</div>
                                                <div class="brand-sub">SPORTS CENTER</div>
                                            </div>
                                            <div class="card-type">MEMBER CARD</div>
                                        </div>
                                        
                                        <div class="card-body-inner">
                                            <div class="chip">
                                                <div class="chip-line"></div>
                                                <div class="chip-line"></div>
                                                <div class="chip-line"></div>
                                                <div class="chip-line"></div>
                                            </div>
                                            <div class="user-info">
                                                <div class="label">MEMBER NAME</div>
                                                <div class="value name-text">{{ Auth::user()->name ?? 'Default User' }}</div>
                                                
                                                <div class="row info-row">
                                                    <div class="col-7">
                                                        <div class="label">MEMBER ID</div>
                                                        <div class="value id-text">{{ Auth::user()->username ?? '-' }}</div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="label">JOINED</div>
                                                        <div class="value since-text">{{ Auth::user()->created_at->format('M Y') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card-footer-inner">
                                            <div class="status-badge">
                                                <span class="dot"></span> {{ Auth::user()->status ?? 'ACTIVE' }}
                                            </div>
                                            <div class="card-signature">Official Digital ID</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-center gap-2">
                                <button onclick="downloadCard()" class="btn btn-primary btn-sm mx-1">
                                    <i class="fas fa-download mr-1"></i> Download
                                </button>
                                <button onclick="printCard()" class="btn btn-secondary btn-sm mx-1">
                                    <i class="fas fa-print mr-1"></i> Cetak
                                </button>
                            </div>
                        </div>
                        <hr class="mx-3 my-0">
                        <div class="card-body box-profile text-center pt-3">
                            <h3 class="profile-username">
                                {{ Auth::user()->name ?? 'Default' }}
                            </h3>
                            <p class="text-muted">
                                {{ Auth::user()->jenis ?? 'Default' }}
                            </p>
                            <ul class="list-group list-group-unbordered mb-3 text-left">
                                <li class="list-group-item">
                                    <b>Username</b>
                                    <span class="float-right">
                                        {{ Auth::user()->username ?? '-' }}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <b>Whatsapp</b>
                                    <span class="float-right">
                                        {{ Auth::user()->whatsapp ?? '-' }}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b>
                                    <span class="float-right badge badge-success">
                                        {{ Auth::user()->status ?? '-' }}
                                    </span> 
                                </li>
                            </ul> 
                        </div>
                    </div>
                </div>

                <style>
                    /* Premium Member Card Styling */
                    .premium-card {
                        position: relative;
                        width: 100%;
                        max-width: 380px;
                        aspect-ratio: 1.586 / 1;
                        background: #0f172a; /* Deep Slate */
                        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
                        border-radius: 20px;
                        padding: 25px;
                        color: white;
                        overflow: hidden;
                        box-shadow: 0 20px 40px rgba(0,0,0,0.4);
                        margin: 0 auto;
                        text-align: left;
                        font-family: 'Poppins', sans-serif;
                        border: 1px solid rgba(255,255,255,0.08);
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                    }

                    .card-glow {
                        position: absolute;
                        top: -50%;
                        right: -50%;
                        width: 100%;
                        height: 100%;
                        background: radial-gradient(circle, rgba(234, 179, 8, 0.15) 0%, transparent 70%);
                        pointer-events: none;
                    }

                    .premium-card::after {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
                        opacity: 0.05;
                        pointer-events: none;
                    }

                    .card-header-inner {
                        display: flex;
                        justify-content: space-between;
                        align-items: flex-start;
                        z-index: 2;
                    }

                    .brand-logo {
                        font-weight: 900;
                        font-size: 1.4rem;
                        letter-spacing: 3px;
                        color: #fbbf24; /* Amber 400 */
                        line-height: 1;
                    }

                    .brand-sub {
                        font-size: 0.6rem;
                        letter-spacing: 4px;
                        color: rgba(255,255,255,0.4);
                        margin-top: 2px;
                        font-weight: 500;
                    }

                    .card-type {
                        font-size: 0.55rem;
                        font-weight: 700;
                        background: rgba(251, 191, 36, 0.1);
                        color: #fbbf24;
                        padding: 4px 10px;
                        border-radius: 20px;
                        letter-spacing: 1.5px;
                        border: 1px solid rgba(251, 191, 36, 0.3);
                        text-transform: uppercase;
                    }

                    .card-body-inner {
                        display: flex;
                        gap: 20px;
                        align-items: center;
                        z-index: 2;
                        margin-top: 10px;
                    }

                    .chip {
                        width: 45px;
                        height: 35px;
                        background: linear-gradient(135deg, #d4af37 0%, #f9d976 50%, #d4af37 100%);
                        border-radius: 6px;
                        position: relative;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-evenly;
                        padding: 4px;
                        opacity: 0.9;
                        flex-shrink: 0;
                    }

                    .chip-line {
                        height: 1px;
                        background: rgba(0,0,0,0.2);
                        width: 100%;
                    }

                    .user-info {
                        flex-grow: 1;
                    }

                    .label {
                        font-size: 0.5rem;
                        font-weight: 600;
                        color: rgba(255,255,255,0.4);
                        letter-spacing: 1.5px;
                        text-transform: uppercase;
                        margin-bottom: 0;
                    }

                    .name-text {
                        font-size: 1.2rem;
                        font-weight: 700;
                        color: white;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                        margin-bottom: 8px;
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                        max-width: 200px;
                    }

                    .info-row {
                        margin-top: 5px;
                    }

                    .value {
                        font-weight: 600;
                        font-size: 0.85rem;
                        color: rgba(255,255,255,0.9);
                    }

                    .card-footer-inner {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        z-index: 2;
                        padding-top: 10px;
                        border-top: 1px solid rgba(255,255,255,0.05);
                    }

                    .status-badge {
                        font-size: 0.6rem;
                        font-weight: 600;
                        display: flex;
                        align-items: center;
                        gap: 5px;
                        color: rgba(255,255,255,0.6);
                    }

                    .status-badge .dot {
                        width: 6px;
                        height: 6px;
                        background: #4ade80; /* Green 400 */
                        border-radius: 50%;
                        box-shadow: 0 0 10px #4ade80;
                    }

                    .card-signature {
                        font-style: italic;
                        font-size: 0.6rem;
                        color: rgba(255,255,255,0.3);
                        font-family: serif;
                    }

                    /* For Print */
                    @media print {
                        body * {
                            visibility: hidden;
                        }
                        #memberCard, #memberCard * {
                            visibility: visible;
                        }
                        #memberCard {
                            position: absolute;
                            left: 0;
                            top: 0;
                            width: 85.6mm; /* Standard ID Card Size */
                            height: 54mm;
                            -webkit-print-color-adjust: exact;
                        }
                    }
                </style>

                <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
                <script>
                    function downloadCard() {
                        const card = document.getElementById('memberCard');
                        html2canvas(card, {
                            scale: 3, // For higher quality
                            useCORS: true,
                            backgroundColor: null
                        }).then(canvas => {
                            const link = document.createElement('a');
                            link.download = `Member_Card_{{ Auth::user()->username }}.png`;
                            link.href = canvas.toDataURL('image/png');
                            link.click();
                        });
                    }

                    function printCard() {
                        window.print();
                    }
                </script>

                <!-- PROFIL KANAN -->
                <div class="col-md-8">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Edit Profil</h3>
                        </div>

                        <form method="POST" action="{{ route('profil.update', Auth::user()->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ Auth::user()->name ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control"
                                           value="{{ Auth::user()->username ?? '' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Whatsapp</label>
                                    <input type="number" name="whatsapp" class="form-control"
                                           value="{{ Auth::user()->whatsapp ?? '' }}">
                                </div>

                                <hr>

                                <h5>Ubah Password</h5>

                                <div class="form-group">
                                    <label>Password Lama</label>
                                    <input type="password" name="old_password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" name="new_password" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="password" name="new_password_confirmation" class="form-control">
                                </div>

                            </div>

                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
