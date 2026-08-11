<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YENPOP - TEGAL</title>
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
    <link href="{{ asset('Frontend/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('Frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('Frontend/css/style.css') }}" rel="stylesheet">

    {{-- alamat --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        #floatingCartBtn {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            display: none;
        }

        .shipping-card {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 18px;
            border-radius: 16px;
            border: 2px solid #ececec;
            background: #fff;
            cursor: pointer;
            transition: all .25s ease;
            margin-bottom: 15px;
        }

        .shipping-card:hover {
            border-color: #ffc107;
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, .08);
        }

        .shipping-card.active {
            border-color: #ffc107;
            background: #fff8e8;
        }

        .shipping-card .icon {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #fff3cd;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
        }
    </style>


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
                    <a href="" class="navbar-brand p-0 d-flex align-items-center">
                        <img src="{{ asset('Frontend/img/yen.png') }}" alt="YenPhoto Logo" class="me-2"
                            style="height: 45px; width: auto;">

                        <h1 class="display-6 m-0">
                            <span style="color: red;">Yen</span>
                            <span style="color: blue;">Photo</span>
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
                                    <a class="dropdown-item" href="{{ route('frontend.histori.index') }}">
                                        <i class="fas fa-history me-2"></i> Histori Pesanan
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

            <!-- Modal Pop up -->
            <div class="modal fade" id="welcomeModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 bg-transparent">

                        <div class="modal-body p-0 position-relative text-center">

                            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 bg-white"
                                data-bs-dismiss="modal">
                            </button>

                            <img src="{{ asset('Frontend/img/order.png') }}" alt="Poster" class="img-fluid rounded"
                                style="max-height: 80vh; width: auto;">
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- Topbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid carousel bg-light px-0">
        <div class="row g-0 justify-content-end">
            <div class="col-12 col-lg-7 col-xl-9">
                <div class="header-carousel owl-carousel bg-light py-5">

                    <!-- Slide 1 -->
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="{{ asset('Frontend/img/carousel-1.png') }}" class="img-fluid w-100"
                                alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Diskon Hingga 40%</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">
                                Cetak Banner, Spanduk & Media Promosi
                            </h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">
                                Hasil cetak tajam, bahan berkualitas, pengerjaan cepat.
                            </p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="#">Pesan Sekarang</a>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="row g-0 header-carousel-item align-items-center">
                        <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                            <img src="{{ asset('Frontend/img/carousel-2.png') }}" class="img-fluid w-100"
                                alt="Image">
                        </div>
                        <div class="col-xl-6 carousel-content p-4">
                            <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s"
                                style="letter-spacing: 3px;">Mulai dari Rp 20.000</h4>
                            <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">
                                Cetak Kartu Nama & Undangan
                            </h1>
                            <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">
                                Tersedia berbagai pilihan bahan premium & finishing elegan.
                            </p>
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s"
                                href="#">Lihat Produk</a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Side Banner -->
            <div class="col-12 col-lg-5 col-xl-3 wow fadeInRight" data-wow-delay="0.1s">
                <div class="carousel-header-banner h-100">
                    <img src="{{ asset('Frontend/img/header-img.jpg') }}" class="img-fluid w-100 h-100"
                        style="object-fit: cover;" alt="Image">

                    <div class="carousel-banner-offer">
                        <p class="bg-primary text-white rounded fs-5 py-2 px-4 mb-0 me-3">Best Quality</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Carousel End -->

    <!-- Searvices Start -->
    <div class="container-fluid px-0">
        <div class="row g-0">

            <div class="col-6 col-md-4 col-lg-2 border-start border-end wow fadeInUp" data-wow-delay="0.1s">
                <div class="p-4">
                    <div class="d-inline-flex align-items-center">
                        <i class="fa fa-sync-alt fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Revisi Gratis</h6>
                            <p class="mb-0">Garansi revisi hingga puas!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.2s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-telegram-plane fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Pengiriman Cepat</h6>
                            <p class="mb-0">Cetak & kirim ke seluruh Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.3s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-life-ring fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Bantuan 24/7</h6>
                            <p class="mb-0">Layanan CS responsif kapan saja</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.4s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-credit-card fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Harga Terjangkau</h6>
                            <p class="mb-0">Cetak murah untuk semua kebutuhan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.5s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Pembayaran Aman</h6>
                            <p class="mb-0">Transaksi nyaman & terpercaya</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.6s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-blog fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Layanan Online</h6>
                            <p class="mb-0">Pesan cetak kapan saja & dimana saja</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Searvices End -->

    <!-- Products Offer Start -->
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row g-4">

                <!-- Banner Flexi -->
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <a href="#"
                        class="d-flex align-items-center justify-content-between border bg-white rounded p-4 shadow-sm">
                        <div>
                            <p class="text-muted mb-3">Solusi media promosi yang kuat dan tahan lama</p>
                            <h3 class="text-primary">Banner Flexi Premium</h3>
                            <h1 class="display-3 text-secondary mb-0">
                                Mulai <span class="text-primary fw-normal">18.000</span>
                            </h1>
                        </div>
                        <img src="img/product-1.png" class="img-fluid" alt="">
                    </a>
                </div>

                <!-- Kalender -->
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <a href="#"
                        class="d-flex align-items-center justify-content-between border bg-white rounded p-4 shadow-sm">
                        <div>
                            <p class="text-muted mb-3">Desain eksklusif untuk kebutuhan kantor & branding</p>
                            <h3 class="text-primary">Kalender Custom</h3>
                            <h1 class="display-3 text-secondary mb-0">
                                Mulai <span class="text-primary fw-normal">10.000</span>
                            </h1>
                        </div>
                        <img src="img/product-2.png" class="img-fluid" alt="">
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- Products Offer End -->


    <!-- Our Products Start -->
    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="tab-class">
                <div class="row g-4">
                    <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                        <h1>Our Products</h1>
                    </div>
                    <div class="col-lg-8 text-end wow fadeInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            {{-- All Products --}}
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                    href="#tab-all">
                                    <span class="text-dark" style="width: 130px;">All Products</span>
                                </a>
                            </li>

                            {{-- Loop kategori --}}
                            @foreach ($kategoris as $kategori)
                                <li class="nav-item mb-4">
                                    <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill"
                                        href="#tab-{{ $kategori->id }}">
                                        <span class="text-dark"
                                            style="width: 130px;">{{ $kategori->nama_kategori }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="tab-content">
                    {{-- All Products --}}
                    <div id="tab-all" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @forelse ($produks as $produk)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <img src="{{ asset('storage/' . $produk->gambar) }}"
                                                    class="img-fluid w-100 rounded-top"
                                                    alt="{{ $produk->nama_produk }}">
                                                <div class="product-details">
                                                    <a href="{{ route('frontend.produk.show', $produk->id) }}"><i
                                                            class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center rounded-bottom p-4">
                                                <a href="#"
                                                    class="d-block mb-2">{{ $produk->kategori->nama_kategori ?? '-' }}</a>
                                                <a href="{{ route('frontend.produk.show', $produk->id) }}"
                                                    class="d-block h5">{{ $produk->nama_produk }}</a>
                                                <span class="text-primary fs-5">Rp
                                                    {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                        <div
                                            class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                            <a href="javascript:void(0)"
                                                class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 btnAddToCart"
                                                data-id="{{ $produk->id }}" data-nama="{{ $produk->nama_produk }}"
                                                data-harga="{{ $produk->harga }}">
                                                <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">Belum ada produk tersedia.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Produk berdasarkan kategori --}}
                    @foreach ($kategoris as $kategori)
                        <div id="tab-{{ $kategori->id }}" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                @forelse ($kategori->produks as $produk)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="product-item-inner border rounded">
                                                <div class="product-item-inner-item">
                                                    <img src="{{ asset('storage/' . $produk->gambar) }}"
                                                        class="img-fluid w-100 rounded-top"
                                                        alt="{{ $produk->nama_produk }}">
                                                    <div class="product-details">
                                                        <a href="{{ route('frontend.produk.show', $produk->id) }}"><i
                                                                class="fa fa-eye fa-1x"></i></a>
                                                    </div>
                                                </div>
                                                <div class="text-center rounded-bottom p-4">
                                                    <a href="#"
                                                        class="d-block mb-2">{{ $kategori->nama_kategori }}</a>
                                                    <a href="{{ route('frontend.produk.show', $produk->id) }}"
                                                        class="d-block h5">{{ $produk->nama_produk }}</a>
                                                    <span class="text-primary fs-5">Rp
                                                        {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                            <div
                                                class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                                <a href="javascript:void(0)"
                                                    class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 btnAddToCart"
                                                    data-id="{{ $produk->id }}"
                                                    data-nama="{{ $produk->nama_produk }}"
                                                    data-harga="{{ $produk->harga }}">
                                                    <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center">Tidak ada produk di kategori ini.</p>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Our Products End -->

    <!-- Bestseller Products Start -->
    <div class="container-fluid products pb-5">
        <div class="container products-mini py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 700px;">
                <h4
                    class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">
                    Bestseller Products
                </h4>
                <p class="mb-0">Produk paling banyak dibeli oleh customer.</p>
            </div>

            <div class="row g-4">
                @foreach ($bestseller as $item)
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="products-mini-item border shadow-sm rounded">
                            <div class="row g-0">
                                <div class="col-5">
                                    <div class="products-mini-img border-end h-100 position-relative">
                                        <img src="{{ asset('storage/' . $item->gambar) }}"
                                            class="img-fluid w-100 h-100" alt="{{ $item->nama_produk }}">

                                        <div class="products-mini-icon rounded-circle bg-primary">
                                            <a href="{{ route('frontend.produk.show', $item->id) }}">
                                                <i class="fa fa-eye text-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class="products-mini-content p-3">
                                        <span class="d-block mb-1 text-secondary small">
                                            {{ $item->kategori->nama_kategori ?? 'Kategori' }}
                                        </span>

                                        <a href="{{ route('frontend.produk.show', $item->id) }}" class="h5 d-block">
                                            {{ $item->nama_produk }}
                                        </a>

                                        <span class="text-primary fs-5">
                                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="products-mini-add border p-3 d-flex justify-content-between align-items-center">
                                <button class="btn btn-primary rounded-pill py-2 px-4 addCart"
                                    data-id="{{ $item->id }}">
                                    <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                </button>

                                <span class="badge bg-success">
                                    Terjual: {{ $item->total_terjual ?? 0 }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>

    <!-- Bestseller Products End -->


    <!-- Footer Start -->
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">
            <div class="row g-4 rounded mb-5" style="background: rgba(255, 255, 255, .03);">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Address</h4>
                            <p class="mb-2">Jl. Jend. A. Yani, Mintaragen</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fas fa-envelope fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Mail Us</h4>
                            <p class="mb-2">yenpop@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fa fa-phone-alt fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Telephone</h4>
                            <p class="mb-2">(0283) 4535900</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="rounded p-4">
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4"
                            style="width: 70px; height: 70px;">
                            <i class="fab fa-firefox-browser fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h4 class="text-white">yenpoptegal.com</h4>
                            <p class="mb-2">(0283) 4535900</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-start mb-md-0">
                    <span class="text-white"><a href="#" class="border-bottom text-white"><i
                                class="fas fa-copyright text-light me-2"></i>Yen Photo Tegal</a>, All right
                        reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end text-white">
                    Created By <a class="border-bottom text-white" href="#">Cynhia dan Citra</a>.
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>

    <button id="floatingCartBtn" class="btn btn-lg btn-warning rounded-pill shadow">
        <i class="fas fa-shopping-cart"></i>
        <span id="cartCount" class="badge bg-danger ms-2">0</span>
    </button>

    {{-- Modal Keranjang --}}
    <div class="modal fade" id="cartModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 22px; overflow: hidden;">

                {{-- HEADER --}}
                <div class="modal-header" style="background: linear-gradient(135deg, #1f1f1f, #3b3b3b);">
                    <h5 class="modal-title text-white fw-semibold">
                        <i class="bi bi-bag-check-fill me-2"></i> Keranjang Belanja
                    </h5>
                    <button class="btn-close btn-close-white shadow-sm" data-bs-dismiss="modal"></button>
                </div>

                {{-- BODY --}}
                <div class="modal-body p-4" style="background: #fafafa;">

                    {{-- CART TABLE --}}
                    <div class="table-responsive rounded-4 shadow-sm mb-4"
                        style="border: 1px solid #e5e5e5; overflow: hidden;">
                        <table class="table table-hover align-middle mb-0" id="cartTable">
                            <thead style="background: #f3f3f3;">
                                <tr>
                                    <th class="py-3">Produk</th>
                                    <th class="text-center py-3">Harga</th>
                                    <th class="text-center py-3">Qty</th>
                                    <th class="text-end py-3">Total</th>
                                    <th class="text-center py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Injected by JS --}}
                            </tbody>
                        </table>
                    </div>

                    {{-- SUBTOTAL --}}
                    <div class="d-flex justify-content-between align-items-center px-1 mb-3">
                        <span class="fw-semibold fs-5 text-secondary">Subtotal:</span>
                        <span id="cartSubtotal" class="fw-bold fs-4 text-dark">Rp 0</span>
                    </div>

                    <hr class="my-4">

                    {{-- INPUT NO HP --}}
                    <div class="mb-3">
                        <label class="fw-semibold text-secondary">Nomor HP</label>
                        <input type="text" id="checkoutHp" class="form-control shadow-sm"
                            style="border-radius: 12px;" placeholder="Masukkan nomor HP pelanggan...">
                    </div>

                    {{-- INPUT CATATAN --}}
                    <div class="mb-4">
                        <label for="checkoutNote" class="fw-semibold text-secondary">Catatan</label>
                        <textarea id="checkoutNote" class="form-control shadow-sm" rows="2" style="border-radius: 12px;"
                            placeholder="Contoh: cetak dengan ukuran 100m x 100m"></textarea>
                    </div>

                    <hr class="my-4">

                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-truck me-2 text-warning"></i>
                        Metode Pengiriman
                    </h5>

                    <label class="shipping-card active">

                        <input type="radio" name="metode_pengiriman" value="ambil_toko" checked hidden>

                        <div class="icon">
                            🏪
                        </div>

                        <div>

                            <strong>Ambil di Studio</strong>

                            <div class="text-muted">
                                Gratis
                            </div>

                        </div>

                    </label>

                    <label class="shipping-card">

                        <input type="radio" name="metode_pengiriman" value="gosend" hidden>

                        <div class="icon">
                            🚚
                        </div>

                        <div>

                            <strong>Antar ke Rumah</strong>

                            <div class="text-muted">
                                Ongkir dihitung otomatis
                            </div>

                        </div>

                    </label>

                    <div id="pengirimanSection" style="display:none;">

                        <hr>

                        <h6 class="fw-bold">
                            📍 Lokasi Pengiriman
                        </h6>

                        <div id="map"
                            style="
height:350px;
border-radius:15px;
border:2px solid #ddd;
overflow:hidden;">
                        </div>

                        <div class="alert alert-light mt-3">
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                            <input type="hidden" id="jarak" name="jarak_km">
                            <input type="hidden" id="ongkir" name="ongkir">
                            <input type="hidden" id="alamat" name="alamat_pengiriman">

                            <div>

                                <strong>Alamat</strong>

                                <p id="alamatText" class="text-muted mb-0">
                                    Silakan pilih lokasi pada peta
                                </p>

                            </div>

                            <div class="row">

                                <div class="col">

                                    <strong>Jarak</strong>

                                    <p>
                                        <span id="jarakText">
                                            0
                                        </span>

                                        KM
                                    </p>

                                </div>

                                <div class="col">

                                    <strong>Ongkir</strong>

                                    <p id="ongkirInfo">
                                        Rp0
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="card border-0 shadow-sm">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">

                                <span>Subtotal</span>

                                <strong id="subtotalRingkasan">
                                    Rp 0
                                </strong>

                            </div>

                            <div class="d-flex justify-content-between mt-2">

                                <span>Ongkir</span>

                                <strong id="ongkirText">
                                    Rp 0
                                </strong>

                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">

                                <h5>Total</h5>

                                <h5 id="cartTotal">
                                    Rp 0
                                </h5>

                            </div>

                        </div>

                    </div>
                    <div class="mt-4">

                        {{-- BUTTON CHECKOUT --}}
                        <button class="btn w-100 py-3 fw-bold shadow-sm" id="btnCheckout"
                            style="border-radius: 14px; background: #000; color: white; transition: .2s;">
                            <i class="bi bi-arrow-right-circle me-2"></i> Pesan Sekarang
                        </button>

                    </div>

                </div>
            </div>
        </div>

        <script>
            const IS_LOGGED_IN = @json(Auth::check());
            const LOGIN_URL = "{{ route('login') }}";
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('Frontend/lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('Frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>


        <!-- Template Javascript -->
        <script src="{{ asset('Frontend/js/main.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let myModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
                myModal.show();
            });
        </script>
        <script>
            let ongkir = 0;

            function hitungTotalDenganOngkir() {

                const cart = JSON.parse(localStorage.getItem("cart")) || [];

                let subtotal = 0;

                cart.forEach(item => {
                    subtotal += item.harga * item.qty;
                });

                document.getElementById("ongkirText").innerHTML =
                    "Rp " + ongkir.toLocaleString();

                document.getElementById("cartTotal").innerHTML =
                    "Rp " + (subtotal + ongkir).toLocaleString();
            }
            document.addEventListener('DOMContentLoaded', function() {

                // ---------------------
                // UTIL
                // ---------------------
                function loadCart() {
                    let raw = localStorage.getItem("cart");
                    try {
                        let data = JSON.parse(raw);
                        return Array.isArray(data) ? data : [];
                    } catch (e) {
                        return [];
                    }
                }

                function saveCart(cart) {
                    if (!Array.isArray(cart)) cart = [];
                    localStorage.setItem("cart", JSON.stringify(cart));
                }

                function cartTotalItems() {
                    return loadCart().reduce((acc, it) => acc + (it.qty || 0), 0);
                }

                function updateCartCount() {
                    const count = cartTotalItems();
                    const el = document.getElementById('cartCount');
                    if (el) el.innerText = count;

                    const btn = document.getElementById('floatingCartBtn');
                    if (btn) btn.style.display = count > 0 ? 'block' : 'none';
                }

                // ---------------------
                // UPDATE CART TABLE (NEW)
                // ---------------------
                function updateCartTable() {
                    const cart = loadCart();
                    const tbody = document.querySelector('#cartTable tbody');
                    const subtotalEl = document.getElementById('cartSubtotal');

                    if (!tbody) return;

                    tbody.innerHTML = '';
                    let subtotal = 0;

                    cart.forEach(item => {
                        const total = item.harga * item.qty;
                        subtotal += total;

                        const row = document.createElement('tr');
                        row.innerHTML = `
                <td>${item.nama}</td>
                <td class="text-center">Rp ${Number(item.harga).toLocaleString()}</td>

                <td class="text-center">
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <button class="btn btn-sm btn-outline-dark btnQtyMinus" data-id="${item.id}" style="border-radius:50%;">
                            <i class="bi bi-dash"></i>
                        </button>

                        <span class="fw-semibold cartQtyValue">${item.qty}</span>

                        <button class="btn btn-sm btn-outline-dark btnQtyPlus" data-id="${item.id}" style="border-radius:50%;">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                </td>

                <td class="text-end fw-semibold">Rp ${total.toLocaleString()}</td>

                <td class="text-center">
                    <button class="btn btn-sm btn-danger btnRemoveItem" data-id="${item.id}">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;

                        tbody.appendChild(row);
                    });

                    subtotalEl.innerText = "Rp " + subtotal.toLocaleString();

                    const subtotalRingkasan =
                        document.getElementById("subtotalRingkasan");

                    if (subtotalRingkasan) {

                        subtotalRingkasan.innerText =
                            "Rp " + subtotal.toLocaleString();

                    }

                    attachQtyListeners();
                    // 🔴 TAMBAHAN (AMAN)
                    hitungTotalDenganOngkir();
                }

                // ---------------------
                // PLUS / MINUS HANDLER
                // ---------------------
                function attachQtyListeners() {

                    // +
                    document.querySelectorAll('.btnQtyPlus').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const id = this.dataset.id;
                            let cart = loadCart();
                            let item = cart.find(i => i.id == id);

                            if (item) {
                                item.qty++;
                                saveCart(cart);
                                updateCartTable();
                                updateCartCount();
                            }
                        });
                    });

                    // -
                    document.querySelectorAll('.btnQtyMinus').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const id = this.dataset.id;
                            let cart = loadCart();
                            let item = cart.find(i => i.id == id);

                            if (item && item.qty > 1) {
                                item.qty--;
                            } else {
                                cart = cart.filter(i => i.id != id);
                            }

                            saveCart(cart);
                            updateCartTable();
                            updateCartCount();
                        });
                    });

                    // REMOVE ITEM
                    document.querySelectorAll('.btnRemoveItem').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const id = this.dataset.id;

                            let cart = loadCart().filter(i => i.id != id);

                            saveCart(cart);
                            updateCartTable();
                            updateCartCount();
                        });
                    });
                }

                // ---------------------
                // SWAL SUCCESS
                // ---------------------
                function showSuccess(msg) {
                    if (window.Swal && typeof Swal.fire === 'function') {
                        Swal.fire({
                            title: 'Berhasil',
                            text: msg,
                            icon: 'success',
                            timer: 1100,
                            showConfirmButton: false
                        });
                    } else {
                        console.log('SUCCESS:', msg);
                    }
                }

                // ---------------------
                // ADD TO CART BUTTON
                // ---------------------
                const addBtns = document.querySelectorAll('.btnAddToCart');
                if (addBtns.length) {
                    addBtns.forEach(btn => {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();

                            if (!IS_LOGGED_IN) {
                                Swal.fire({
                                    title: 'Harus Login',
                                    text: 'Silahkan login terlebih dahulu untuk menambah ke keranjang.',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Login',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = LOGIN_URL;
                                    }
                                });
                                return;
                            }

                            const id = this.dataset.id;
                            const nama = this.dataset.nama;
                            const harga = parseInt(this.dataset.harga || 0);

                            let cart = loadCart();
                            let existing = cart.find(i => String(i.id) === String(id));

                            if (existing) {
                                existing.qty = (existing.qty || 0) + 1;
                            } else {
                                cart.push({
                                    id,
                                    nama,
                                    harga,
                                    qty: 1
                                });
                            }

                            saveCart(cart);
                            updateCartCount();
                            showSuccess('Produk ditambahkan ke keranjang');
                        });
                    });
                }

                // ---------------------
                // OPEN CART MODAL
                // ---------------------
                const floating = document.getElementById('floatingCartBtn');
                if (floating) {
                    floating.addEventListener('click', function() {
                        updateCartTable();
                        const modalEl = document.getElementById('cartModal');
                        if (modalEl) new bootstrap.Modal(modalEl).show();
                    });
                }

                // ---------------------
                // CHECKOUT (WITH CATATAN)
                // ---------------------
                const btnCheckout = document.getElementById('btnCheckout');
                if (btnCheckout) {
                    btnCheckout.addEventListener('click', function() {

                        const noHp = (document.getElementById('checkoutHp') || {}).value || '';
                        const note = (document.getElementById('checkoutNote') || {}).value || '';
                        const cart = loadCart();
                        const metode = document.querySelector(
                            'input[name="metode_pengiriman"]:checked'
                        ).value;
                        const alamat = document.getElementById("alamat").value;

                        if (!cart.length) {
                            alert('Keranjang kosong');
                            return;
                        }
                        if (!noHp.trim()) {
                            alert('Nomor HP wajib diisi');
                            return;
                        }
                        if (metode === 'gosend' && !alamat.trim()) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Alamat belum diisi',
                                text: 'Mohon isi alamat pengiriman untuk GoSend'
                            });
                            return;
                        }
                        btnCheckout.disabled = true;


                        fetch("{{ route('frontend.transaksi.store') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({

                                    no_hp: noHp,
                                    catatan: note,
                                    produk: cart,

                                    metode_pengiriman: metode,
                                    alamat_pengiriman: alamat,

                                    latitude: document.getElementById("latitude").value,
                                    longitude: document.getElementById("longitude").value,
                                    jarak_km: document.getElementById("jarak").value,

                                    ongkir: ongkir

                                })
                            })
                            .then(r => r.json())
                            .then(res => {

                                console.log(res);

                                if (res && res.success) {

                                    showSuccess('Pesanan berhasil dikirim');

                                    localStorage.removeItem('cart');
                                    updateCartCount();
                                    updateCartTable();

                                    const modalEl = document.getElementById('cartModal');
                                    const modal = bootstrap.Modal.getInstance(modalEl);

                                    if (modal) modal.hide();

                                    setTimeout(() => {
                                        window.location.href = res.redirect_url;
                                    }, 900);

                                } else {

                                    console.log(res);

                                    alert(res.error ?? res.message);

                                }

                            })
                            .catch(err => {
                                console.error(err);
                                alert('Terjadi error. Cek console network / response.');
                            })
                            .finally(() => {
                                btnCheckout.disabled = false;
                            });
                    });
                }

                const totalText = document.getElementById("cartTotal");
                const ongkirText = document.getElementById("ongkirText");


                // INIT
                updateCartCount();
            });
            let map;
            let marker;

            const studioLat = -6.86176699313674;
            const studioLng = 109.13454647399689;

            document.querySelectorAll('input[name="metode_pengiriman"]').forEach(radio => {

                radio.addEventListener('change', function() {

                    document.querySelectorAll('.shipping-card').forEach(card => {
                        card.classList.remove('active');
                    });

                    this.closest('.shipping-card').classList.add('active');

                    if (this.value === "gosend") {

                        document.getElementById("pengirimanSection").style.display = "block";

                        initMap();

                    } else {

                        document.getElementById("pengirimanSection").style.display = "none";

                    }

                });

            });

            function initMap() {

                if (map) return;

                map = L.map('map').setView([studioLat, studioLng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap'
                }).addTo(map);

                marker = L.marker([studioLat, studioLng], {
                    draggable: true
                }).addTo(map);

                marker.on('dragend', async function() {

                    const posisi = marker.getLatLng();

                    document.getElementById("latitude").value = posisi.lat;
                    document.getElementById("longitude").value = posisi.lng;

                    //---------------------------------------
                    // Hitung jarak dari studio
                    //---------------------------------------

                    const jarakMeter = map.distance(
                        [studioLat, studioLng],
                        [posisi.lat, posisi.lng]
                    );

                    const jarakKm = jarakMeter / 1000;

                    document.getElementById("jarak").value = jarakKm.toFixed(2);

                    document.getElementById("jarakText").innerHTML =
                        jarakKm.toFixed(2);

                    //---------------------------------------
                    // Hitung ongkir
                    //---------------------------------------

                    ongkir = Math.ceil(jarakKm) * 3000;

                    document.getElementById("ongkir").value = ongkir;

                    document.getElementById("ongkirInfo").innerHTML =
                        "Rp " + ongkir.toLocaleString();
                    document.getElementById("ongkirText").innerHTML =
                        "Rp " + ongkir.toLocaleString();

                    hitungTotalDenganOngkir();

                    //---------------------------------------
                    // Ambil alamat otomatis
                    //---------------------------------------

                    try {

                        const response = await fetch(

                            `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${posisi.lat}&lon=${posisi.lng}`

                        );

                        const data = await response.json();

                        const alamat = data.display_name;

                        document.getElementById("alamatText").innerHTML = alamat;

                        document.getElementById("alamat").value = alamat;

                    } catch (err) {

                        console.log(err);

                    }

                });

            }
        </script>
</body>

</html>
