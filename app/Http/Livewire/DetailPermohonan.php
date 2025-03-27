<?php

namespace App\Http\Livewire;

use App\Models\Permohonan;
use Livewire\Component;



class DetailPermohonan extends Component
{
    public $permohonan_id;
    public $dp;

    public function mount()
    {
        $this->dp = Permohonan::leftJoin('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
        ->leftJoin('surat', 'surat.surat_id', '=', 'permohonan.surat_id')
        ->where('permohonan_id', $this->permohonan_id)->select('permohonan.*', 'upz.*', 'surat.*')->first();
    }

    public function render()
    {
        return view('livewire.detail-permohonan');
    }

    

    public function modal_permohonan_hapus($permohonan_id)
    {
        $this->permohonan_id = $permohonan_id;
    }

    public function modal_permohonan_ubah($permohonan_id)
    {
        $this->permohonan_id = $permohonan_id;
    }

    public function hapus_permohonan()
    {

    }

    public function ubah_permohonan()
    {

    }

    public function selesai_input($permohonan_id)
    {
        $data_detail = Permohonan::where('permohonan_id', $permohonan_id)->first();
    }

    public function batal_input($permohonan_id)
    {
        $data_detail = Permohonan::where('permohonan_id', $permohonan_id)->first();
    }
}
