<?php

namespace App\Http\Livewire;

use App\Models\Pengguna;
use Livewire\Component;

class Pengurus extends Component
{
    public function render()
    {
        $penggunas = Pengguna::with('pengurus.jabatan.divisi')->get();
        // dd($penggunas);
        return view('livewire.pengurus', compact('penggunas'));
    }
}
