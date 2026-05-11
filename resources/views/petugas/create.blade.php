@extends('layout_custom')

@section('title', 'Tambah Petugas')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Petugas</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('petugas.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_petugas" class="form-control @error('nama_petugas') is-invalid @enderror" value="{{ old('nama_petugas') }}">
                @error('nama_petugas') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Level</label>
                <select name="level" class="form-select">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Petugas</button>
            <a href="{{ route('petugas.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection