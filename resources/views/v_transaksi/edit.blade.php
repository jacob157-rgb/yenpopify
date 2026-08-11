@extends('v_layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Edit Transaksi</span>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-outline-danger">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.transaksi.update', $transaksi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Customer --}}
                    <div class="form-group mb-3">
                        <label for="customer_id">Pelanggan</label>
                        <select name="customer_id" class="form-control" required>
                            <option value="" disabled>Pilih Pelanggan</option>
                            @foreach ($customers as $c)
                                <option value="{{ $c->id }}"
                                    {{ $transaksi->customer_id == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Transaksi --}}
                    <div class="form-group mb-3">
                        <label for="tanggal_transaksi">Tanggal Transaksi</label>
                        <input type="date" name="tanggal_transaksi" class="form-control"
                            value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi) }}" required>
                    </div>

                    {{-- Nomor HP --}}
                    <div class="form-group mb-3">
                        <label for="no_hp">Nomor HP</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx"
                            value="{{ old('no_hp', $transaksi->no_hp) }}" required>
                    </div>

                    {{-- Produk --}}
                    <div class="form-group mb-3">
                        <label>Produk</label>
                        <div id="produk-wrapper">
                            @foreach ($transaksi->detail as $d)
                                <div class="row mb-2 produk-item">
                                    <div class="col-md-5">
                                        <select name="produk_id[]" class="form-control produk-select" required>
                                            <option value="" disabled>Pilih Produk</option>
                                            @foreach ($produks as $p)
                                                <option value="{{ $p->id }}" data-harga="{{ $p->harga }}"
                                                    {{ $d->produk_id == $p->id ? 'selected' : '' }}>
                                                    {{ $p->nama_produk }} - Rp{{ number_format($p->harga, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="jumlah[]" class="form-control jumlah"
                                            value="{{ $d->jumlah }}" min="1" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" class="form-control subtotal"
                                            value="Rp{{ number_format($d->subtotal, 0, ',', '.') }}" readonly>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-produk w-100">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success" id="add-produk">
                            <i class="bi bi-plus-circle"></i> Tambah Produk
                        </button>
                    </div>

                    {{-- Total Harga --}}
                    <div class="form-group mb-3">
                        <label for="total_harga">Total Harga</label>
                        <input type="text" id="total_harga_display" class="form-control" readonly
                            value="Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}">
                        <input type="hidden" name="total_harga" id="total_harga" value="{{ $transaksi->total_harga }}">
                    </div>

                    {{-- Status --}}
                    <div class="form-group mb-4">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $transaksi->status == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="diproses" {{ $transaksi->status == 'diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="batal" {{ $transaksi->status == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Transaksi
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- Script Dinamis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('produk-wrapper');
            const addBtn = document.getElementById('add-produk');
            const formatRupiah = num => 'Rp' + num.toLocaleString('id-ID');

            function updateSubtotal(item) {
                const select = item.querySelector('.produk-select');
                const harga = parseFloat(select.selectedOptions[0]?.dataset.harga || 0);
                const jumlah = parseInt(item.querySelector('.jumlah').value) || 0;
                const subtotal = harga * jumlah;
                item.querySelector('.subtotal').value = formatRupiah(subtotal);
                updateTotal();
            }

            function updateTotal() {
                let total = 0;
                document.querySelectorAll('.subtotal').forEach(el => {
                    const val = parseInt(el.value.replace(/[^\d]/g, '')) || 0;
                    total += val;
                });
                document.getElementById('total_harga_display').value = formatRupiah(total);
                document.getElementById('total_harga').value = total;
            }

            addBtn.addEventListener('click', () => {
                const item = document.querySelector('.produk-item');
                const clone = item.cloneNode(true);
                clone.querySelectorAll('input').forEach(input => input.value = '');
                clone.querySelector('select').selectedIndex = 0;
                wrapper.appendChild(clone);
            });

            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('produk-select') || e.target.classList.contains('jumlah')) {
                    const item = e.target.closest('.produk-item');
                    updateSubtotal(item);
                }
            });

            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-produk')) {
                    const items = document.querySelectorAll('.produk-item');
                    if (items.length > 1) {
                        e.target.closest('.produk-item').remove();
                        updateTotal();
                    }
                }
            });

            // Hitung total saat halaman dimuat
            document.querySelectorAll('.produk-item').forEach(updateSubtotal);
        });
    </script>
@endsection
