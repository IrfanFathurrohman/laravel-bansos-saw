<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use App\Models\Kriteria;
use App\Models\Pengajuan;
use App\Models\Warga;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with('bansos', 'kriteria', 'warga')->get();
        return view('pengajuan', [
            'pengajuans' => $pengajuans,
            'warga' => Warga::all(),
            'bansos' => Bansos::all()
        ]);
    }

    public function create()
    {
        return view('pengajuan', [
            'warga' => Warga::all(),
            'bansos' => Bansos::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'bansos_id' => 'required|exists:bansos,id',
            'nilai.*' => 'required|numeric'
        ]);

        foreach ($validated['nilai'] as $kriteria_id => $nilai) {
            Pengajuan::updateOrCreate(
                ['bansos_id' => $validated['bansos_id'], 'kriteria_id' => $kriteria_id, 'warga_id' => $validated['warga_id']],
                ['nilai' => $nilai]
            );
        }

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil disimpan!');
    }

    public function edit($id)
    {
        $pengajuanEdit = Pengajuan::findOrFail($id);
        return view('pengajuan', [
            'pengajuanEdit' => $pengajuanEdit,
            'warga' => Warga::all(),
            'bansos' => Bansos::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'warga_id' => 'required|exists:warga,id',
            'bansos_id' => 'required|exists:bansos,id',
            'nilai.*' => 'required|numeric'
        ]);

        foreach ($validated['nilai'] as $kriteria_id => $nilai) {
            Pengajuan::updateOrCreate(
                ['id' => $id, 'bansos_id' => $validated['bansos_id'], 'kriteria_id' => $kriteria_id, 'warga_id' => $validated['warga_id']],
                ['nilai' => $nilai]
            );
        }

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil dihapus!');
    }

    public function fetchKriteria(Request $request)
    {
        $bansos_id = $request->input('bansos_id');
        $kriteria = Kriteria::where('bansos_id', $bansos_id)->get();

        $html = '';
        foreach ($kriteria as $k) {
            $html .= '<div class="form-group">';
            $html .= '<label for="nilai">' . ucfirst($k->nama) . '</label>';
            $html .= '<select class="form-control" name="nilai[' . $k->id . ']" id="nilai">';
            $html .= '<option>---</option>';
            foreach ($k->penilaian as $p) {
                $html .= '<option value="' . $p->bobot . '">' . $p->keterangan . '</option>';
            }
            $html .= '</select>';
            $html .= '</div>';
        }

        return response()->json(['html' => $html]);
    }
}
