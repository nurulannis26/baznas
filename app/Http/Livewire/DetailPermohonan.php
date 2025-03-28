<?php

namespace App\Http\Livewire;

use App\Models\DaftarMustahik;
use App\Models\Lampiran;
use App\Models\Pengurus;
use App\Models\Permohonan;
use Livewire\Component;



class DetailPermohonan extends Component
{
    public $permohonan_id;
    public $lampiran_id;
    public $mustahik_id;
    public $none_block_tolak_atasan;
    public $none_block_acc_atasan;
    public $permohonan_timestamp_atasan;
    public $survey_pilihan;
    public $survey_petugas_survey;
    public $permohonan_catatan_atasan;
    public $denial_date_atasan;
    public $denial_note_atasan;

    public function mount()
    {
        $this->none_block_acc_atasan = 'none';
        $this->none_block_tolak_atasan = 'none';
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

        $daftar_mustahik = DaftarMustahik::join('mustahik', 'mustahik.mustahik_id', '=', 'daftar_mustahik.mustahik_id')
        ->where('daftar_mustahik.permohonan_id', $this->permohonan_id)
        ->select('mustahik.*', 'daftar_mustahik.*')
        ->get();

        $petugas_survey = Pengurus::join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->join('divisi', 'divisi.divisi_id', '=', 'jabatan.divisi_id')
        ->join('pengguna', 'pengguna.pengurus_id', '=', 'pengurus.pengurus_id')
        ->where('divisi.divisi_id', '041a203d-80bb-45ef-acc8-0c0edeafd747') // Pastikan where menggunakan divisi.divisi_id
        ->select('pengguna.pengurus_id', 'pengguna.nama')
        ->get();

        return view('livewire.detail-permohonan', compact(
            'dp', 
            'lampiran_pengajuan', 
            'lampiran_survey', 
            'lampiran_pencairan',
            'daftar_mustahik',
            'petugas_survey',
        ));
    }

    public function tombol_acc_atasan()
    {
        if ($this->none_block_acc_atasan == 'none') {
            $this->none_block_acc_atasan = 'block';
        } elseif ($this->none_block_acc_atasan == 'block') {
            $this->none_block_acc_atasan = 'none';
        }
    }

    public function tombol_tolak_atasan()
    {
        if ($this->none_block_tolak_atasan == 'none') {
            $this->none_block_tolak_atasan = 'block';
        } elseif ($this->none_block_tolak_atasan == 'block') {
            $this->none_block_tolak_atasan = 'none';
        }
    }

    public function close()
    {
        $this->none_block_acc_atasan = 'none';
        $this->none_block_tolak_atasan = 'none';
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

    public function modal_mustahik_tambah()
    {

    }

    public function mustahik_tambah()
    {

    }

    public function modal_mustahik_ubah($mustahik_id)
    {
        $this->mustahik_id = $mustahik_id;
    }

    public function mustahik_ubah($mustahik_id)
    {
        $this->mustahik_id = $mustahik_id;
    }

    public function modal_mustahik_hapus()
    {

    }

    public function mustahik_hapus()
    {

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

    public function acc_atasan()
    {

    }

    public function tolak_atasan()
    {
        
    }


}
