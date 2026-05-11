@extends('layout_custom')

@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Entri Pembayaran</h1>
    <a href="{{ route('pembayaran.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50 me-1"></i> Transaksi Baru
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Riwayat Transaksi Masuk</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Petugas</th>
                        <th>Siswa</th>
                        <th>Tanggal Bayar</th>
                        <th>SPP Bulan</th>
                        <th>Jumlah Bayar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembayaran as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->petugas->nama_petugas ?? 'Tidak Diketahui' }}</td>
                            <td>{{ $item->siswa->nama ?? 'Tidak Diketahui' }} ({{ $item->nisn }})</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_bayar)->format('d-m-Y') }}</td>
                            <td>{{ $item->bulan_dibayar }} {{ $item->tahun_dibayar }}</td>
                            <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if(auth()->user()->level == 'admin')
                                <form action="{{ route('pembayaran.destroy', $item->id_pembayaran) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan/menghapus transaksi ini?')"><i class="fas fa-trash"></i></button>
                                </form>
                                @else
                                    <span class="badge bg-success">Sukses</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">Belum ada transaksi pembayaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection