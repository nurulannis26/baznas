<?php

namespace App\Http\Livewire;

use App\Models\Lampiran;
use App\Models\Permohonan;
use Livewire\Component;



class DetailPermohonan extends Component
{
    public $permohonan_id;
    public $lampiran_id;

    public function mount()
    {
       
    }

    public function render()
    {
        $dp = Permohonan::leftJoin('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
        ->leftJoin('surat', 'surat.surat_id', '=', 'permohonan.surat_id')
        ->where('permohonan_id', $this->permohonan_id)->select('permohonan.*', 'upz.*', 'surat.*')->first();

        $lampiran_pengajuan = Lampiran::where('permohonan_id', $this->permohonan_id)
        ->where('jenis', 'Permohonan')->get();

        $lampiran_survey = Lampiran::where('permohonan_id', $this->permohonan_id)
        ->where('jenis', 'Survey')->get();

        $lampiran_pencairan = Lampiran::where('permohonan_id', $this->permohonan_id)
        ->where('jenis', 'Pencairan')->get();

        return view('livewire.detail-permohonan', compact(
            'dp', 
            'lampiran_pengajuan', 
            'lampiran_survey', 
            'lampiran_pencairan'
        ));
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

    public function modal_lampiran_pengajuan_tambah()
    {

    }

    public function lampiran_pengajuan_tambah()
    {

    }

    public function modal_lampiran_pengajuan_ubah($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }

    public function modal_lampiran_pengajuan_hapus($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }

    public function lampiran_pengajuan_ubah()
    {

    }

    public function lampiran_pengajuan_hapus()
    {

    }


}
