<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register | Yen Photo Tegal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        body {
            position: relative;
        }

        .bg-image {
            background-image: url('{{ asset('image/bg.png') }}');
            background-size: cover;
            background-position: center;
            position: fixed;
            width: 100%;
            height: 100%;
            filter: brightness(.55) blur(6px);
            z-index: -2;
        }

        .bg-overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .15);
            z-index: -1;
        }

        .glass-card {
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 22px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .3);
            padding: 45px;
        }

        .left-panel {
            background: rgba(67, 94, 190, .18);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            padding: 55px;
            border-radius: 22px 0 0 22px;
        }

        .left-panel img {
            width: 220px;
            margin-bottom: 30px;
        }

        .left-panel h2 {
            font-weight: 700;
            margin-bottom: 15px;
        }

        .left-panel p {
            text-align: center;
            font-size: 18px;
            opacity: .9;
        }

        .form-control {
            border: none;
            border-radius: 12px;
            padding: 14px;
            background: rgba(255, 255, 255, .9);
        }

        .form-control:focus {
            background: white;
            box-shadow: none;
        }

        .btn-register {
            background: #435ebe;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            padding: 14px;
            transition: .3s;
        }

        .btn-register:hover {
            background: #3249a8;
            color: white;
        }

        .login-footer {
            color: rgba(255, 255, 255, .9);
        }

        .login-footer a {
            color: #6ea8fe;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            color: white;
        }

        .alert {
            border-radius: 10px;
        }

        @media(max-width:768px) {

            body {
                overflow: auto;
            }

            .left-panel {
                border-radius: 22px 22px 0 0;
                padding: 35px;
            }

            .glass-card {
                padding: 30px;
            }

        }
    </style>

</head>

<body>

    <div class="bg-image"></div>
    <div class="bg-overlay"></div>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <div class="row w-100 shadow-lg rounded-5 overflow-hidden" style="max-width:1000px;">

            <div class="col-md-6 d-none d-md-flex left-panel">

                <img src="{{ asset('Backend/assets/images/logo/logo.png') }}" alt="Logo">

                <h2>Yen Photo Tegal</h2>

                <p>
                    Bergabunglah sekarang dan nikmati kemudahan mengelola sistem administrasi Yen Photo.
                </p>

            </div>

            <div class="col-md-6">

                <div class="glass-card h-100">

                    <h3 class="fw-bold mb-4">Create Account</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <input type="text" name="name" class="form-control form-control-lg"
                                placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control form-control-lg"
                                placeholder="Email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control form-control-lg"
                                placeholder="Password" required>
                        </div>

                        <div class="mb-4">
                            <input type="password" name="password_confirmation" class="form-control form-control-lg"
                                placeholder="Konfirmasi Password" required>
                        </div>

                        <button class="btn btn-register w-100 btn-lg">
                            Daftar Sekarang
                        </button>

                    </form>

                    <div class="text-center mt-4 login-footer">

                        <small>

                            Sudah punya akun?

                            <a href="{{ route('login') }}">
                                Login Disini
                            </a>

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
