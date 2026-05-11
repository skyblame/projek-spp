<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        // Tarik semua data pembayaran beserta relasinya (Siswa, Petugas, SPP)
        $pembayaran = Pembayaran::with(['siswa', 'petugas', 'spp'])->orderBy('created_at', 'desc')->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        // Tarik data siswa untuk dipilih di form pembayaran
        $siswa = Siswa::with('spp')->get();
        return view('pembayaran.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'tgl_bayar' => 'required|date',
            'bulan_dibayar' => 'required',
            'tahun_dibayar' => 'required',
            'jumlah_bayar' => 'required|numeric'
        ]);

        // Cari data siswa berdasarkan NISN yang dipilih untuk mendapatkan id_spp-nya
        $siswa = Siswa::where('nisn', $request->nisn)->first();

        Pembayaran::create([
            'id_petugas' => Auth::user()->id_petugas, // Otomatis pakai ID petugas yang lagi login
            'nisn' => $request->nisn,
            'tgl_bayar' => $request->tgl_bayar,
            'bulan_dibayar' => $request->bulan_dibayar,
            'tahun_dibayar' => $request->tahun_dibayar,
            'id_spp' => $siswa->id_spp, // Otomatis ngambil dari tarif siswa tersebut
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Transaksi Pembayaran Berhasil Disimpan! 💸');
    }

    public function history(Request $request)
{
    $keyword = $request->get('search');
    $siswa = null;
    $history = [];

    if ($keyword) {
        // Cari siswa berdasarkan NISN atau Nama
        $siswa = Siswa::where('nisn', $keyword)
                      ->orWhere('nama', 'like', "%$keyword%")
                      ->first();

        if ($siswa) {
            // Ambil riwayat pembayaran siswa tersebut
            $history = Pembayaran::where('nisn', $siswa->nisn)
                                 ->orderBy('tgl_bayar', 'desc')
                                 ->get();
        }
    }

    return view('pembayaran.history', compact('siswa', 'history', 'keyword'));
}

    public function destroy(string $id)
    {
        Pembayaran::findOrFail($id)->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Data Pembayaran Berhasil Dihapus! 🗑️');
    }
}