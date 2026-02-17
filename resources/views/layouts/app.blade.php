<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gor Jimmy - Sewa Lapangan Bulu Tangkis')</title>
    <link rel="stylesheet" href="{{ asset('user/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Header -->
    @include('layouts.header')
    
    <!-- Menu -->
    @include('layouts.menu')
    
    <!-- Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('layouts.footer')
    
    <!-- Scripts -->
    <script src="{{ asset('user/js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>