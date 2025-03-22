<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function index()
    {
        return view('permohonan.index');
    }
}
