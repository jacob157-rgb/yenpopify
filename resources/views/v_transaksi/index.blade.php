@extends('v_layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Daftar Transaksi</span>
                <a href="{{ route('admin.transaksi.create') }}" class="btn btn-info">
                    <i class="bi bi-plus"></i> Tambah Transaksi
                </a>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>No HP</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $index => $t)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $t->customer->name ?? '-' }}</td>
                                <td>{{ $t->no_hp }}</td>
                                <td>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d/m/Y') }}</td>
                                <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    @switch($t->status)
                                        @case('pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @break

                                        @case('diproses')
                                            <span class="badge bg-info text-dark">Diproses</span>
                                        @break

                                        @case('selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @break

                                        @case('batal')
                                            <span class="badge bg-danger">Batal</span>
                                        @break

                                        @default
                                            <span class="badge bg-secondary">Tidak Diketahui</span>
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('admin.transaksi.show', $t->id) }}" class="btn btn-sm btn-secondary"
                                        title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.transaksi.edit', $t->id) }}" class="btn btn-sm btn-primary"
                                        title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.transaksi.destroy', $t->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
