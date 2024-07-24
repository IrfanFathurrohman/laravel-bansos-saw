<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaian = Penilaian::with('bansos', 'kriteria')->get();
        $bansos = Bansos::all();
        $kriteria = Kriteria::all();
        return view('penilaian', compact('penilaian', 'bansos', 'kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bansos_id' => 'required',
            'kriteria_id' => 'required',
            'keterangan' => 'required',
            'bobot' => 'required',
        ]);

        Penilaian::create($request->all());

        return redirect()->route('penilaian.index')->with('success', 'Data Penilaian berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penilaianEdit = Penilaian::findOrFail($id);
        $penilaian = Penilaian::with('bansos', 'kriteria')->get();
        $bansos = Bansos::all();
        $kriteria = Kriteria::all();
        return view('penilaian', compact('penilaian', 'penilaianEdit', 'bansos', 'kriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bansos_id' => 'required',
            'kriteria_id' => 'required',
            'keterangan' => 'required',
            'bobot' => 'required',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $penilaian->update($request->all());

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus');
    }
}
