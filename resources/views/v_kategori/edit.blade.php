@extends('v_layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Edit Kategori</span>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-danger">
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

                <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori"
                            value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Perbarui
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
