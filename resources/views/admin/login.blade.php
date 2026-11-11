<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Login Admin - Puskesmas Singaparna
    </title>

    <link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">

</head>


<body>


    <div class="admin-login-page">


        {{-- =========================================
        BAGIAN KIRI
        ========================================== --}}

        <div class="admin-login-left">

            <div class="admin-brand">

                <img src="{{ asset('image/logo-puskesmas.png') }}" alt="Logo Puskesmas Singaparna">

                <div>

                    <strong>
                        PUSKESMAS
                    </strong>

                    <span>
                        SINGAPARNA
                    </span>

                </div>

            </div>


            <div class="admin-welcome">

                <span>
                    SISTEM INFORMASI
                </span>

                <h1>
                    Selamat Datang,
                    <br>
                    Admin Puskesmas
                </h1>

                <p>
                    Kelola informasi, pelayanan, dan pengaduan
                    masyarakat Puskesmas Singaparna melalui
                    halaman administrator.
                </p>


                <div class="admin-features">

                    <div class="admin-feature">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <span>
                            Kelola Pengaduan Masyarakat
                        </span>

                    </div>


                    <div class="admin-feature">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <span>
                            Berikan Tanggapan
                        </span>

                    </div>


                    <div class="admin-feature">

                        <div class="feature-icon">
                            ✓
                        </div>

                        <span>
                            Pantau Status Pengaduan
                        </span>

                    </div>

                </div>

            </div>


            <div class="admin-copyright">

                © {{ date('Y') }}
                Puskesmas Singaparna

            </div>

        </div>



        {{-- =========================================
        BAGIAN KANAN
        ========================================== --}}

        <div class="admin-login-right">


            <div class="login-card">


                <div class="login-icon">
                    🔐
                </div>


                <div class="login-heading">

                    <span>
                        ADMINISTRATOR
                    </span>

                    <h2>
                        Login Admin
                    </h2>

                    <p>
                        Masuk untuk mengelola sistem
                        Puskesmas Singaparna.
                    </p>

                </div>


                {{-- =================================
                PESAN BERHASIL
                ================================== --}}

                @if(session('success'))

                    <div class="login-alert success">

                        <div class="alert-symbol">
                            ✓
                        </div>

                        <div>
                            {{ session('success') }}
                        </div>

                    </div>

                @endif


                {{-- =================================
                PESAN ERROR
                ================================== --}}

                @if(session('error'))

                    <div class="login-alert error">

                        <div class="alert-symbol">
                            !
                        </div>

                        <div>
                            {{ session('error') }}
                        </div>

                    </div>

                @endif


                {{-- =================================
                FORM LOGIN
                ================================== --}}

                <form action="{{ route('login.process') }}" method="POST" class="admin-login-form">

                    @csrf


                    {{-- EMAIL --}}

                    <div class="login-form-group">

                        <label for="email">
                            Email
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                ✉
                            </span>

                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="Masukkan email admin" autocomplete="email" required>

                        </div>


                        @error('email')

                            <small class="login-error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>



                    {{-- PASSWORD --}}

                    <div class="login-form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                🔒
                            </span>

                            <input type="password" id="password" name="password" placeholder="Masukkan password"
                                autocomplete="current-password" required>

                            <button type="button" class="password-toggle" onclick="togglePassword()"
                                aria-label="Tampilkan password">
                                👁
                            </button>

                        </div>


                        @error('password')

                            <small class="login-error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>



                    {{-- REMEMBER --}}

                    <div class="login-options">

                        <label class="remember-label">

                            <input type="checkbox" name="remember" value="1">

                            <span>
                                Ingat saya
                            </span>

                        </label>

                    </div>



                    {{-- BUTTON --}}

                    <button type="submit" class="login-submit">

                        <span>
                            Masuk ke Dashboard
                        </span>

                        <strong>
                            →
                        </strong>

                    </button>


                </form>


                {{-- KEMBALI KE WEBSITE --}}

                <a href="{{ url('/') }}" class="back-home">

                    ← Kembali ke Website

                </a>


            </div>

        </div>

    </div>



    <script>

        function togglePassword() {
            const password =
                document.getElementById('password');

            const button =
                document.querySelector('.password-toggle');


            if (password.type === 'password') {

                password.type = 'text';

                button.textContent = '🙈';

            } else {

                password.type = 'password';

                button.textContent = '👁';

            }
        }

    </script>


</body>

</html>