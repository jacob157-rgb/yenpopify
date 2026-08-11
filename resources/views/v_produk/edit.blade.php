@extends('v_layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Edit Produk</span>
                <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-danger">
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

                <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Pilih Kategori --}}
                    <div class="form-group position-relative has-icon-left mb-3">
                        <select name="kategori_id" class="form-control" required>
                            <option value="" disabled>Pilih Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}" {{ $produk->kategori_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-tags"></i>
                        </div>
                    </div>

                    {{-- Nama Produk --}}
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk"
                            value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                        <div class="form-control-icon">
                            <i class="bi bi-box"></i>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group position-relative mb-3">
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi Produk" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    </div>

                    {{-- Harga --}}
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="number" name="harga" class="form-control" placeholder="Harga Produk"
                            value="{{ old('harga', $produk->harga) }}" step="0.01" required>
                        <div class="form-control-icon">
                            <i class="bi bi-cash"></i>
                        </div>
                    </div>

                    {{-- Gambar Lama --}}
                    @if ($produk->gambar)
                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini:</label><br>
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk" width="100"
                                class="rounded mb-2 border">
                        </div>
                    @endif

                    {{-- Ganti Gambar --}}
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <div class="form-control-icon">
                            <i class="bi bi-image"></i>
                        </div>
                    </div>

                    {{-- Tombol Perbarui --}}
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Perbarui
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
