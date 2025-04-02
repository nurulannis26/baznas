<?php

namespace App\Http\Livewire;

use App\Models\DaftarMustahik;
use App\Models\Lampiran;
use App\Models\Mustahik;
use App\Models\Pengurus;
use App\Models\Permohonan;
use App\Models\Surat;
use App\Models\Upz;
use Illuminate\Support\Facades\DB;
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
    public $nama_edit;
    public $nik_edit;
    public $kk_edit;
    public $tempat_lahir_edit;
    public $tgl_lahir_edit;
    public $alamat_mustahik_edit;
    public $nohp_mustahik_edit;
    public $email_edit;
    public $jenis_kelamin_edit;
    public $asnaf_edit;
    public $rt_edit;
    public $rw_edit;
    public $ktp_url_edit;
    public $kk_url_edit;
    public $foto_url_edit;
    public $keterangan_edit;
    public $keterangan_lampiran_edit;
    public $url_edit;

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
        // Ambil semua ID permohonan yang akan dihapus
        $permohonanIds = DB::table('permohonan')->pluck('permohonan_id');

        if ($permohonanIds->isNotEmpty()) {
            // Hapus data di tabel mustahik
            DB::table('mustahik')->whereIn('daftar_mustahik_id', function ($query) use ($permohonanIds) {
                $query->select('daftar_mustahik_id')
                    ->from('daftar_mustahik')
                    ->whereIn('permohonan_id', $permohonanIds);
            })->delete();

            // Hapus data di tabel daftar_mustahik
            DB::table('daftar_mustahik')->whereIn('permohonan_id', $permohonanIds)->delete();

            // Hapus data di tabel permohonan
            DB::table('permohonan')->whereIn('permohonan_id', $permohonanIds)->delete();
        }

        // Hapus data di tabel lampiran
        $lampiran = Lampiran::where('permohonan_id', $this->permohonan_id)->first();
        if ($lampiran) {
            Lampiran::where('permohonan_id', $this->permohonan_id)->delete();
            if ($lampiran->url != null) {
                $path = public_path() . "/uploads/pengajuan_lampiran/" . $lampiran->url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        $this->dispatchBrowserEvent('success', ['message' => 'Permohonan Berhasil Dihapus']);
        return redirect()->route('permohonan')->with('success', 'Data permohonan berhasil dihapus.');
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
        if ($this->foto_url) {
            $ext = $this->foto_url->extension();
            $file_name = Str::uuid()->toString() . '.' . $ext;
            $this->foto_url->storeAs('uploads/foto_diri', $file_name);
        }

        if ($this->ktp_url) {
            $ext = $this->ktp_url->extension();
            $file_name_ktp = Str::uuid()->toString() . '.' . $ext;
            $this->ktp_url->storeAs('uploads/ktp', $file_name_ktp);
        }

        if ($this->kk_url) {
            $ext = $this->kk_url->extension();
            $file_name_kk = Str::uuid()->toString() . '.' . $ext;
            $this->kk_url->storeAs('uploads/kk', $file_name_kk);
        }

        $mustahik = Mustahik::create([
            'mustahik_id' => Str::uuid(),
            'nama' => $this->nama,
            'nik' => $this->nik,
            'kk' => $this->kk,
            'tempat_lahir' => $this->tempat_lahir,
            'tgl_lahir' => $this->tgl_lahir,
            'alamat' => $this->alamat_mustahik,
            'nohp' => $this->nohp_mustahik,
            'email' => $this->email,
            'jenis_kelamin' => $this->jenis_kelamin,
            'asnaf_id' => $this->asnaf,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'ktp_url' => $file_name_ktp,
            'kk_url' => $file_name_kk,
            'foto_url' => $file_name,
        ]);

        $daftar_mustahik = DaftarMustahik::create([
            'daftar_mustahik_id' => Str::uuid(),
            'permohonan_id' => $this->permohonan_id,
            'mustahik_id' => $mustahik->mustahik_id,
        ]);

        session()->flash('alert_mustahik', 'Mustahik berhasil ditambahkan!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function modal_mustahik_ubah($mustahik_id)
    {
        $mustahik = Mustahik::where('mustahik_id', $mustahik_id)->first();
        
        $this->nama_edit = $mustahik->nama;
        $this->nik_edit = $mustahik->nik;
        $this->kk_edit = $mustahik->kk;
        $this->tempat_lahir_edit = $mustahik->tempat_lahir;
        $this->tgl_lahir_edit = $mustahik->tgl_lahir;
        $this->alamat_mustahik_edit = $mustahik->alamat;
        $this->nohp_mustahik_edit = $mustahik->nohp;
        $this->email_edit = $mustahik->email;
        $this->jenis_kelamin_edit = $mustahik->jenis_kelamin;
        $this->asnaf_edit = $mustahik->asnaf_id;
        $this->rt_edit = $mustahik->rt;
        $this->rw_edit = $mustahik->rw;
        $this->ktp_url_edit = $mustahik->ktp_url;
        $this->kk_url_edit = $mustahik->kk_url;
        $this->foto_url_edit = $mustahik->foto_url;
    }

    public function mustahik_ubah($mustahik_id)
    {
        $mustahik = Mustahik::where('mustahik_id', $mustahik_id)->first();

        if ($this->foto_url_edit != NULL) {
            if ($mustahik->foto_url != null) {
                $path = public_path() . "/uploads/foto_diri" . $mustahik->foto_url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->foto_url_edit->extension();
            $foto_url_name = Str::uuid()->toString() . '.' . $ext;
            $this->foto_url_edit->storeAs('uploads/foto_diri', $foto_url_name);
        } else {
            $foto_url_name = $mustahik->foto_url;
        }

        if ($this->ktp_url_edit != NULL) {
            if ($mustahik->ktp_url != null) {
                $path = public_path() . "/uploads/ktp" . $mustahik->ktp_url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->ktp_url_edit->extension();
            $ktp_url_name = Str::uuid()->toString() . '.' . $ext;
            $this->ktp_url_edit->storeAs('uploads/ktp', $ktp_url_name);
        } else {
            $ktp_url_name = $mustahik->ktp_url;
        }

        if ($this->kk_url_edit != NULL) {
            if ($mustahik->kk_url != null) {
                $path = public_path() . "/uploads/kk" . $mustahik->kk_url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->kk_url_edit->extension();
            $kk_url_name = Str::uuid()->toString() . '.' . $ext;
            $this->kk_url_edit->storeAs('uploads/kk', $kk_url_name);
        } else {
            $kk_url_name = $mustahik->kk_url;
        }

        Mustahik::where('mustahik_id', $mustahik->mustahik_id)->update([
            'nama' => $this->nama_edit,
            'nik' => $this->nik_edit,
            'kk' => $this->kk_edit,
            'tempat_lahir' => $this->tempat_lahir_edit,
            'tgl_lahir' => $this->tgl_lahir_edit,
            'alamat' => $this->alamat_mustahik_edit,
            'nohp' => $this->nohp_mustahik_edit,
            'email' => $this->email_edit,
            'jenis_kelamin' => $this->jenis_kelamin_edit,
            'asnaf_id' => $this->asnaf_edit,
            'rt' => $this->rt_edit,
            'rw' => $this->rw_edit,
            'ktp_url' => $ktp_url_name,
            'kk_url' => $kk_url_name,
            'foto_url' => $foto_url_name,
        ]);

        session()->flash('alert_mustahik', 'Mustahik berhasil diubah!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function modal_mustahik_hapus()
    {

    }

    public function mustahik_hapus()
    {
        $mustahik = Mustahik::where('mustahik_id', $this->mustahik_id)->first();
        if ($mustahik->foto_url != null) {
            $path = public_path() . "/uploads/foto_diri" . $mustahik->foto_url;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        if ($mustahik->ktp_url != null) {
            $path = public_path() . "/uploads/ktp" . $mustahik->ktp_url;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        if ($mustahik->kk_url != null) {
            $path = public_path() . "/uploads/kk" . $mustahik->kk_url;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        DaftarMustahik::where('mustahik_id', $this->mustahik_id)->delete();
        Mustahik::where('mustahik_id', $this->mustahik_id)->delete();
        session()->flash('alert_mustahik', 'Mustahik berhasil dihapus!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function modal_lampiran_pengajuan_tambah()
    {

    }

    public function lampiran_pengajuan_tambah()
    {
        if ($this->url) {
            $ext = $this->url->extension();
            $file_name = Str::uuid()->toString() . '.' . $ext;
            $this->url->storeAs('uploads/lampiran_pengajuan', $file_name);
        }

        Lampiran::create([
            'lampiran_id' => Str::uuid(),
            'permohonan_id' => $this->permohonan_id,
            'keterangan' => $this->keterangan_lampiran,
            'url' => $file_name,
            'jenis' => 'Permohonan'
        ]);

        session()->flash('alert_lampiran', 'Lampiran berhasil ditambahkan!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
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
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();

        if ($this->url_edit != NULL) {
            if ($lampiran->url != null) {
                $path = public_path() . "/uploads/lampiran_pengajuan" . $lampiran->url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->url_edit->extension();
            $url_name = Str::uuid()->toString() . '.' . $ext;
            $this->url_edit->storeAs('uploads/lampiran_pengajuan', $url_name);
        } else {
            $url_name = $lampiran->url;
        }

        Lampiran::where('lampiran_id', $lampiran->lampiran_id)->update([
            'keterangan' => $this->keterangan_lampiran_edit,
            'url' => $url_name,
        ]);
        
        session()->flash('alert_lampiran', 'Lampiran berhasil diubah!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function lampiran_pengajuan_hapus()
    {
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();
        if ($lampiran->url != null) {
            $path = public_path() . "/uploads/lampiran_pengajuan" . $lampiran->url;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        Lampiran::where('lampiran_id', $this->lampiran_id)->delete();
        session()->flash('alert_lampiran', 'Lampiran berhasil dihapus!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
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
