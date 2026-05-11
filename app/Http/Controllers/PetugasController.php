<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash; // Penting buat enkripsi password

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::all();
        return view('petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:petugas,username|max:25',
            'password' => 'required|min:5',
            'nama_petugas' => 'required|max:35',
            'level' => 'required'
        ]);

        Petugas::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Password di-enkripsi
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level,
        ]);

        return redirect()->route('petugas.index')->with('success', 'Petugas baru berhasil ditambahkan! 👮');
    }

    public function edit(string $id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('petugas.edit', compact('petugas'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|max:25',
            'nama_petugas' => 'required|max:35',
            'level' => 'required'
        ]);

        $petugas = Petugas::findOrFail($id);
        
        $data = [
            'username' => $request->username,
            'nama_petugas' => $request->nama_petugas,
            'level' => $request->level,
        ];

        // Jika password diisi, maka update passwordnya. Kalau kosong, pakai password lama.
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('petugas.index')->with('success', 'Data petugas berhasil diperbarui! 🚀');
    }

    public function destroy(string $id)
    {
        Petugas::findOrFail($id)->delete();
        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil dihapus! 🗑️');
    }
}