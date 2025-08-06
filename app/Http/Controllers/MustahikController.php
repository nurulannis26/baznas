<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MustahikController extends Controller
{
    public function index()
    {
        return view('mustahik.index');
    }
}
