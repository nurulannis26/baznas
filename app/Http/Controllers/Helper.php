<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Helper extends Controller
{
    public static function getNohpPengurus($id)
    {
        $pengguna = DB::table('pengguna')->where('pengurus_id', $id)->first();

        if (!$pengguna || empty($pengguna->nohp)) {
            return null;
        }

        $nohp = preg_replace('/[^0-9]/', '', $pengguna->nohp); // buang karakter aneh

        if (substr($nohp, 0, 1) === '0') {
            $nohp = '62' . substr($nohp, 1);
        }

        return $nohp;
    }

}
