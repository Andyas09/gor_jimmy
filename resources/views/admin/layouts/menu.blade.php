<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #2a5298;">
  <!-- Brand Logo -->
  <a href="" class="brand-link text-center">
    <img src="{{ asset('logo.png') }}" alt="Logo" style="height: 50px; width: auto;">
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
        @if(Auth::user()->role === 'Admin')
          <li class="nav-item">
            <a href="" class="nav-link {{ ($Dashboard ?? '') == 'dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt text-white"></i>
              <p class="text-white">Dashboard</p>
            </a>
          </li>
          <!-- Lapangan -->
          <li class="nav-item">
            <a href="{{ route('lapangan.index') }}"
              class="nav-link {{ ($Lapangan ?? '') == 'lapangan' ? 'active' : '' }}">
              <i class="nav-icon fas fa-table-tennis"></i>
              <p class="text-white">Lapangan</p>
            </a>
          </li>
          <!-- Jadwal -->
          <li class="nav-item">
            <a href="{{ route('jadwal.index') }}" class="nav-link {{ ($Jadwal ?? '') == 'jadwal' ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p class="text-white">Jadwal & Slot Waktu</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="" class="nav-link {{ ($Harga ?? '') == 'harga' ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill"></i>
              <p class="text-white">Harga</p>
            </a>
          </li>

          <!-- Booking -->
          <li class="nav-item">
            <a href="{{ route('booking.index') }}" class="nav-link {{ ($Booking ?? '') == 'booking' ? 'active' : '' }}">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p class="text-white">Booking</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('galeri.index') }}" class="nav-link {{ ($Galeri ?? '') == 'galeri' ? 'active' : '' }}">
              <i class="nav-icon fas fa-images"></i>
              <p class="text-white">Galeri</p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link {{ ($User ?? '') == 'user' ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p class="text-white">User</p>
            </a>
          </li>
        @endif

        @if(Auth::user()->role === 'Member')
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ ($Dashboard ?? '') == 'dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p class="text-white">Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('booking.index') }}" class="nav-link {{ ($Booking ?? '') == 'booking' ? 'active' : '' }}">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p class="text-white">Booking Saya</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('profil.index') }}" class="nav-link  {{ ($Dashboard ?? '') == 'profil' ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-circle"></i>
              <p class="text-white">Profil Saya</p>
            </a>
          </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<script>
  function togglePosMenu(event) {
    event.preventDefault();
    let submenu = document.getElementById("subMenu");
    submenu.style.display = submenu.style.display === "none" ? "block" : "none";
  }

  function toggleStokMenu(event) {
    event.preventDefault();
    let submenu = document.getElementById("subMenuStok");
    submenu.style.display = (submenu.style.display === "none" || submenu.style.display === "")
      ? "block"
      : "none";
  }

</script>