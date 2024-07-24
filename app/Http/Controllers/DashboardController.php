<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Bansos;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function bansos()
    {
        return view('bansos',[
            'bansos' => Bansos::all()
        ]);
    }
    public function warga()
    {
        return view('warga', [
            'warga' => Warga::all()
        ]);
    }
    public function kriteria()
    {
        return view('kriteria');
    }
    public function bobot()
    {
        return view('bobot');
    }
    public function penilaian()
    {
        return view('penilaian');
    }
    public function pengajuan()
    {
        return view('pengajuan');
    }
    public function lap_seluruh()
    {
        return view('lap_seluruh');
    }
}
