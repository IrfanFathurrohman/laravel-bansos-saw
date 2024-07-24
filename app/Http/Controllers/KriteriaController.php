<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Models\Bansos;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::with('bansos')->get();
        $bansos = Bansos::all();
        $kriteriaList = Kriteria::all(); // Ambil semua data kriteria untuk daftar

        return view('kriteria', compact('kriteria', 'bansos', 'kriteriaList'));
    }


    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $bansos = Bansos::all(); // Ambil semua data bansos untuk dropdown
        
        return view('kriteria', [
            'kriteria' => $kriteria,
            'bansos' => $bansos,
            'kriteriaList' => Kriteria::with('bansos')->get(), // tambahkan kriteriaList untuk daftar kriteria
        ]);
    }
    
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'bansos_id' => 'required',
            'nama' => 'required|string|max:255',
            'sifat' => 'required|in:min,max',
        ]);

        // Simpan data kriteria baru
        Kriteria::create([
            'bansos_id' => $request->bansos_id,
            'nama' => $request->nama,
            'sifat' => $request->sifat,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kriteria.index')->with('success', 'Data kriteria berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'bansos_id' => 'required',
            'nama' => 'required|string|max:255',
            'sifat' => 'required|in:min,max',
        ]);

        // Cari data kriteria berdasarkan ID
        $kriteria = Kriteria::findOrFail($id);

        // Update data kriteria
        $kriteria->update([
            'bansos_id' => $request->bansos_id,
            'nama' => $request->nama,
            'sifat' => $request->sifat,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('kriteria.index')->with('success', 'Data kriteria berhasil diupdate');
    }

    public function destroy($id)
    {
        // Cari data berdasarkan ID
        $kriteria = Kriteria::findOrFail($id);
        
        // Hapus data
        $kriteria->delete();
        
        // Redirect atau response sesuai kebutuhan aplikasi
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus');
    }
}

