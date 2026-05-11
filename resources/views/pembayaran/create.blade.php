@extends('layout_custom')

@section('title', 'Transaksi Pembayaran Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Pembayaran SPP</h6>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Pilih Siswa</label>
                            <select name="nisn" class="form-select @error('nisn') is-invalid @enderror" required>
                                <option value="" selected disabled>-- Cari Siswa Berdasarkan Nama/NISN --</option>
                                @foreach($siswa as $s)
                                    <option value="{{ $s->nisn }}">
                                        {{ $s->nama }} (NISN: {{ $s->nisn }}) - Tarif: Rp {{ number_format($s->spp->nominal, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tanggal Bayar</label>
                            <input type="date" name="tgl_bayar" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Jumlah Bayar (Rp)</label>
                            <input type="number" name="jumlah_bayar" class="form-control" placeholder="Contoh: 150000" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Untuk Bulan</label>
                            <select name="bulan_dibayar" class="form-select" required>
                                @php 
                                    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                @endphp
                                @foreach($bulan as $b)
                                    <option value="{{ $b }}" {{ date('F') == $b ? 'selected' : '' }}>{{ $b }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold small text-muted text-uppercase">Tahun</label>
                            <input type="number" name="tahun_dibayar" class="form-control" value="{{ date('Y') }}" required>
                        </div>
                    </div>

                    <hr>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary fw-bold py-2">
                            <i class="fas fa-save me-1"></i> SIMPAN TRANSAKSI
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection