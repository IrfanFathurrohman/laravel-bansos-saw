<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function warga($id = null)
    {
        $warga = Warga::all();
        $editWarga = $id ? Warga::find($id) : null;
        return view('warga', compact('warga', 'editWarga'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|max:20',
            'nama' => 'required|max:50',
            'alamat' => 'required|max:100',
            'jenis_kelamin' => 'required',
        ]);

        Warga::create($validatedData);


        return redirect('/warga')->with('success', 'Tambah Data Berhasil!');
    }

    public function edit($id)
    {
        return $this->warga($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required'
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update($request->all());

        return redirect('/warga')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect('/warga')->with('success', 'Data berhasil dihapus.');
    }
}
