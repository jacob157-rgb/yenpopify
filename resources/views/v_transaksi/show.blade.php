@extends('v_layouts.app')

@section('content')
    <section class="section">

        <div class="container-fluid">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Detail Transaksi</h4>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            {{-- INFO UTAMA --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="row">

                        {{-- LEFT --}}
                        <div class="col-md-6">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <th width="40%">No Transaksi</th>
                                    <td>: {{ $transaksi->id }}</td>
                                </tr>
                                <tr>
                                    <th>Pelanggan</th>
                                    <td>: {{ $transaksi->customer->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td>: {{ $transaksi->no_hp }}</td>
                                </tr>

                                <tr>
                                    <th>Metode Pengiriman</th>
                                    <td>:
                                        <span class="badge bg-primary">
                                            {{ $transaksi->metode_pengiriman ?? '-' }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- RIGHT --}}
                        <div class="col-md-6">
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <th>Tanggal</th>
                                    <td>:
                                        {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>

                                {{-- STATUS PENGERJAAN --}}
                                <tr>
                                    <th>Status Pengerjaan</th>
                                    <td>:
                                        @if ($transaksi->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($transaksi->status == 'diproses')
                                            <span class="badge bg-info text-dark">Diproses</span>
                                        @elseif ($transaksi->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Batal</span>
                                        @endif
                                    </td>
                                </tr>

                                {{-- STATUS PEMBAYARAN --}}
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td>:
                                        @if ($transaksi->status_pembayaran == 'pending')
                                            <span class="badge bg-secondary">Belum Bayar</span>
                                        @elseif ($transaksi->status_pembayaran == 'menunggu')
                                            <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                                        @elseif ($transaksi->status_pembayaran == 'lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Total</th>
                                    <td>:
                                        <strong class="text-success">
                                            Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            {{-- CATATAN --}}
            @if ($transaksi->catatan)
                <div class="card border-0 shadow-sm mb-4" style="background:#fff8e1;">
                    <div class="card-body">
                        <h6 class="fw-bold mb-2">
                            <i class="bi bi-chat-left-text"></i> Catatan Customer
                        </h6>
                        <p class="mb-0">{{ $transaksi->catatan }}</p>
                    </div>
                </div>
            @endif

            {{-- ALAMAT PENGIRIMAN --}}
            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-success text-white">
                    <i class="bi bi-geo-alt-fill"></i>
                    Lokasi Pengiriman
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-5">

                            <table class="table table-sm">

                                <tr>
                                    <th width="35%">Alamat</th>
                                    <td>{{ $transaksi->alamat_pengiriman }}</td>
                                </tr>

                                <tr>
                                    <th>Latitude</th>
                                    <td>{{ $transaksi->latitude }}</td>
                                </tr>

                                <tr>
                                    <th>Longitude</th>
                                    <td>{{ $transaksi->longitude }}</td>
                                </tr>

                                <tr>
                                    <th>Jarak</th>
                                    <td>{{ $transaksi->jarak_km }} KM</td>
                                </tr>

                                <tr>
                                    <th>Ongkir</th>
                                    <td>
                                        Rp{{ number_format($transaksi->ongkir, 0, ',', '.') }}
                                    </td>
                                </tr>

                            </table>

                        </div>

                        <div class="col-md-7">

                            <div id="mapAdmin"
                                style="
                    height:400px;
                    border-radius:12px;
                    border:1px solid #ddd;">
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- PRODUK --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">
                    Daftar Produk
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi->detail as $i => $d)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $d->produk->nama_produk ?? '-' }}</td>
                                        <td>Rp{{ number_format($d->produk->harga ?? 0, 0, ',', '.') }}</td>
                                        <td>{{ $d->jumlah }}</td>
                                        <td>Rp{{ number_format($d->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="4" class="text-end">Total</th>
                                    <th>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            {{-- AKSI ADMIN --}}
            <div class="card-body">

                @if ($transaksi->status_pembayaran == 'paid')
                    <div class="d-flex gap-2">
                        <form action="{{ route('admin.transaksi.approve', $transaksi->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Konfirmasi
                            </button>
                        </form>

                        <form action="{{ route('admin.transaksi.reject', $transaksi->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Tolak
                            </button>
                        </form>
                    </div>
                @elseif ($transaksi->status_pembayaran == 'lunas')
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-0">
                        <i class="bi bi-check-circle-fill"></i>
                        <div>
                            <strong>Pembayaran sudah lunas</strong><br>
                            <small>Pesanan siap diproses</small>
                        </div>
                    </div>
                @elseif ($transaksi->status_pembayaran == 'ditolak')
                    <div class="alert alert-danger mb-0">
                        <i class="bi bi-x-circle"></i>
                        Pembayaran ditolak
                    </div>
                @else
                    <div class="alert alert-secondary mb-0">
                        Menunggu pembayaran dari customer
                    </div>
                @endif

            </div>

            {{-- BUKTI PEMBAYARAN --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">
                    Bukti Pembayaran
                </div>
                <div class="card-body text-center">
                    @if ($transaksi->bukti)
                        <a href="{{ asset('storage/' . $transaksi->bukti) }}" target="_blank">
                            <img src="{{ asset('storage/' . $transaksi->bukti) }}"
                                style="max-width:200px; border-radius:10px;">
                        </a>
                    @else
                        <span class="text-muted">Belum ada bukti pembayaran</span>
                    @endif
                </div>
            </div>

            {{-- FILE CUSTOMER --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white fw-bold">
                    File dari Customer
                </div>

                <div class="card-body">
                    @if ($transaksi->files->count())
                        <div class="row">
                            @foreach ($transaksi->files as $file)
                                @php
                                    $ext = strtolower(pathinfo($file->file_path, PATHINFO_EXTENSION));
                                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'webp']);
                                @endphp

                                <div class="col-md-3 mb-3">
                                    <div class="border rounded p-2 text-center bg-light">

                                        @if ($isImage)
                                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $file->file_path) }}"
                                                    style="width:100%; height:150px; object-fit:cover; border-radius:8px;">
                                            </a>
                                        @else
                                            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                                <i class="bi bi-file-earmark-text fs-1"></i>
                                                <div>{{ basename($file->file_path) }}</div>
                                            </a>
                                        @endif

                                        <small class="text-muted d-block mt-1">
                                            {{ $file->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Belum ada file upload.</p>
                    @endif
                </div>
            </div>

            {{-- FOOTER ACTION --}}
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>

                <a href="{{ route('admin.transaksi.cetak', $transaksi->id) }}" target="_blank"
                    class="btn btn-outline-secondary">
                    <i class="bi bi-printer"></i>
                    Cetak
                </a>
            </div>

        </div>

    </section>
    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                @if ($transaksi->latitude && $transaksi->longitude)

                    const lat = {{ $transaksi->latitude }};
                    const lng = {{ $transaksi->longitude }};

                    const map = L.map('mapAdmin').setView([lat, lng], 16);

                    L.tileLayer(
                        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap'
                        }
                    ).addTo(map);

                    L.marker([lat, lng])
                        .addTo(map)
                        .bindPopup("Lokasi Customer")
                        .openPopup();

                    setTimeout(function() {
                        map.invalidateSize();
                    }, 300);
                @endif

            });
        </script>
    @endpush
@endsection
