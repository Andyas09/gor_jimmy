@extends('layouts.app')

@section('title', 'Gor Jimmy - Sewa Lapangan Bulu Tangkis Profesional')

@section('content')

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
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Sewa Lapangan Bulu Tangkis Profesional</h1>
                    <p>Lapangan berkualitas tinggi dengan fasilitas lengkap untuk permainan terbaik Anda. Tersedia untuk
                        semua level pemain.</p>
                    <a href="#booking" class="btn-primary">Booking Sekarang</a>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('landing_page.png') }}" alt="Lapangan Bulu Tangkis Profesional">
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section class="facilities" id="facilities">
        <div class="container">
            <h2>Fasilitas Kami</h2>
            <div class="facilities-container">
                @foreach($facilities as $facility)
                    <div class="facility-card">
                        <div class="facility-icon">
                            <i class="fas fa-{{ $facility['icon'] }}"></i>
                        </div>
                        <h3>{{ $facility['title'] }}</h3>
                        <p>{{ $facility['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing" id="pricing">
        <div class="container">
            <h2>Harga Sewa Lapangan</h2>
            <div class="pricing-container">
                @foreach($pricingPlans as $plan)
                    <div class="price-card {{ $plan['is_featured'] ? 'featured' : '' }}">
                        @if($plan['is_featured'])
                            <div class="badge">Paling Populer</div>
                        @endif
                        <h3>{{ $plan['name'] }}</h3>
                        <div class="price">Rp {{ $plan['price'] }}<span>/jam</span></div>
                        <ul>
                            @foreach($plan['features'] as $feature)
                                <li><i class="fas fa-check"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                        <a href="#booking" class="{{ $plan['is_featured'] ? 'btn-primary' : 'btn-secondary' }}">Pilih Paket</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

        @if(!auth()->check() || auth()->user()->role !== 'Member')
            <!-- Member Promo Section -->
            <section class="member-promo" id="member">
                <div class="container">
                    <div class="promo-card">
                        <div class="promo-content">
                            <h2>Promo Khusus Member GOR Jimmy</h2>
                            <p>Dapatkan berbagai keuntungan eksklusif dengan bergabung menjadi member resmi kami.</p>
                            <div class="benefit-list">
                                <div class="benefit-item">
                                    <i class="fas fa-percent"></i>
                                    <span>Diskon 10% setiap transaksi booking lapangan</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-calendar-check"></i>
                                    <span>Prioritas booking jadwal favorit di jam sibuk</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-medal"></i>
                                    <span>Gratis sewa raket dan shuttlecock setiap kunjungan</span>
                                </div>
                                <div class="benefit-item">
                                    <i class="fas fa-star"></i>
                                    <span>Poin reward yang bisa ditukarkan dengan jam sewa gratis</span>
                                </div>
                            </div>
                            <a href="https://wa.me/6282350728879?text=Halo%20Admin,%20saya%20ingin%20daftar%20member%20GOR%20Jimmy"
                                target="_blank" class="btn-primary">Daftar Member Sekarang</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    <!-- Gallery Section -->
    <section class="gallery" id="gallery">
        <div class="container">
            <h2>Galeri Lapangan</h2>
            <div class="gallery-container">
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1595435934247-5d33b7f92c70?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Lapangan Badminton">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Area Loker">
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1595341888016-a392ef81b7de?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                        alt="Area Tunggu">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Booking Section -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="contact-container" id="booking">
                <div class="contact-info">
                    <h2>Hubungi Kami</h2>
                    <p><i class="fas fa-map-marker-alt"></i>Gor Jimmy NTT, Kab. Sumba Timur</p>
                    <p><i class="fas fa-phone"></i>+62 823-5072-8879</p>
                    <p><i class="fas fa-envelope"></i> info@gorjimmy.com</p>
                    <p><i class="fas fa-clock"></i> Buka setiap hari: 08:00 - 23:00</p>

                    <div class="map-wrapper">
                        <iframe
                            src="https://www.google.com/maps?q={{ $map['lat'] }},{{ $map['lng'] }}&hl=id&z=16&output=embed"
                            allowfullscreen loading="lazy">
                        </iframe>
                    </div>

                </div>
                <div class="booking-card">
                    <h2><i class="fas fa-calendar-check"></i> Cek Jadwal</h2>

                    <div class="booking-inputs">
                        <div class="form-group">
                            <label><i class="fas fa-map-marker-alt"></i> Lapangan</label>
                            <select id="lapangan" class="form-control">
                                <option value="">Pilih Lapangan</option>
                                @foreach($lapangan as $l)
                                    <option value="{{ $l->id }}">{{ $l->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-calendar-day"></i> Tanggal</label>
                            <input type="date" id="tanggal" class="form-control">
                        </div>
                    </div>

                    <button class="btn-primary btn-full shadow-sm" onclick="loadJadwal()">
                        <i class="fas fa-search mr-2"></i> Cari Jadwal
                    </button>

                    <div id="jadwalStatus" class="jadwal-status" style="display:none"></div>

                    <div id="jadwalLegend" class="jadwal-legend" style="display:none">
                        <div class="legend-item"><span class="box available"></span> Tersedia</div>
                        <div class="legend-item"><span class="box selected"></span> Dipilih</div>
                        <div class="legend-item"><span class="box booked"></span> Terisi</div>
                    </div>

                    <div id="jadwalList" class="jadwal-grid"></div>

                    <button id="btnLanjut" class="btn-primary btn-full mt-4" style="display:none" onclick="lanjutBooking()">
                        Lanjutkan Booking <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
                <div class="booking-card" id="bookingFormWrapper" style="display:none">
                    <h2>Form Booking</h2>

                    <div id="jadwalDipilih" class="jadwal-terpilih"></div>

                    <form id="bookingForm">
                        @csrf

                        <input type="hidden" name="lapangan" id="lapangan_input">
                        <input type="hidden" name="tanggal" id="tanggal_input">
                        <input type="hidden" name="jadwal_ids" id="jadwal_input">
                        <input type="hidden" name="total_harga" id="total_harga_input">

                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" 
                                value="{{ Auth::check() && Auth::user()->role === 'Member' ? Auth::user()->name : '' }}" required>
                        </div>

                        <div class="form-group">
                            <input type="tel" name="whatsapp" class="form-control" placeholder="No WhatsApp" 
                                value="{{ Auth::check() && Auth::user()->role === 'Member' ? Auth::user()->whatsapp : '' }}" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="total_harga_view" class="form-control" placeholder="Total Harga"
                                readonly>
                        </div>

                        <div class="form-group">
                            <input type="number" name="dp" class="form-control"
                                placeholder="Masukkan DP dengan minimal Rp 50.000" required>
                        </div>

                        <button class="btn-primary btn-full">
                            Kirim Booking
                        </button>
                    </form>

                </div>
            </div>
        </div>
        </div>
    </section>
    <style>
        .booking-wrapper {
            max-width: 900px;
            margin: auto;
            display: grid;
            gap: 30px;
        }

        .booking-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .booking-card h2 {
            margin-bottom: 25px;
            font-size: 24px;
            color: #1e3c72;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
        }

        .booking-card h2 i {
            color: #ff6b6b;
        }

        .booking-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4b5563;
            font-size: 0.9rem;
        }

        .form-group label i {
            color: #1e3c72;
            margin-right: 5px;
            width: 15px;
            text-align: center;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #1e3c72;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(30, 60, 114, 0.1);
            outline: none;
        }

        .jadwal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 10px;
            margin-top: 25px;
        }

        .jadwal-btn {
            padding: 12px 5px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
        }

        .jadwal-available {
            background: #16a34a;
            color: #fff;
        }

        .jadwal-booked {
            background: #dc2626;
            color: #fff;
            cursor: not-allowed;
        }

        .jadwal-selected {
            background: #facc15 !important;
            color: #000 !important;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .jadwal-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            filter: brightness(1.1);
        }

        .jadwal-legend {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #6b7280;
            padding: 10px;
            background: #f8fafc;
            border-radius: 8px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .legend-item .box {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }

        .box.available {
            background: #16a34a;
        }

        .box.selected {
            background: #facc15;
        }

        .box.booked {
            background: #dc2626;
        }

        .jadwal-status {
            text-align: center;
            padding: 20px 10px;
            color: #6b7280;
            font-size: 0.95rem;
        }

        .jadwal-terpilih {
            margin-bottom: 15px;
            padding: 10px;
            background: #f1f5f9;
            border-radius: 8px;
        }

        /* Member Promo Section */
        .member-promo {
            padding: 80px 0;
            background-color: #ffffff;
        }

        .promo-card {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border-radius: 20px;
            padding: 50px;
            color: white;
            text-align: center;
            box-shadow: 0 15px 35px rgba(30, 60, 114, 0.2);
            position: relative;
            overflow: hidden;
        }

        .promo-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            z-index: 1;
        }

        .promo-content {
            position: relative;
            z-index: 2;
        }

        .promo-card h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
            font-family: 'Poppins', sans-serif;
        }

        .promo-card p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.9;
        }

        .benefit-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
            text-align: left;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .benefit-item i {
            font-size: 1.5rem;
            color: #ff6b6b;
            background: rgba(255, 107, 107, 0.1);
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .benefit-item span {
            font-size: 1rem;
            line-height: 1.4;
        }

        .promo-card .btn-primary {
            background: #ff6b6b;
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            display: inline-block;
            border-radius: 30px;
            font-weight: 700;
        }

        .promo-card .btn-primary:hover {
            background: #ff5252;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3);
        }

        @media (max-width: 768px) {
            .promo-card {
                padding: 40px 20px;
            }

            .promo-card h2 {
                font-size: 1.8rem;
            }

            .benefit-list {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
@endsection
@push('scripts')
    <script>
        let selectedJadwal = [];

        function loadJadwal() {
            const lapangan = document.getElementById('lapangan').value;
            const tanggal = document.getElementById('tanggal').value;
            const list = document.getElementById('jadwalList');
            const status = document.getElementById('jadwalStatus');
            const legend = document.getElementById('jadwalLegend');
            selectedJadwal = [];

            if (!lapangan || !tanggal) {
                alert('Pilih lapangan & tanggal');
                return;
            }

            status.style.display = 'block';
            status.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mencari jadwal...';
            list.innerHTML = '';
            legend.style.display = 'none';
            document.getElementById('btnLanjut').style.display = 'none';

            fetch(`/cek-jadwal?lapangan=${lapangan}&tanggal=${tanggal}`)
                .then(res => res.json())
                .then(data => {
                    status.style.display = 'none';
                    list.innerHTML = '';

                    if (data.length === 0) {
                        status.style.display = 'block';
                        status.innerHTML = '<i class="fas fa-info-circle"></i> Tidak ada jadwal tersedia untuk tanggal ini.';
                        return;
                    }

                    legend.style.display = 'flex';
                    data.forEach(j => {
                        list.innerHTML += `
                                <button
                                    type="button"
                                    class="jadwal-btn ${j.booked ? 'jadwal-booked' : 'jadwal-available'}"
                                    ${j.booked ? 'disabled' : ''}
                                    onclick="toggleJadwal('${j.id}', '${j.waktu}', this)">
                                    ${j.waktu}
                                </button>
                            `;
                    });

                })
                .catch(err => {
                    status.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Gagal memuat jadwal.';
                });
        }

        function toggleJadwal(id, waktu, el) {
            const index = selectedJadwal.findIndex(j => j.id === id);

            if (index === -1) {
                selectedJadwal.push({ id, waktu });
                el.classList.add('jadwal-selected');
            } else {
                selectedJadwal.splice(index, 1);
                el.classList.remove('jadwal-selected');
            }

            document.getElementById('btnLanjut').style.display =
                selectedJadwal.length ? 'block' : 'none';
        }

        function lanjutBooking() {
            document.getElementById('bookingFormWrapper').style.display = 'block';

            const lapangan = document.getElementById('lapangan').value;
            const tanggal = document.getElementById('tanggal').value;

            document.getElementById('lapangan_input').value = lapangan;
            document.getElementById('tanggal_input').value = tanggal;

            document.getElementById('jadwal_input').value =
                selectedJadwal.map(j => j.id).join(',');

            const total = hitungTotalHarga(selectedJadwal, tanggal);
            document.getElementById('jadwalDipilih').innerHTML =
                '<strong>Jadwal Dipilih:</strong><br>' +
                selectedJadwal.map(j => j.waktu).join(', ');
            document.getElementById('total_harga_view').value =
                'Rp ' + total.toLocaleString('id-ID');

            document.getElementById('total_harga_input').value = total;

            document.getElementById('bookingFormWrapper')
                .scrollIntoView({ behavior: 'smooth' });
        }
    </script>
    <script>
        function hitungTotalHarga(jadwalTerpilih, tanggal) {
            let total = 0;

            const dateObj = new Date(tanggal);
            const day = dateObj.getDay();

            const isWeekend = (day === 0 || day === 6);

            jadwalTerpilih.forEach(j => {
                const jamMulai = parseInt(j.waktu.split('-')[0]); // "18.00" → 18
                if (jamMulai >= 18 && jamMulai < 23) {
                    total += 90000;
                }
                else if (isWeekend) {
                    total += 100000;
                }
                else {
                    total += 75000;
                }
            });

            return total;
        }
    </script>
    <script>
        document.getElementById('bookingForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);

            fetch("{{ route('booking.submit') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {

                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    const orderId = data.order_id;
                    snap.pay(data.snap_token, {
                        onSuccess: function (result) {
                            window.location.href = "/invoice/" + orderId;
                        },
                        onPending: function (result) {
                            alert("Menunggu pembayaran");
                        },
                        onError: function (result) {
                            alert("Pembayaran gagal");
                        }
                    });

                })
                .catch(err => {
                    alert("Terjadi kesalahan");
                    console.error(err);
                });
        });
    </script>



    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

@endpush