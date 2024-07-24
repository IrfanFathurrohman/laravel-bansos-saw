<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan;
use App\Models\Bansos;
use App\Models\Kriteria;
use App\Models\Warga;

class PengajuanController extends Controller
{
    // Display the list of pengajuans
    public function index()
    {
        $pengajuans = Pengajuan::with(['bansos', 'kriteria', 'warga'])->get();

        return view('pengajuan.index', compact('pengajuans'));
    }

    // Show the form for creating a new pengajuan
    public function create()
    {
        $bansos = Bansos::all();
        $kriteria = Kriteria::all();
        $wargas = Warga::all();
        return view('pengajuan.create', compact('bansos', 'kriteria', 'wargas'));
    }

    // Store a newly created pengajuan in storage
    public function store(Request $request)
    {
        $request->validate([
            'bansos_id' => 'required|exists:bansos,id',
            'kriteria_id' => 'required|exists:kriteria,id',
            'nilai' => 'required|numeric',
            'nik' => 'required|exists:wargas,nik',
        ]);

        Pengajuan::updateOrCreate(
            ['id' => $request->id],
            $request->all()
        );

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan saved successfully');
    }

    // Show the form for editing the specified pengajuan
    public function edit($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $bansos = Bansos::all();
        $kriteria = Kriteria::all();
        $wargas = Warga::all();
        return view('pengajuan.edit', compact('pengajuan', 'bansos', 'kriteria', 'wargas'));
    }

    // Update the specified pengajuan in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'bansos_id' => 'required|exists:bansos,id',
            'kriteria_id' => 'required|exists:kriteria,id',
            'nilai' => 'required|numeric',
            'nik' => 'required|exists:wargas,nik',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update($request->all());

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan updated successfully');
    }

    // Remove the specified pengajuan from storage
    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan deleted successfully');
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
