@extends('layout_custom')

@section('title', 'Edit Data SPP')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Data SPP</h1>
    <a href="{{ route('spp.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit SPP</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('spp.update', $spp->id_spp) }}" method="POST">
            @csrf 
            @method('PUT') 

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ old('tahun', $spp->tahun) }}">
                @error('tahun')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal', $spp->nominal) }}">
                <div class="form-text">Tulis angkanya saja tanpa titik atau koma.</div>
                @error('nominal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Update Data
            </button>
        </form>
    </div>
</div>
@endsection