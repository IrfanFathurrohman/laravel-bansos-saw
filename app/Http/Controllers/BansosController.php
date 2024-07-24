<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use Illuminate\Http\Request;

class BansosController extends Controller
{
    
    public function bansos($id = null)
    {
        $bansos = Bansos::all();
        $editBansos = $id ? Bansos::find($id) : null;
        return view('bansos', compact('bansos', 'editBansos'));
    }

    public function tambah_data(Request $request)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        Bansos::create($request->all());

        return redirect('/bansos')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        return $this->bansos($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required'
        ]);

        $bansos = Bansos::findOrFail($id);
        $bansos->update($request->all());

        return redirect('/bansos')->with('success', 'Data berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $bansos = Bansos::findOrFail($id);
        $bansos->delete();

        return redirect('/bansos')->with('success', 'Data berhasil dihapus.');
    }
}
