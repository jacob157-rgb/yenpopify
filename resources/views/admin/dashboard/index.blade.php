@extends('v_layouts.app')

@push('styles')
    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 30px;
        }

        .dashboard-header h2 {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .dashboard-card {

            border: none;
            border-radius: 18px;

            color: white;

            transition: .3s;

            overflow: hidden;

            position: relative;

        }

        .dashboard-card:hover {

            transform: translateY(-8px);

            box-shadow: 0 20px 35px rgba(0, 0, 0, .15);

        }

        .dashboard-card .card-body {

            padding: 25px;

        }

        .dashboard-card i {

            font-size: 45px;

            opacity: .25;

            position: absolute;

            right: 20px;

            top: 20px;

        }

        .dashboard-card h3 {

            font-size: 30px;

            font-weight: 700;

        }

        .dashboard-card p {

            margin: 0;

            font-size: 15px;

        }

        .bg-red {

            background: linear-gradient(135deg, #ef4444, #dc2626);

        }

        .bg-blue {

            background: linear-gradient(135deg, #2563eb, #1d4ed8);

        }

        .bg-green {

            background: linear-gradient(135deg, #10b981, #059669);

        }

        .bg-orange {

            background: linear-gradient(135deg, #f59e0b, #d97706);

        }
    </style>
@endpush
@section('content')
@section('content')

    <section class="section">

        {{-- HEADER --}}
        <div class="dashboard-header shadow">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <h2>
                        👋 Selamat Datang, Admin
                    </h2>

                    <p class="mb-0" style="opacity:.9;font-size:16px">
                        Kelola produk, transaksi, customer, dan seluruh aktivitas
                        <strong>YEN PHOTO</strong> dari dashboard ini.
                    </p>

                </div>

                <div class="col-lg-4 text-end d-none d-lg-block">

                    <i class="bi bi-camera2" style="font-size:90px;opacity:.25;"></i>

                </div>

            </div>

        </div>

        {{-- CARDS --}}
        <div class="row">

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card dashboard-card bg-red">

                    <div class="card-body">

                        <i class="bi bi-box-seam"></i>

                        <h3>{{ $totalProduk }}</h3>

                        <p>Total Produk</p>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card dashboard-card bg-blue">

                    <div class="card-body">

                        <i class="bi bi-tags"></i>

                        <h3>{{ $totalKategori }}</h3>

                        <p>Total Kategori</p>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card dashboard-card bg-green">

                    <div class="card-body">

                        <i class="bi bi-people"></i>

                        <h3>{{ $totalCustomer }}</h3>

                        <p>Total Customer</p>

                    </div>

                </div>

            </div>

            <div class="col-lg-3 col-md-6 mb-4">

                <div class="card dashboard-card bg-orange">

                    <div class="card-body">

                        <i class="bi bi-receipt"></i>

                        <h3>{{ $totalTransaksi }}</h3>

                        <p>Total Transaksi</p>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-6 mb-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Pendapatan Hari Ini
                        </h6>

                        <h2 class="fw-bold text-success">

                            Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}

                        </h2>

                        <small class="text-muted">
                            Total pembayaran yang telah lunas hari ini.
                        </small>

                    </div>

                </div>

            </div>

            <div class="col-lg-6 mb-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Menunggu Pembayaran
                        </h6>

                        <h2 class="fw-bold text-warning">

                            {{ $pendingPembayaran }}

                        </h2>

                        <small class="text-muted">
                            Pesanan yang masih menunggu pembayaran.
                        </small>

                    </div>

                </div>

            </div>

        </div>
    @endsection
