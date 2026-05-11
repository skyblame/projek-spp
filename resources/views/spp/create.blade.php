@extends('layout_custom')

@section('title', 'Tambah Data SPP')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Data SPP</h1>
    <a href="{{ route('spp.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah SPP</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('spp.store') }}" method="POST">
            @csrf 

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ old('tahun') }}" placeholder="Contoh: 2024">
                @error('tahun')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal') }}" placeholder="Contoh: 150000">
                <div class="form-text">Tulis angkanya saja tanpa titik atau koma.</div>
                @error('nominal')
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