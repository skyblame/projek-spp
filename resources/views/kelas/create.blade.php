@extends('layout_custom')

@section('title', 'Tambah Data Kelas')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Data Kelas</h1>
    <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kelas</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf 

            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}" placeholder="Contoh: X RPL 1">
                @error('nama_kelas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kompetensi_keahlian" class="form-label">Kompetensi Keahlian <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('kompetensi_keahlian') is-invalid @enderror" id="kompetensi_keahlian" name="kompetensi_keahlian" value="{{ old('kompetensi_keahlian') }}" placeholder="Contoh: Rekayasa Perangkat Lunak">
                @error('kompetensi_keahlian')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Simpan Data
            </button>
            <button type="reset" class="btn btn-warning text-white">
                <i class="fas fa-undo me-1"></i> Reset
            </button>
        </form>
    </div>
</div>
@endsection