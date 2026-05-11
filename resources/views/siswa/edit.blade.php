@extends('layout_custom')

@section('title', 'Edit Data Siswa')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Data Siswa</h1>
    <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Edit Siswa</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('siswa.update', $siswa->nisn) }}" method="POST">
            @csrf 
            @method('PUT') 

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nisn" class="form-label">NISN (Tidak bisa diubah)</label>
                    <input type="text" class="form-control bg-light" id="nisn" name="nisn" value="{{ $siswa->nisn }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nis" class="form-label">NIS <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}">
                    @error('nis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}">
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="id_kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                <select class="form-select @error('id_kelas') is-invalid @enderror" id="id_kelas" name="id_kelas">
                    <option value="" disabled>-- Pilih Kelas --</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id_kelas }}" {{ (old('id_kelas', $siswa->id_kelas) == $k->id_kelas) ? 'selected' : '' }}>
                            {{ $k->nama_kelas }} - {{ $k->kompetensi_keahlian }}
                        </option>
                    @endforeach
                </select>
                @error('id_kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $siswa->alamat) }}</textarea>
                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telepon <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp', $siswa->no_telp) }}">
                @error('no_telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="id_spp" class="form-label">Tarif SPP <span class="text-danger">*</span></label>
                <select class="form-select @error('id_spp') is-invalid @enderror" id="id_spp" name="id_spp">
                    <option value="" disabled>-- Pilih Tahun & Nominal SPP --</option>
                    @foreach ($spp as $s)
                        <option value="{{ $s->id_spp }}" {{ (old('id_spp', $siswa->id_spp) == $s->id_spp) ? 'selected' : '' }}>
                            Tahun {{ $s->tahun }} - Rp {{ number_format($s->nominal, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('id_spp') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Update Data Siswa
            </button>
        </form>
    </div>
</div>
@endsection