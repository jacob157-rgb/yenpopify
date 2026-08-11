@extends('v_layouts.app')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Edit User</span>
                <a href="{{ route('admin.user.index') }}" class="btn btn-outline-danger">
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

                <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Nama Lengkap"
                            value="{{ old('name', $user->name) }}" required>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email"
                            value="{{ old('email', $user->email) }}" required>
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-3">
                        <select name="role" class="form-control" required>
                            <option value="" disabled>Pilih Role</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                            </option>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        <div class="form-control-icon">
                            <i class="bi bi-person-badge"></i>
                        </div>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password (Opsional)">
                        <div class="form-control-icon">
                            <i class="bi bi-lock"></i>
                        </div>
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah
                            password</small>
                    </div>

                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Konfirmasi Password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
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
