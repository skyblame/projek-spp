<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Pastikan ini ada biar gak error kayak tadi
use App\Models\Spp;

class SppController extends Controller
{
    public function index()
    {
        $spp = Spp::all();
        return view('spp.index', compact('spp'));
    }

    public function create()
    {
        return view('spp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|numeric',
            'nominal' => 'required|numeric'
        ], [
            'tahun.required' => 'Tahun wajib diisi!',
            'tahun.numeric' => 'Tahun harus berupa angka!',
            'nominal.required' => 'Nominal wajib diisi!',
            'nominal.numeric' => 'Nominal harus berupa angka!'
        ]);

        Spp::create($request->all());

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil ditambahkan! 💰');
    }

    public function edit(string $id)
    {
        $spp = Spp::findOrFail($id);
        return view('spp.edit', compact('spp'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tahun' => 'required|numeric',
            'nominal' => 'required|numeric'
        ]);

        $spp = Spp::findOrFail($id);
        $spp->update($request->all());

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil diperbarui! 🚀');
    }

    public function destroy(string $id)
    {
        $spp = Spp::findOrFail($id);
        $spp->delete();

        return redirect()->route('spp.index')->with('success', 'Data SPP berhasil dihapus! 🗑️');
    }
}