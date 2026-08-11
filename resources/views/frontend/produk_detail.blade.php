<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Electro - Electronics Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid px-5 py-4 d-none d-lg-block">
        <div class="row gx-0 align-items-center text-center">

            <!-- Kiri (Logo) -->
            <div class="col-md-4 col-lg-3 text-center text-lg-start">
                <div class="d-inline-flex align-items-center">
                    <a href="" class="navbar-brand p-0">
                        <h1 class="display-5 text-primary m-0">
                            <i class="fas fa-print text-secondary me-2"></i>YenPhoto
                        </h1>
                    </a>
                </div>
            </div>

            <!-- Tengah (Running Text) -->
            <div class="col-md-4 col-lg-6">
                <marquee behavior="scroll" direction="left" scrollamount="5" class="fw-bold text-primary">
                    Selamat datang di website pelayanan Yen Photo Tegal, silahkan melakukan login terlebih dahulu.
                </marquee>
            </div>

            <!-- Kanan (Login / User Menu) -->
            <div class="col-md-4 col-lg-3 text-center text-lg-end">
                <div class="d-inline-flex align-items-center">

                    {{-- Jika belum login --}}
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 py-2 me-3">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    @endguest

                    {{-- Jika sudah login --}}
                    @auth
                        <div class="dropdown me-3">
                            <a class="text-muted d-flex align-items-center justify-content-center dropdown-toggle"
                                href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span class="rounded-circle btn-md-square border">
                                    <i class="fas fa-user"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user-circle me-2"></i> Profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endauth

                </div>
            </div>

        </div>
    </div>
    <!-- Topbar End -->

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Single Product</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Single Product</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Products Start -->
    <div class="container-fluid product-detail-section py-5">
        <div class="container py-4">
            {{-- Tombol Kembali ke Halaman Utama --}}
            <div class="mb-4"> <a href="{{ url('/') }}" class="btn btn-back-home"> <i
                        class="fas fa-arrow-left me-2"></i> Kembali ke Halaman Utama </a> </div>

            <div class="row g-5">

                {{-- =========================
                BAGIAN GAMBAR PRODUK
            ========================== --}}
                <div class="col-lg-6">

                    <div class="product-image-card">

                        {{-- Badge --}}
                        <div class="product-badge">
                            <i class="fas fa-star me-1"></i> Produk Pilihan
                        </div>

                        {{-- Gambar --}}
                        <div class="product-main-image">
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                        </div>

                    </div>

                    {{-- Info kecil di bawah gambar --}}
                    <div class="row g-3 mt-2">

                        <div class="col-4">
                            <div class="feature-box">
                                <i class="fas fa-check-circle"></i>
                                <span>Produk Berkualitas</span>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-box">
                                <i class="fas fa-shipping-fast"></i>
                                <span>Pengiriman Aman</span>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="feature-box">
                                <i class="fas fa-headset"></i>
                                <span>Pelayanan Terbaik</span>
                            </div>
                        </div>

                    </div>

                </div>


                {{-- =========================
                BAGIAN DETAIL PRODUK
            ========================== --}}
                <div class="col-lg-6">

                    <div class="product-info-card">

                        {{-- Kategori --}}
                        <div class="mb-3">
                            <span class="category-badge">
                                <i class="fas fa-layer-group me-1"></i>
                                {{ $produk->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                            </span>
                        </div>

                        {{-- Nama Produk --}}
                        <h1 class="product-title">
                            {{ $produk->nama_produk }}
                        </h1>

                        {{-- Rating / Status --}}
                        <div class="product-meta mb-4">
                            <span>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </span>

                            <span class="ms-2 text-muted">
                                Produk berkualitas YenPhoto
                            </span>
                        </div>

                        {{-- Harga --}}
                        <div class="price-box mb-4">
                            <small>Harga mulai dari</small>

                            <div class="product-price">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </div>
                        </div>

                        {{-- Divider --}}
                        <hr class="my-4">

                        {{-- Deskripsi --}}
                        <div class="product-description mb-4">

                            <h5>
                                <i class="fas fa-info-circle me-2"></i>
                                Deskripsi Produk
                            </h5>

                            <p>
                                {{ $produk->deskripsi ?: 'Belum ada deskripsi untuk produk ini.' }}
                            </p>

                        </div>

                        {{-- Keunggulan --}}
                        <div class="product-benefits mb-4">

                            <div class="benefit-item">
                                <i class="fas fa-check"></i>
                                <span>Kualitas cetak terbaik</span>
                            </div>

                            <div class="benefit-item">
                                <i class="fas fa-check"></i>
                                <span>Proses pemesanan mudah</span>
                            </div>

                            <div class="benefit-item">
                                <i class="fas fa-check"></i>
                                <span>Dapat melakukan upload desain</span>
                            </div>

                        </div>

                        {{-- Security / Payment --}}
                        <div class="secure-info mt-4">

                            <div>
                                <i class="fas fa-shield-alt"></i>
                                <span>Pemesanan aman</span>
                            </div>

                            <div>
                                <i class="fas fa-credit-card"></i>
                                <span>Pembayaran mudah</span>
                            </div>

                            <div>
                                <i class="fas fa-truck"></i>
                                <span>Pengiriman tersedia</span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================
            DESKRIPSI DETAIL
        ========================== --}}
            <div class="row mt-5">

                <div class="col-12">

                    <div class="description-card">

                        <div class="description-header">
                            <i class="fas fa-file-alt"></i>

                            <div>
                                <h4>Informasi Produk</h4>
                                <p>Informasi lengkap mengenai produk</p>
                            </div>
                        </div>

                        <div class="description-content">
                            {{ $produk->deskripsi ?: 'Informasi produk belum tersedia.' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Single Products End -->


    <style>
        /* ==============================
       PRODUCT DETAIL
    =============================== */

        .product-detail-section {
            background: #f8f9fc;
        }


        /* ==============================
       IMAGE
    =============================== */

        .product-image-card {
            position: relative;
            background: #ffffff;
            border-radius: 25px;
            padding: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .07);
            overflow: hidden;
        }

        .product-main-image {
            height: 500px;
            border-radius: 18px;
            overflow: hidden;
            background: #f5f6f8;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .5s;
        }

        .product-main-image:hover img {
            transform: scale(1.04);
        }

        .product-badge {
            position: absolute;
            top: 35px;
            left: 35px;
            z-index: 2;

            background: #0d6efd;
            color: white;

            padding: 8px 15px;
            border-radius: 50px;

            font-size: 13px;
            font-weight: 600;

            box-shadow: 0 5px 15px rgba(13, 110, 253, .3);
        }


        /* ==============================
       FEATURE BOX
    =============================== */

        .feature-box {
            background: #ffffff;
            border-radius: 15px;
            padding: 15px 8px;

            text-align: center;

            box-shadow: 0 5px 20px rgba(0, 0, 0, .05);

            height: 100%;
        }

        .feature-box i {
            display: block;
            color: #0d6efd;
            font-size: 20px;
            margin-bottom: 7px;
        }

        .feature-box span {
            font-size: 11px;
            color: #555;
            font-weight: 600;
        }

        ```css
        /* ==============================
   BACK TO HOME BUTTON
=============================== */

        .btn-back-home {
            display: inline-flex;
            align-items: center;

            background: #ffffff;
            color: #0d6efd;

            border: 1px solid #e2e6ea;

            padding: 10px 18px;

            border-radius: 50px;

            font-size: 14px;
            font-weight: 600;

            box-shadow: 0 5px 15px rgba(0, 0, 0, .05);

            transition: all .3s ease;
        }

        .btn-back-home i {
            transition: transform .3s ease;
        }

        .btn-back-home:hover {
            background: #0d6efd;
            color: #ffffff;

            border-color: #0d6efd;

            transform: translateX(-3px);

            box-shadow: 0 8px 20px rgba(13, 110, 253, .2);
        }

        .btn-back-home:hover i {
            transform: translateX(-4px);
        }

        /* ==============================
       PRODUCT INFO
    =============================== */

        .product-info-card {
            background: #ffffff;
            border-radius: 25px;
            padding: 35px;

            box-shadow: 0 10px 40px rgba(0, 0, 0, .07);

            height: 100%;
        }

        .category-badge {
            display: inline-flex;
            align-items: center;

            background: rgba(13, 110, 253, .1);
            color: #0d6efd;

            padding: 7px 14px;
            border-radius: 50px;

            font-size: 13px;
            font-weight: 600;
        }

        .product-title {
            font-size: 38px;
            font-weight: 700;
            line-height: 1.2;
            color: #222;

            margin-bottom: 12px;
        }

        .product-meta {
            font-size: 14px;
        }


        /* ==============================
       PRICE
    =============================== */

        .price-box {
            background: linear-gradient(135deg,
                    rgba(13, 110, 253, .08),
                    rgba(13, 110, 253, .02));

            border-left: 4px solid #0d6efd;

            padding: 15px 20px;
            border-radius: 12px;
        }

        .price-box small {
            color: #777;
            font-size: 12px;
        }

        .product-price {
            font-size: 32px;
            font-weight: 800;
            color: #0d6efd;
            margin-top: 3px;
        }


        /* ==============================
       DESCRIPTION
    =============================== */

        .product-description h5 {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .product-description h5 i {
            color: #0d6efd;
        }

        .product-description p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 0;
        }


        /* ==============================
       BENEFITS
    =============================== */

        .benefit-item {
            display: flex;
            align-items: center;

            margin-bottom: 10px;

            color: #555;
            font-size: 14px;
        }

        .benefit-item i {
            width: 22px;
            height: 22px;

            background: #e8f3ff;
            color: #0d6efd;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 10px;

            margin-right: 10px;
        }


        /* ==============================
       BUTTON
    =============================== */

        .product-actions {
            display: flex;
            gap: 12px;
        }

        .btn-cart,
        .btn-order {
            flex: 1;

            padding: 14px 18px;

            border-radius: 12px;

            font-weight: 600;

            transition: .3s;
        }

        .btn-cart {
            background: #ffffff;
            border: 2px solid #0d6efd;
            color: #0d6efd;
        }

        .btn-cart:hover {
            background: #0d6efd;
            color: white;
            transform: translateY(-2px);
        }

        .btn-order {
            background: #0d6efd;
            color: white;
            border: 2px solid #0d6efd;
        }

        .btn-order:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 110, 253, .25);
        }


        /* ==============================
       SECURE INFO
    =============================== */

        .secure-info {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;

            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .secure-info div {
            display: flex;
            align-items: center;

            font-size: 12px;
            color: #777;
        }

        .secure-info i {
            color: #0d6efd;
            margin-right: 6px;
        }


        /* ==============================
       DESCRIPTION CARD
    =============================== */

        .description-card {
            background: #ffffff;

            border-radius: 20px;

            padding: 30px;

            box-shadow: 0 8px 30px rgba(0, 0, 0, .06);
        }

        .description-header {
            display: flex;
            align-items: center;

            gap: 15px;

            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .description-header>i {
            width: 50px;
            height: 50px;

            border-radius: 15px;

            background: #eaf3ff;
            color: #0d6efd;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 20px;
        }

        .description-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .description-header p {
            margin: 3px 0 0;
            color: #888;
            font-size: 13px;
        }

        .description-content {
            padding-top: 20px;

            color: #666;
            line-height: 1.9;
        }


        /* ==============================
       RESPONSIVE
    =============================== */

        @media (max-width: 991px) {

            .product-main-image {
                height: 400px;
            }

            .product-title {
                font-size: 30px;
            }

        }


        @media (max-width: 576px) {

            .product-info-card {
                padding: 25px 20px;
            }

            .product-main-image {
                height: 300px;
            }

            .product-title {
                font-size: 26px;
            }

            .product-price {
                font-size: 26px;
            }

            .product-actions {
                flex-direction: column;
            }

            .secure-info {
                flex-direction: column;
            }

        }
    </style>


    <!-- Single Products End -->

    <!-- Floating Cart Button -->
    <div id="floatingCartBtn"
        style="position: fixed; bottom: 25px; right: 25px; width: 60px; height: 60px;
            background: #0d6efd; color:white; border-radius: 50%;
            display: none; align-items:center; justify-content:center;
            cursor:pointer; z-index:999;">
        <i class="bi bi-cart fs-3"></i>
    </div>
    <!-- Floating Cart Button End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/lightbox/js/lightbox.min.js') }}"></script>


    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>
