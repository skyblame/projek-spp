@extends('layout_custom')

@section('title', 'History Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cari History Pembayaran Siswa</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pembayaran.history') }}" method="GET" class="row g-3">
                    <div class="col-md-10">
                        <input type="text" name="search" class="form-control" placeholder="Masukkan NISN atau Nama Siswa..." value="{{ $keyword }}">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($siswa)
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white">
                <h6 class="m-0 font-weight-bold">Biodata Siswa</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr><td>NISN</td><td>: {{ $siswa->nisn }}</td></tr>
                    <tr><td>Nama</td><td>: {{ $siswa->nama }}</td></tr>
                    <tr><td>Kelas</td><td>: {{ $siswa->kelas->nama_kelas }}</td></tr>
                    <tr><td>Tarif SPP</td><td>: Rp {{ number_format($siswa->spp->nominal, 0, ',', '.') }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Pembayaran</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Tanggal Bayar</th>
                                <th>Jumlah</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($history as $h)
                            <tr>
                                <td>{{ $h->bulan_dibayar }}</td>
                                <td>{{ $h->tahun_dibayar }}</td>
                                <td>{{ $h->tgl_bayar }}</td>
                                <td>Rp {{ number_format($h->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>{{ $h->petugas->nama_petugas }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center">Belum ada riwayat pembayaran.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @elseif($keyword)
    <div class="col-12 text-center mt-4">
        <div class="alert alert-warning">Siswa dengan NISN/Nama "{{ $keyword }}" tidak ditemukan.</div>
    </div>
    @endif
</div>
@endsection