<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - GOR Jimmy</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/adminlte.min.css') }}">

    <style>
        :root {
            --primary: #1e3c72;
            --primary-dark: #152b52;
            --accent: #ff6b6b;
            --white: #ffffff;
            --bg-gradient: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .card-header {
            background: var(--white);
            border-bottom: none;
            padding: 30px 20px 10px;
        }

        .card-header h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: var(--primary);
            font-size: 24px;
        }

        .login-box-msg {
            color: #64748b;
            font-size: 14px;
            padding-bottom: 25px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 12px 15px;
            height: auto;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 60, 114, 0.1);
        }

        .input-group-text {
            background: transparent;
            border-left: none;
            color: #94a3b8;
            border-radius: 0 10px 10px 0;
            border-color: #e2e8f0;
        }

        .btn-primary {
            background: var(--bg-gradient);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3);
            filter: brightness(1.1);
        }

        .member-section {
            background: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .member-section p {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 15px;
        }

        .btn-member {
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none !important;
        }

        .btn-member:hover {
            background: var(--accent);
            color: var(--white);
            transform: translateY(-2px);
        }

        .icheck-primary label {
            font-weight: 400 !important;
            color: #64748b;
            font-size: 14px;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 20px;
            color: var(--white);
        }

        .brand-logo i {
            font-size: 40px;
            color: var(--accent);
        }

        .brand-logo h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            margin-top: 10px;
            letter-spacing: 1px;
        }
    </style>
</head>

<body class="hold-transition login-page">
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

    <div class="login-box">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="mb-0">Selamat Datang</h3>
            </div>

            <div class="card-body">
                <p class="login-box-msg">Silakan login ke akun Anda</p>
                <form action="{{ route('proses.login') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Ingat Saya</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-sign-in-alt mr-2"></i> Masuk Sekarang
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="member-section">
                <p>Belum punya akun member? Nikmati keuntungan eksklusif dengan mendaftar.</p>
                <a href="{{ route('register') }}" class="btn-member">
                    <i class="fas fa-id-card"></i> Daftar Member Baru
                </a>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" style="color: rgba(255,255,255,0.7); text-decoration: none; font-size: 14px;">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
