<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;

class SiswaController extends Controller
{
    public function index()
    {
        // Pakai with() biar Laravel otomatis narik data nama kelas dan nominal SPP dari tabel tetangga
        $siswa = Siswa::with(['kelas', 'spp'])->get();
        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        // Ambil data Kelas dan SPP buat dijadiin pilihan dropdown (Select Option)
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('siswa.create', compact('kelas', 'spp'));
    }

    public function store(Request $request)
    {
        // Validasi ekstra ketat, NISN dan NIS gak boleh ada yang kembar (unique)
        $request->validate([
            'nisn' => 'required|size:10|unique:siswa,nisn',
            'nis' => 'required|size:8|unique:siswa,nis',
            'nama' => 'required|max:35',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|max:13',
            'id_spp' => 'required'
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil ditambahkan! 🎓');
    }

    public function edit(string $id)
    {
        // Cari siswa berdasarkan NISN
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('siswa.edit', compact('siswa', 'kelas', 'spp'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nis' => 'required|size:8',
            'nama' => 'required|max:35',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|max:13',
            'id_spp' => 'required'
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil diperbarui! 🚀');
    }

    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil dihapus! 🗑️');
    }
}