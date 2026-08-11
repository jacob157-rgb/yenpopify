<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Mazer Admin Dashboard</title>

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
            background: rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 22px;
            border: 1px solid rgba(255, 255, 255, .18);
            box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
            padding: 45px;
        }

        .left-panel {
            background: rgba(67, 94, 190, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, .15);

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            color: white;
            padding: 55px;
        }

        .left-panel img {
            width: 220px;
            margin-bottom: 35px;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, .3));
        }

        .left-panel h2 {
            font-size: 36px;
            font-weight: 700;
            margin-top: 10px;
        }

        .left-panel p {
            font-size: 18px;
            opacity: .9;
            text-align: center;
            max-width: 320px;
        }

        .form-control {
            border: none;
            border-radius: 12px;
            padding: 15px;
            background: rgba(255, 255, 255, .85);
        }

        .form-control:focus {
            box-shadow: none;
            background: white;
        }

        .btn-login {
            background: #435ebe;
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            transition: .3s;
        }

        .btn-login:hover {
            background: #3249a8;
            color: white;
        }

        .alert {
            border-radius: 10px;
        }

        @media(max-width:768px) {

            .left-panel {
                border-radius: 22px 22px 0 0;
                padding: 30px;
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

        <div class="row w-100 shadow-lg rounded-5 overflow-hidden" style="max-width:900px;">

            <div class="col-md-6 d-none d-md-flex flex-column justify-content-center align-items-center left-panel">

                <img src="{{ asset('Backend/assets/images/logo/logo.png') }}" alt="Logo">

                <h2>Yen Photo Tegal</h2>

                <p class="text-center mt-2">
                    Jl. Jend. A. Yani No.64, Mintaragen, Kec. Tegal Tim., Kota Tegal
                </p>

            </div>

            <div class="col-md-6">

                <div class="glass-card h-100 d-flex flex-column justify-content-center">

                    <h3 class="fw-bold mb-4 text-dark">
                        Hello, Again!
                    </h3>

                    {{-- Success Register --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error Login --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <input type="email" name="email" class="form-control form-control-lg"
                                placeholder="Email" value="{{ old('email') }}" required>

                        </div>

                        <div class="mb-3">

                            <input type="password" name="password" class="form-control form-control-lg"
                                placeholder="Password" required>

                        </div>

                        <div class="mb-4">

                            <button class="btn btn-login w-100 btn-lg">
                                Login
                            </button>

                        </div>

                        <div class="text-center">

                            <small class="text-white">

                                Belum punya akun?

                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">

                                    Daftar Sekarang

                                </a>

                            </small>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
