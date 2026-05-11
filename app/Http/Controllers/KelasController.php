<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;


class KelasController extends Controller
{
    // READ: Menampilkan semua data Kelas
  public function index()
    {
        // Ambil semua data kelas dari database
        $kelas = \App\Models\Kelas::all();
        
        // Kirim datanya ke halaman view
        return view('kelas.index', compact('kelas'));
    }
  public function create()
    {
        // Menampilkan halaman form tambah data
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi data (mastiin form gak kosong)
        $request->validate([
            'nama_kelas' => 'required|max:50',
            'kompetensi_keahlian' => 'required|max:50'
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi!',
            'kompetensi_keahlian.required' => 'Kompetensi keahlian wajib diisi!'
        ]);

        // 2. Simpan ke database
        \App\Models\Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian
        ]);

        // 3. Pindah balik ke halaman index bawa pesan sukses
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil ditambahkan! 🚀');
    }

public function edit(string $id)
    {
        // Cari data kelas berdasarkan ID
        $kelas = \App\Models\Kelas::findOrFail($id);
        
        // Tampilkan form edit dan kirim datanya
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Request $request, string $id)
    {
        // 1. Validasi data
        $request->validate([
            'nama_kelas' => 'required|max:50',
            'kompetensi_keahlian' => 'required|max:50'
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi!',
            'kompetensi_keahlian.required' => 'Kompetensi keahlian wajib diisi!'
        ]);

        // 2. Cari data lalu update
        $kelas = \App\Models\Kelas::findOrFail($id);
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'kompetensi_keahlian' => $request->kompetensi_keahlian
        ]);

        // 3. Pindah ke halaman index bawa pesan sukses
        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil diperbarui! 🚀');
    }

    public function destroy(string $id)
    {
        // Cari data dan hapus
        $kelas = \App\Models\Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Data Kelas berhasil dihapus! 🗑️');
    }
}