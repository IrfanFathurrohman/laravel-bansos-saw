<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function navbar()
    {
        $bansos = Bansos::all();
        return view('home.navbar', compact('bansos'));
    }
}
