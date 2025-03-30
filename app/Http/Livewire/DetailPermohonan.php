<?php

namespace App\Http\Livewire;

use App\Models\DaftarMustahik;
use App\Models\Lampiran;
use App\Models\Pengurus;
use App\Models\Permohonan;
use App\Models\Surat;
use App\Models\Upz;
use Livewire\Component;
use Illuminate\Support\Str;



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
    public $survey_petugas_pyl;
    public $permohonan_catatan_atasan;
    public $denial_date_atasan;
    public $denial_note_atasan;
    public $survey_tgl;
    public $survey_form_url;
    public $survey_hasil;
    public $survey_catatan;
    public $survey_status;
    public $none_block_survey;
    public $none_block_pyl;
    public $none_block_acc_pencairan;
    public $none_block_tolak_pencairan;
    public $pencairan_timestamp;
    public $pencairan_nominal;
    public $denial_date_pencairan;
    public $denial_note_pencairan;
    public $pencairan_catatan;
    public $pyl_tgl;
    public $pyl_form_url;
    public $pyl_hasil;
    public $pyl_catatan;
    public $pyl_status;
    public $permohonan_jenis_edit;
    public $permohonan_nomor_edit;
    public $permohonan_nama_pemohon_edit;
    public $permohonan_alamat_pemohon_edit;
    public $permohonan_nohp_pemohon_edit;
    public $asnaf_id_edit;
    public $program_id_edit;
    public $sub_program_id_edit;
    public $permohonan_nominal_edit;
    public $permohonan_bentuk_bantuan_edit;
    public $permohonan_catatan_input_edit;
    public $permohonan_status_input_edit;
    public $surat_nomor_edit;
    public $upz_edit;
    public $surat_tgl_edit;
    public $nohp_edit;
    public $surat_judul_edit;
    public $pj_nama_edit;
    public $pj_nohp_edit;
    public $pj_jabatan_edit;
    public $surat_url_edit;
    public $alamat_edit;
    public $keterangan_edit;

    public function mount()
    {
        $this->none_block_acc_atasan = 'none';
        $this->none_block_tolak_atasan = 'none';
        $this->none_block_survey = 'none';
        $this->none_block_pyl = 'none';
        $this->none_block_tolak_pencairan = 'none';
        $this->none_block_acc_pencairan = 'none';
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

        $lampiran_pyl = Lampiran::where('permohonan_id', $this->permohonan_id)
        ->where('jenis', 'LPJ')->get();

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
            'lampiran_pyl',
            'daftar_mustahik',
            'petugas_survey',
        ));
    }

    public function reset_edit()
    {
        $this->permohonan_jenis_edit = NULL;
        $this->permohonan_nomor_edit = NULL;
        $this->permohonan_nama_pemohon_edit = NULL;
        $this->permohonan_alamat_pemohon_edit = NULL;
        $this->permohonan_nohp_pemohon_edit = NULL;
        $this->asnaf_id_edit = NULL;
        $this->program_id_edit = NULL;
        $this->sub_program_id_edit = NULL;
        $this->permohonan_nominal_edit = NULL;
        $this->permohonan_bentuk_bantuan_edit = NULL;
        $this->permohonan_catatan_input_edit = NULL;
        $this->permohonan_status_input_edit = NULL;
        $this->surat_nomor_edit = NULL;
        $this->upz_edit = NULL;
        $this->surat_tgl_edit = NULL;
        $this->nohp_edit = NULL;
        $this->surat_judul_edit = NULL;
        $this->pj_nama_edit = NULL;
        $this->pj_nohp_edit = NULL;
        $this->pj_jabatan_edit = NULL;
        $this->surat_url_edit = NULL;
        $this->alamat_edit = NULL;
        $this->keterangan_edit = NULL;
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

    public function tombol_survey()
    {
        if ($this->none_block_survey == 'none') {
            $this->none_block_survey = 'block';
        } elseif ($this->none_block_survey == 'block') {
            $this->none_block_survey = 'none';
        }
    }

    public function tombol_pyl()
    {
        if ($this->none_block_pyl == 'none') {
            $this->none_block_pyl = 'block';
        } elseif ($this->none_block_pyl == 'block') {
            $this->none_block_pyl = 'none';
        }
    }

    public function tombol_acc_pencairan()
    {
        if ($this->none_block_acc_pencairan == 'none') {
            $this->none_block_acc_pencairan = 'block';
        } elseif ($this->none_block_acc_pencairan == 'block') {
            $this->none_block_acc_pencairan = 'none';
        }
    }

    public function tombol_tolak_pencairan()
    {
        if ($this->none_block_tolak_pencairan == 'none') {
            $this->none_block_tolak_pencairan = 'block';
        } elseif ($this->none_block_tolak_pencairan == 'block') {
            $this->none_block_tolak_pencairan = 'none';
        }
    }

    public function close()
    {
        $this->none_block_acc_atasan = 'none';
        $this->none_block_tolak_atasan = 'none';
        $this->none_block_survey = 'none';
        $this->none_block_acc_pencairan = 'none';
        $this->none_block_pyl = 'none';
        $this->none_block_tolak_pencairan = 'none';
    }

    

    public function modal_permohonan_hapus($permohonan_id)
    {
        $this->permohonan_id = $permohonan_id;
    }

    public function modal_permohonan_ubah($permohonan_id)
    {
        $data = Permohonan::leftJoin('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
        ->leftJoin('surat', 'surat.surat_id', '=', 'permohonan.surat_id')
        ->where('permohonan.permohonan_id', $permohonan_id)->first();


        $this->upz_edit = $data->upz;
        $this->nohp_edit = $data->nohp;
        $this->alamat_edit = $data->alamat;
        $this->pj_nama_edit = $data->pj_nama;
        $this->pj_jabatan_edit = $data->pj_jabatan;
        $this->pj_nohp_edit = $data->pj_nohp;
        $this->keterangan_edit = $data->keterangan;
        
        $this->surat_url_edit = $data->surat_url;
        $this->surat_judul_edit = $data->surat_judul;
        $this->surat_nomor_edit = $data->surat_nomor;
        $this->surat_tgl_edit = $data->surat_tgl;

        $this->permohonan_jenis_edit = $data->permohonan_jenis;
        $this->permohonan_nomor_edit = $data->permohonan_nomor;
        $this->permohonan_nama_pemohon_edit = $data->permohonan_nama_pemohon;
        $this->permohonan_nohp_pemohon_edit = $data->permohonan_nohp_pemohon;
        $this->permohonan_alamat_pemohon_edit = $data->permohonan_alamat_pemohon;
        $this->asnaf_id_edit = $data->asnaf_id;
        $this->program_id_edit = $data->program_id;
        $this->sub_program_id_edit = $data->sub_program_id;
        $this->permohonan_nominal_edit = number_format($data->permohonan_nominal, 0, '.', '.');
        $this->permohonan_bentuk_bantuan_edit = $data->permohonan_bentuk_bantuan;
        $this->permohonan_catatan_input_edit = $data->permohonan_catatan_input;
        $this->permohonan_status_input_edit = $data->permohonan_status_input;
        
    }

    public function hapus_permohonan()
    {
        
    }

    public function ubah_permohonan()
    {
        $data = Permohonan::leftJoin('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
        ->leftJoin('surat', 'surat.surat_id', '=', 'permohonan.surat_id')
        ->where('permohonan.permohonan_id', $this->permohonan_id)->first();
        $surat_id = $data->value('surat_id');
        $upz_id = $data->value('upz_id');


        if ($this->surat_url_edit != NULL) {
            if ($data->surat_url != null) {
                $path = public_path() . "/permohonan" . $data->surat_url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->surat_url_edit->extension();
            $surat_url_name = Str::uuid()->toString() . '.' . $ext;
            $this->surat_url_edit->storeAs('permohonan', $surat_url_name);
        } else {
            $surat_url_name = $data->surat_url;
        }

        $surat = Surat::where('surat_id', $surat_id)->update([
            'surat_judul' => $this->surat_judul_edit,
            'surat_nomor' => $this->surat_nomor_edit,
            'surat_tgl' => $this->surat_tgl_edit,
            'surat_keterangan' => null,
            'surat_url' => $surat_url_name,
        ]);

        if ($this->permohonan_jenis_edit === 'UPZ') {
            $upz = Surat::where('upz_id', $upz_id)->update([
                'upz' => $this->upz_edit,
                'nohp' => $this->nohp_edit,
                'alamat' => $this->alamat_edit,
                'pj_nama' => $this->pj_nama_edit,
                'pj_jabatan' => $this->pj_jabatan_edit,
                'pj_nohp' => $this->pj_nohp_edit,
                'keterangan' => $this->keterangan_edit,
            ]);

        }

        $permohonan = Permohonan::where('permohonan_id', $this->permohonan_id)->update([
            'permohonan_jenis' => $this->permohonan_jenis_edit,
            'permohonan_nomor' => $this->permohonan_nomor_edit,
            'permohonan_nama_pemohon' => $this->permohonan_nama_pemohon_edit,
            'permohonan_nohp_pemohon' => $this->permohonan_nohp_pemohon_edit,
            'permohonan_alamat_pemohon' => $this->permohonan_alamat_pemohon_edit,
            'asnaf_id' => $this->asnaf_id_edit,
            'program_id' => $this->program_id_edit,
            'sub_program_id' => $this->sub_program_id_edit,
            'permohonan_nominal' => str_replace('.', '', $this->permohonan_nominal_edit),
            'permohonan_bentuk_bantuan' => $this->permohonan_bentuk_bantuan_edit,
            'permohonan_catatan_input' => $this->permohonan_catatan_input_edit,
        ]);

        session()->flash('alert_permohonan', 'Permohonan berhasil diubah');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
        $this->reset_edit();
    
    }

    public function selesai_input($permohonan_id)
    {
        $data_detail = Permohonan::where('permohonan_id', $permohonan_id)->first();
        Permohonan::where('permohonan_id', $permohonan_id)->update([
            'permohonan_status_input' => 'Selesai Input',
        ]);

        session()->flash('alert_permohonan', 'Pengajuan telah selesai input!');
    }

    public function batal_input($permohonan_id)
    {
        $data_detail = Permohonan::where('permohonan_id', $permohonan_id)->first();
        Permohonan::where('permohonan_id', $permohonan_id)->update([
            'permohonan_status_input' => 'Belum Selesai Input',
        ]);

        session()->flash('alert_permohonan', 'Pengajuan telah dibatalkan!');
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
    public function modal_lampiran_pencairan_tambah()
    {

    }

    public function lampiran_pencairan_tambah()
    {

    }

    public function modal_lampiran_pyl_tambah()
    {

    }

    public function lampiran_pyl_tambah()
    {

    }

    public function modal_lampiran_survey_tambah()
    {

    }
    public function lampiran_survey_tambah()
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
    public function modal_lampiran_pyl_ubah($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }
    public function modal_lampiran_pyl_hapus($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }

    public function modal_lampiran_survey_ubah($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }

    public function modal_lampiran_survey_hapus($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }

    public function modal_lampiran_pencairan_ubah($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }

    public function modal_lampiran_pencairan_hapus($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }

    public function lampiran_pengajuan_ubah()
    {

    }

    public function lampiran_pengajuan_hapus()
    {

    }

    public function lampiran_survey_ubah()
    {

    }

    public function lampiran_survey_hapus()
    {

    }

    public function lampiran_pencairan_ubah()
    {

    }

    public function lampiran_pyl_hapus()
    {

    }

    public function lampiran_pyl_ubah()
    {

    }

    public function lampiran_pencairan_hapus()
    {

    }

    public function acc_atasan()
    {

    }

    public function tolak_atasan()
    {
        
    }

    public function acc_pencairan()
    {

    }

    public function tolak_pencairan()
    {

    }

}
