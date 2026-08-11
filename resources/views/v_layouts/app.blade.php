<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yen Photo Tegal</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/simple-datatables/style.css') }}">

    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('Backend/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @stack('styles')
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('Backend/assets/images/logo/logo.png') }}"
                                    alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu d-flex flex-column" style="height: 100%;">
                    <ul class="menu flex-grow-1">
                        <li class="sidebar-title">Menu</li>

                        {{-- Menu Dashboard --}}
                        <li class="sidebar-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        {{-- Menu User --}}
                        <li class="sidebar-item {{ Request::is('admin/user*') ? 'active' : '' }}">
                            <a href="{{ route('admin.user.index') }}" class='sidebar-link'>
                                <i class="bi {{ Request::is('admin/user*') ? 'bi-person-fill' : 'bi-person' }}"></i>
                                <span>User</span>
                            </a>
                        </li>

                        {{-- Menu Kategori --}}
                        <li class="sidebar-item {{ Request::is('admin/kategori*') ? 'active' : '' }}">
                            <a href="{{ route('admin.kategori.index') }}" class='sidebar-link'>
                                <i class="bi {{ Request::is('admin/kategori*') ? 'bi-tags-fill' : 'bi-tags' }}"></i>
                                <span>Kategori</span>
                            </a>
                        </li>

                        {{-- Menu Produk --}}
                        <li class="sidebar-item {{ Request::is('admin/produk*') ? 'active' : '' }}">
                            <a href="{{ route('admin.produk.index') }}" class='sidebar-link'>
                                <i
                                    class="bi {{ Request::is('admin/produk*') ? 'bi-box-seam-fill' : 'bi-box-seam' }}"></i>
                                <span>Produk</span>
                            </a>
                        </li>

                        {{-- Menu Transaksi --}}
                        <li class="sidebar-item {{ Request::is('admin/transaksi*') ? 'active' : '' }}">
                            <a href="{{ route('admin.transaksi.index') }}" class='sidebar-link'>
                                <i
                                    class="bi {{ Request::is('admin/transaksi*') ? 'bi-receipt-cutoff' : 'bi-receipt' }}"></i>
                                <span>Transaksi</span>
                            </a>
                        </li>
                    </ul>

                    {{-- Menu Logout di Paling Bawah --}}
                    <ul class="menu mb-3 mt-4 pt-2 border-top">
                        <li class="sidebar-item">
                            <a href="{{ route('logout') }}" class="sidebar-link text-danger d-flex align-items-center"
                                style="font-weight: 600;">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>


                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Yen Photo Tegal</h3>
                            <p class="text-subtitle text-muted">
                                Selamat Datang
                            </p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2025 &copy; Yen Photo Tegal</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('Backend/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('Backend/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="{{ asset('Backend/assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @stack('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}"
            });
        </script>
    @endif
</body>

</html>
