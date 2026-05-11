<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Petugas; 
use Illuminate\Support\Facades\Hash;
use App\Models\Pembayaran; 

// ======================================
// 1. RUTE LOGIN
// ======================================
Route::post('/login', function (Request $request) {
    $petugas = Petugas::where('username', $request->username)->first();

    // Cek password pakai Hash (Bcrypt)
    if (!$petugas || !Hash::check($request->password, $petugas->password)) {
        return response()->json(['status' => 'error', 'message' => 'Username atau Password salah!'], 401);
    }

    // Kalau sukses
    return response()->json([
        'status' => 'success',
        'message' => 'Login Berhasil',
        'data' => [
            'nama_petugas' => $petugas->nama_petugas,
            'level' => $petugas->level
        ]
    ]);
}); // <--- NAH, TUTUPNYA LOGIN DI SINI BOSSKU!


// ======================================
// 2. RUTE PEMBAYARAN (Harus di luar login)
// ======================================
Route::post('/pembayaran', function (Request $request) {
    // Bikin record baru di database
    $bayar = new Pembayaran();
    $bayar->id_petugas = 1; // Kita tembak angka 1 dulu sementara biar gak ribet
    $bayar->nisn = $request->nisn;
    $bayar->tgl_bayar = now(); 
    $bayar->bulan_dibayar = $request->bulan_dibayar;
    $bayar->tahun_dibayar = $request->tahun_dibayar;
    $bayar->id_spp = 1; // Ditembak angka 1 dulu sementara
    $bayar->jumlah_bayar = 150000; // Ditembak nominal dulu sementara
    $bayar->save();

    return response()->json([
        'status' => 'success',
        'message' => 'Data pembayaran berhasil disimpan!'
    ]);
});