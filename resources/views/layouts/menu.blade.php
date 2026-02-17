<nav class="navbar">
    <div class="container">
        <div class="nav-content">
            <div class="nav-links">
                <a href="#home" class="nav-link active">Beranda</a>
                <a href="#facilities" class="nav-link">Fasilitas</a>
                <a href="#pricing" class="nav-link">Harga</a>
                @if(!auth()->check() || auth()->user()->role !== 'Member')
                <a href="#member" class="nav-link">Member</a>
                @endif
                <a href="#gallery" class="nav-link">Galeri</a>
                <a href="#contact" class="nav-link">Kontak & Cek Jadwal</a>
                @auth
                    <a href="{{ route('booking.index') }}" class="nav-link">Akun</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                @endauth
            </div>
            <div class="nav-booking">
                <a href="#booking" class="btn-booking">
                    <i class="fas fa-calendar-alt"></i>
                    Booking Lapangan
                </a>
            </div>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu">
    <div class="mobile-menu-content">
        <a href="#home" class="mobile-nav-link">Beranda</a>
        <a href="#facilities" class="mobile-nav-link">Fasilitas</a>
        <a href="#pricing" class="mobile-nav-link">Harga</a>
        @if(!auth()->check() || auth()->user()->role !== 'Member')
        <a href="#member" class="mobile-nav-link">Member</a>
        @endif
        <a href="#gallery" class="mobile-nav-link">Galeri</a>
        <a href="#contact" class="mobile-nav-link">Kontak & Cek Jadwal</a>
        @auth
            <a href="{{ route('booking.index') }}" class="mobile-nav-link">Akun</a>
        @else
            <a href="{{ route('login') }}" class="mobile-nav-link">Login</a>
        @endauth
        <a href="#booking" class="btn-booking mobile">Booking Lapangan</a>
    </div>
</div>