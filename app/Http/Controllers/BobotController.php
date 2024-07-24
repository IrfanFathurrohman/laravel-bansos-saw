<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Models\Bansos;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class BobotController extends Controller
{
    public function index()
    {
        $bobot = Bobot::with('bansos', 'kriteria')->get();
        $bansos = Bansos::all();
        $kriteria = Kriteria::all();
        return view('bobot', compact('bobot', 'bansos', 'kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bansos_id' => 'required',
            'kriteria_id' => 'required',
            'bobot' => 'required',
        ]);

        Bobot::create($request->all());

        return redirect()->route('bobot.index')->with('success', 'Data Bobot berhasil ditambahkan');
    }

    public function edit($id)
    {
        $bobotEdit = Bobot::findOrFail($id);
        $bobot = Bobot::with('bansos', 'kriteria')->get();
        $bansos = Bansos::all();
        $kriteria = Kriteria::all();
        return view('bobot', compact('bobot', 'bobotEdit', 'bansos', 'kriteria'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bansos_id' => 'required',
            'kriteria_id' => 'required',
            'bobot' => 'required',
        ]);

        $bobot = Bobot::findOrFail($id);
        $bobot->update($request->all());

        return redirect()->route('bobot.index')->with('success', 'Bobot berhasil diperbarui');
    }

    public function destroy($id)
    {
        $bobot = Bobot::findOrFail($id);
        $bobot->delete();

        return redirect()->route('bobot.index')->with('success', 'Bobot berhasil dihapus');
    }
}
