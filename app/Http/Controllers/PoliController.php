<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    public function index()
    {
        return view('poli.index');
    }

    public function show(Poli $poli)
    {
        return view('poli.view', compact('poli'));
    }
}
