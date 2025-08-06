<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Helper;
use App\Models\DaftarMustahik;
use App\Models\Lampiran;
use App\Models\Mustahik;
use App\Models\Pengguna;
use App\Models\Pengurus;
use App\Models\Permohonan;
use App\Models\SubProgram;
use App\Models\Program;
use App\Models\Surat;
use App\Models\Upz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Http;



class DetailPermohonan extends Component
{
    use WithFileUploads;
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
    public $permohonan_nama_entitas_edit;
    public $permohonan_nohp_entitas_edit;
    public $permohonan_alamat_entitas_edit;
    public $permohonan_namapj_entitas_edit;
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
    public $nama;
    public $nik;
    public $kk;
    public $tempat_lahir;
    public $tgl_lahir;
    public $alamat_mustahik;
    public $nohp_mustahik;
    public $email;
    public $jenis_kelamin;
    public $asnaf;
    public $rt;
    public $rw;
    public $foto_url;
    public $ktp_url;
    public $kk_url;
    public $keterangan_lampiran;
    public $url;
    public $keterangan_lampiran_survey;
    public $url_survey;
    public $keterangan_survey_edit;
    public $url_survey_edit;
    public $keterangan_lampiran_pencairan;
    public $url_pencairan;
    public $keterangan_lampiran_pencairan_edit;
    public $url_pencairan_edit;
    public $keterangan_lampiran_pyl;
    public $url_pyl;
    public $keterangan_lampiran_pyl_edit;
    public $url_pyl_edit;
    public $nama_mustahik_edit;
    public $nkk_edit;
    public $jumlah_kk_edit;
    public $jumlah_jiwa_edit;
    public $jenis_bantuan_edit;
    public $tgl_realisasi_edit;
    public $nominal_bantuan_edit;
    public $nkk;
    public $jumlah_kk;
    public $jumlah_jiwa;
    public $jenis_bantuan;
    public $nominal_bantuan;
    public $tgl_realisai;

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
        $dp = Permohonan::leftJoin('surat', 'surat.surat_id', '=', 'permohonan.surat_id')
        ->where('permohonan_id', $this->permohonan_id)->select('permohonan.*', 'surat.*')->first();

        $lampiran_pengajuan = Lampiran::where('permohonan_id', $this->permohonan_id)
        ->where('jenis', 'Permohonan')->get();

        $lampiran_survey = Lampiran::where('permohonan_id', $this->permohonan_id)
        ->where('jenis', 'Survey')->get();

        $lampiran_pencairan = Lampiran::where('permohonan_id', $this->permohonan_id)
        ->where('jenis', 'Pencairan')->get();

        $lampiran_pyl = Lampiran::where('permohonan_id', $this->permohonan_id)
        ->where('jenis', 'LPJ')->get();

        $mustahik = Mustahik::where('permohonan_id', $this->permohonan_id)
        ->orderBy('created_at', 'desc')
        ->get();

        $petugas_survey = Pengurus::join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->join('divisi', 'divisi.divisi_id', '=', 'jabatan.divisi_id')
        ->join('pengguna', 'pengguna.pengurus_id', '=', 'pengurus.pengurus_id')
        ->where('divisi.divisi_id', '041a203d-80bb-45ef-acc8-0c0edeafd747') // Pastikan where menggunakan divisi.divisi_id
        ->select('pengguna.pengurus_id', 'pengguna.nama')
        ->get();

        $penggunas = Pengguna::with('pengurus.jabatan.divisi')->get();

        return view('livewire.detail-permohonan', compact(
            'dp', 
            'lampiran_pengajuan', 
            'lampiran_survey', 
            'lampiran_pencairan',
            'lampiran_pyl',
            'mustahik',
            'petugas_survey',
            'penggunas'
        ));
    }

    public function hydrate()
    {
        $this->emit('loadContactDeviceSelect2');
        $this->emit('select2');
    }

    public function reset_edit()
    {
        $this->permohonan_jenis_edit = NULL;
        $this->permohonan_nomor_edit = NULL;
        $this->permohonan_nama_pemohon_edit = NULL;
        $this->permohonan_alamat_pemohon_edit = NULL;
        $this->permohonan_nohp_pemohon_edit = NULL;
        $this->permohonan_nama_entitas_edit = NULL;
        $this->permohonan_nohp_entitas_edit = NULL;
        $this->permohonan_alamat_entitas_edit = NULL;
        $this->permohonan_namapj_entitas_edit = NULL;
        $this->asnaf_id_edit = NULL;
        $this->program_id_edit = NULL;
        $this->sub_program_id_edit = NULL;
        $this->permohonan_nominal_edit = NULL;
        $this->permohonan_bentuk_bantuan_edit = NULL;
        $this->permohonan_catatan_input_edit = NULL;
        $this->permohonan_status_input_edit = NULL;
        $this->surat_nomor_edit = NULL;
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
        $data = Permohonan::leftJoin('surat', 'surat.surat_id', '=', 'permohonan.surat_id')
        ->where('permohonan.permohonan_id', $permohonan_id)->first();


        $this->nohp_edit = $data->nohp;
        $this->alamat_edit = $data->alamat;
        $this->pj_nama_edit = $data->pj_nama;
        $this->pj_jabatan_edit = $data->pj_jabatan;
        $this->pj_nohp_edit = $data->pj_nohp;
        $this->keterangan_edit = $data->keterangan;
        
        $this->surat_judul_edit = $data->surat_judul;
        $this->surat_nomor_edit = $data->surat_nomor;
        $this->surat_tgl_edit = $data->surat_tgl;

        $this->permohonan_jenis_edit = $data->permohonan_jenis;
        $this->permohonan_nomor_edit = $data->permohonan_nomor;
        $this->permohonan_nama_pemohon_edit = $data->permohonan_nama_pemohon;
        $this->permohonan_nohp_pemohon_edit = $data->permohonan_nohp_pemohon;
        $this->permohonan_alamat_pemohon_edit = $data->permohonan_alamat_pemohon;
        $this->permohonan_nama_entitas_edit = $data->permohonan_nama_entitas;
        $this->permohonan_nohp_entitas_edit = $data->permohonan_nohp_entitas;
        $this->permohonan_alamat_entitas_edit = $data->permohonan_alamat_entitas;
        $this->permohonan_namapj_entitas_edit = $data->permohonan_namapj_entitas;
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
        $data = Permohonan::leftJoin('surat', 'surat.surat_id', '=', 'permohonan.surat_id')
        ->where('permohonan.permohonan_id', $this->permohonan_id)->first();
        $surat_id = $data->value('surat_id');


        if ($this->surat_url_edit != NULL) {
            // dd($this->surat_url_edit);
            if ($data->surat_url != null) {
                $path = public_path() . "/uploads/permohonan" . $data->surat_url;
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

    public function nama_pengurus($id)
    {
        $a = DB::table('pengguna')->where('pengguna.pengurus_id', $id)->first();
        return $a ? $a->nama : null;
    }

    public function jabatan_pengurus($id)
    {
        $a = DB::table('pengguna')->join('pengurus', 'pengurus.pengurus_id', '=', 'pengguna.pengurus_id')->join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->where('pengguna.pengurus_id', $id)->first();
        return $a ? $a->jabatan : null;
    }

    public function nama_sub($id)
    {
        $a = SubProgram::where('sub_program_id', $id)->first();

        return  $a->sub_program ?? '';
    }

    public function nama_program($id)
    {
        $a = Program::where('program_id', $id)->first();

        return  $a->program ?? '';
    }

    public function selesai_input($permohonan_id)
    {
        $data_detail = Permohonan::where('permohonan_id', $permohonan_id)->first();
        Permohonan::where('permohonan_id', $permohonan_id)->update([
            'permohonan_status_input' => 'Selesai Input',
        ]);

        if ($data_detail->permohonan_jenis == "Individu") {
            $pemohon =$data_detail->permohonan_nama_pemohon;
        } elseif ($data_detail->permohonan_jenis == "Entitas") {
            $pemohon = $data_detail->permohonan_namapj_entitas;
        } 

        $atasan = DB::table('pengguna')->join('pengurus', 'pengurus.pengurus_id', '=', 'pengguna.pengurus_id')
        ->join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->join('divisi', 'divisi.divisi_id', '=', 'jabatan.divisi_id')
        ->where('divisi.divisi_id', '0e883f67-9130-43cf-ac95-54395388538b')
        ->where('pengguna.status', '1')
        ->first();
        
        // dd($atasan);

        $asnaf = DB::table('asnaf')->where('asnaf_id', $data_detail->asnaf_id)->value('asnaf');
        // $url =  "https://e-tasyaruf.nucarecilacap.id/detail-permohonan/" . $this->permohonan_id;

        $this->notif(
            // Helper::getNohpPengurus($atasan->pengurus_id),
            '089639481199',

            "Assalamualaikum Warahmatullahi Wabarakatuh" . "\n" . "\n" .

                "Yth. " . "*" . $this->nama_pengurus($atasan->pengurus_id) .  "*" . "\n" .
                $this->jabatan_pengurus($atasan->pengurus_id) . "\n" . "\n" .

                "*Permohonan telah selesai diinput.*" . "\n" . "\n" .

                "# Permohonan Baznas Cilacap" .  "\n"  . "\n" .
                "*" .  "Nomor"  . "*" .  "\n" .
                $data_detail->permohonan_nomor  . "\n" .
                "*" .  "Tanggal Permohonan"  . "*" .  "\n" .
                \Carbon\Carbon::parse($data_detail->permohonan_tgl)->isoFormat('D MMMM Y')  .  "\n" .
                "*" .  "Nama Pemohon"  . "*" .  "\n" .
                $data_detail->permohonan_jenis . " - " . $pemohon  .  "\n" .
                "*" .  "Nominal Diajukkan"  . "*" .  "\n" .
                'Rp' . number_format($data_detail->permohonan_nominal, 0, '.', '.')  . "\n" . "\n" .
                "========================" . "\n" ."\n" .
                "*" .  "Asnaf"  . "*" .  "\n" .
                $asnaf .  "\n" .
                "*" .  "Pilar"  . "*" .  "\n" .
                $this->nama_program($data_detail->program_id) .  "\n" .
                $this->nama_sub($data_detail->sub_program_id) .  "\n" .
                "*" .  "Keterangan Permohonan"  . "*" .  "\n" .
                $data_detail->permohonan_catatan_input .  "\n" . "\n" .

                "Terima Kasih." 
                // url($url)
        );
        

        $this->emit('waktu_alert');
        session()->flash('alert_permohonan', 'Pengajuan telah selesai input!');
    }

    public function batal_input($permohonan_id)
    {
        $data_detail = Permohonan::where('permohonan_id', $permohonan_id)->first();
        Permohonan::where('permohonan_id', $permohonan_id)->update([
            'permohonan_status_input' => 'Belum Selesai Input',
        ]);

        $this->emit('waktu_alert');
        session()->flash('alert_permohonan', 'Pengajuan telah dibatalkan!');
    }

    public function modal_mustahik_tambah()
    {

    }

    public function tambah_mustahik()
    {
        // dd($this->ktp_url);
        // if ($this->foto_url) {
        //     $ext = $this->foto_url->extension();
        //     $file_name = Str::uuid()->toString() . '.' . $ext;
        //     $this->foto_url->storeAs('foto_diri', $file_name);
        // }

        // if ($this->ktp_url) {
        // //     dd('baba');
        //     $ext = $this->ktp_url->extension();
        //     $file_name_ktp = Str::uuid()->toString() . '.' . $ext;
        //     $this->ktp_url->storeAs('ktp', $file_name_ktp);
        // }

        // if ($this->kk_url) {
        //     $ext = $this->kk_url->extension();
        //     $file_name_kk = Str::uuid()->toString() . '.' . $ext;
        //     $this->kk_url->storeAs('kk', $file_name_kk);
        // }

        $mustahik = Mustahik::create([
            'mustahik_id' => Str::uuid(),
            'nama_mustahik' => $this->nama_mustahik,
            'nik' => $this->nik,
            'nkk' => $this->nkk,
            'tgl_lahir' => $this->tgl_lahir,
            'alamat' => $this->alamat_mustahik,
            'nohp' => $this->nohp_mustahik,
            'jumlah_kk' => $this->jumlah_kk,
            'jumlah_jiwa' => $this->jumlah_jiwa,
            'jenis_bantuan' => $this->jenis_bantuan,
            'nominal_bantuan' => $this->nominal_bantuan,
            'tgl_realisai' => $this->tgl_realisai,
            'keterangan' => $this->keterangan,
        ]);

        session()->flash('alert_mustahik', 'Mustahik berhasil ditambahkan!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function modal_mustahik_ubah($mustahik_id)
    {
        $mustahik = Mustahik::where('mustahik_id', $mustahik_id)->first();
        $this->mustahik_id = $mustahik_id;
        $this->nama_mustahik_edit = $mustahik->nama_mustahik;
        $this->nik_edit = $mustahik->nik;
        $this->nkk_edit = $mustahik->nkk;
        $this->nohp_mustahik_edit = $mustahik->nohp;
        $this->tgl_lahir_edit = $mustahik->tgl_lahir;
        $this->alamat_mustahik_edit = $mustahik->alamat;
        $this->jumlah_kk_edit = $mustahik->jumlah_kk;
        $this->jumlah_jiwa_edit = $mustahik->jumlah_jiwa;
        $this->jenis_bantuan_edit = $mustahik->jenis_bantuan;
        $this->nominal_bantuan_edit = $mustahik->nominal_bantuan;
        $this->tgl_realisasi_edit = $mustahik->tgl_realisasi;
        $this->keterangan_edit = $mustahik->keterangan;
        // $this->ktp_url_edit = $mustahik->ktp_url;
        // $this->kk_url_edit = $mustahik->kk_url;
        // $this->foto_url_edit = $mustahik->foto_url;
    }

    public function ubah_mustahik()
    {
        $mustahik = Mustahik::where('mustahik_id', $this->mustahik_id)->first();

        // if ($this->foto_url_edit != NULL) {
        //     if ($mustahik->foto_url != null) {
        //         $path = public_path() . "/uploads/foto_diri" . $mustahik->foto_url;
        //         if (file_exists($path)) {
        //             unlink($path);
        //         }
        //     }

        //     $ext = $this->foto_url_edit->extension();
        //     $foto_url_name = Str::uuid()->toString() . '.' . $ext;
        //     $this->foto_url_edit->storeAs('uploads/foto_diri', $foto_url_name);
        // } else {
        //     $foto_url_name = $mustahik->foto_url;
        // }

        // if ($this->ktp_url_edit != NULL) {
        //     if ($mustahik->ktp_url != null) {
        //         $path = public_path() . "/uploads/ktp" . $mustahik->ktp_url;
        //         if (file_exists($path)) {
        //             unlink($path);
        //         }
        //     }

        //     $ext = $this->ktp_url_edit->extension();
        //     $ktp_url_name = Str::uuid()->toString() . '.' . $ext;
        //     $this->ktp_url_edit->storeAs('uploads/ktp', $ktp_url_name);
        // } else {
        //     $ktp_url_name = $mustahik->ktp_url;
        // }

        // if ($this->kk_url_edit != NULL) {
        //     if ($mustahik->kk_url != null) {
        //         $path = public_path() . "/uploads/kk" . $mustahik->kk_url;
        //         if (file_exists($path)) {
        //             unlink($path);
        //         }
        //     }

        //     $ext = $this->kk_url_edit->extension();
        //     $kk_url_name = Str::uuid()->toString() . '.' . $ext;
        //     $this->kk_url_edit->storeAs('uploads/kk', $kk_url_name);
        // } else {
        //     $kk_url_name = $mustahik->kk_url;
        // }

        Mustahik::where('mustahik_id', $mustahik->mustahik_id)->update([
            'nama_mustahik' => $this->nama_mustahik_edit,
            'nik' => $this->nik_edit,
            'nkk' => $this->nkk_edit,
            'tgl_lahir' => $this->tgl_lahir_edit,
            'alamat' => $this->alamat_mustahik_edit,
            'nohp' => $this->nohp_mustahik_edit,
            'jumlah_kk' => $this->jumlah_kk_edit,
            'jumlah_jiwa' => $this->jumlah_jiwa_edit,
            'jenis_bantuan' => $this->jenis_bantuan_edit,
            'nominal_bantuan' => $this->nominal_bantuan_edit,
            'tgl_realisasi' => $this->tgl_realisasi_edit,
            'keterangan' => $this->keterangan_edit,
            // 'ktp_url' => $ktp_url_name,
            // 'kk_url' => $kk_url_name,
            // 'foto_url' => $foto_url_name,
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
        // if ($mustahik->foto_url != null) {
        //     $path = public_path() . "/uploads/foto_diri" . $mustahik->foto_url;
        //     if (file_exists($path)) {
        //         unlink($path);
        //     }
        // }

        // if ($mustahik->ktp_url != null) {
        //     $path = public_path() . "/uploads/ktp" . $mustahik->ktp_url;
        //     if (file_exists($path)) {
        //         unlink($path);
        //     }
        // }

        // if ($mustahik->kk_url != null) {
        //     $path = public_path() . "/uploads/kk" . $mustahik->kk_url;
        //     if (file_exists($path)) {
        //         unlink($path);
        //     }
        // }

        // DaftarMustahik::where('mustahik_id', $this->mustahik_id)->delete();
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
            $this->url->storeAs('lampiran_pengajuan', $file_name);
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
        if ($this->url_pencairan) {
            $ext = $this->url_pencairan->extension();
            $file_name = Str::uuid()->toString() . '.' . $ext;
            $this->url_pencairan->storeAs('lampiran_pencairan', $file_name);
        }

        Lampiran::create([
            'lampiran_id' => Str::uuid(),
            'permohonan_id' => $this->permohonan_id,
            'keterangan' => $this->keterangan_lampiran_pencairan,
            'url' => $file_name,
            'jenis' => 'Pencairan'
        ]);

        session()->flash('alert_la', 'Lampiran berhasil ditambahkan!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function modal_lampiran_pyl_tambah()
    {

    }

    public function lampiran_pyl_tambah()
    {
        // dd($this->url_pyl);
        if ($this->url_pyl) {
            $ext = $this->url_pyl->extension();
            $file_name = Str::uuid()->toString() . '.' . $ext;
            $this->url_pyl->storeAs('lampiran_pyl', $file_name);
        }

        Lampiran::create([
            'lampiran_id' => Str::uuid(),
            'permohonan_id' => $this->permohonan_id,
            'keterangan' => $this->keterangan_lampiran_pyl,
            'url' => $file_name,
            'jenis' => 'LPJ'
        ]);

        session()->flash('alert_lp', 'Lampiran berhasil ditambahkan!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function modal_lampiran_survey_tambah()
    {
        
    }
    public function lampiran_survey_tambah()
    {
        if ($this->url_survey) {
            $ext = $this->url_survey->extension();
            $file_name = Str::uuid()->toString() . '.' . $ext;
            $this->url_survey->storeAs('lampiran_survey', $file_name);
        }

        Lampiran::create([
            'lampiran_id' => Str::uuid(),
            'permohonan_id' => $this->permohonan_id,
            'keterangan' => $this->keterangan_lampiran_survey,
            'url' => $file_name,
            'jenis' => 'Survey'
        ]);

        session()->flash('alert_lampiran_survey', 'Lampiran berhasil ditambahkan!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function modal_lampiran_pengajuan_ubah($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();
        $this->keterangan_lampiran_edit = $lampiran->keterangan;
    }

    public function modal_lampiran_pengajuan_hapus($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }
    public function modal_lampiran_pyl_ubah($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();
        $this->keterangan_lampiran_pyl_edit = $lampiran->keterangan;
    }
    public function modal_lampiran_pyl_hapus($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }

    public function modal_lampiran_survey_ubah($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();
        $this->keterangan_survey_edit = $lampiran->keterangan;
    }

    public function modal_lampiran_survey_hapus($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
    }

    public function modal_lampiran_pencairan_ubah($lampiran_id)
    {
        $this->lampiran_id = $lampiran_id;
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();
        $this->keterangan_lampiran_pencairan_edit = $lampiran->keterangan;
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
            $this->url_edit->storeAs('lampiran_pengajuan', $url_name);
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
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();

        if ($this->url_survey_edit != NULL) {
            if ($lampiran->url != null) {
                $path = public_path() . "/uploads/lampiran_survey" . $lampiran->url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->url_survey_edit->extension();
            $url_name = Str::uuid()->toString() . '.' . $ext;
            $this->url_survey_edit->storeAs('lampiran_survey', $url_name);
        } else {
            $url_name = $lampiran->url;
        }

        Lampiran::where('lampiran_id', $lampiran->lampiran_id)->update([
            'keterangan' => $this->keterangan_survey_edit,
            'url' => $url_name,
        ]);
        
        session()->flash('alert_lampiran_survey', 'Lampiran berhasil diubah!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function lampiran_survey_hapus()
    {
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();
        if ($lampiran->url != null) {
            $path = public_path() . "/uploads/lampiran_survey" . $lampiran->url;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        Lampiran::where('lampiran_id', $this->lampiran_id)->delete();
        session()->flash('alert_lampiran_survey', 'Lampiran berhasil dihapus!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function lampiran_pencairan_ubah()
    {
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();

        if ($this->url_pencairan_edit != NULL) {
            if ($lampiran->url != null) {
                $path = public_path() . "/uploads/lampiran_pencairan" . $lampiran->url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->url_pencairan_edit->extension();
            $url_name = Str::uuid()->toString() . '.' . $ext;
            $this->url_pencairan_edit->storeAs('lampiran_pencairan', $url_name);
        } else {
            $url_name = $lampiran->url;
        }

        Lampiran::where('lampiran_id', $lampiran->lampiran_id)->update([
            'keterangan' => $this->keterangan_lampiran_pencairan_edit,
            'url' => $url_name,
        ]);
        
        session()->flash('alert_la', 'Lampiran berhasil diubah!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function lampiran_pyl_hapus()
    {
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();
        if ($lampiran->url != null) {
            $path = public_path() . "/uploads/lampiran_pyl" . $lampiran->url;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        Lampiran::where('lampiran_id', $this->lampiran_id)->delete();
        session()->flash('alert_lp', 'Lampiran berhasil dihapus!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function lampiran_pyl_ubah()
    {
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();

        if ($this->url_pyl_edit != NULL) {
            if ($lampiran->url != null) {
                $path = public_path() . "/uploads/lampiran_pyl" . $lampiran->url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->url_pyl_edit->extension();
            $url_name = Str::uuid()->toString() . '.' . $ext;
            $this->url_pyl_edit->storeAs('lampiran_pyl', $url_name);
        } else {
            $url_name = $lampiran->url;
        }

        Lampiran::where('lampiran_id', $lampiran->lampiran_id)->update([
            'keterangan' => $this->keterangan_lampiran_pyl_edit,
            'url' => $url_name,
        ]);
        
        session()->flash('alert_lampiran', 'Lampiran berhasil diubah!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function lampiran_pencairan_hapus()
    {
        $lampiran = Lampiran::where('lampiran_id', $this->lampiran_id)->first();
        if ($lampiran->url != null) {
            $path = public_path() . "/uploads/lampiran_pencairan" . $lampiran->url;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        Lampiran::where('lampiran_id', $this->lampiran_id)->delete();
        session()->flash('alert_la', 'Lampiran berhasil dihapus!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function acc_atasan()
    {
        $data = Permohonan::where('permohonan_id', $this->permohonan_id)->first();

        $permohonan = Permohonan::where('permohonan_id', $this->permohonan_id)->update([
            'permohonan_timestamp_atasan' => $this->permohonan_timestamp_atasan,
            'survey_pilihan' => $this->survey_pilihan,
            'survey_petugas_survey' => $this->survey_petugas_survey,
            'permohonan_catatan_atasan' => $this->permohonan_catatan_atasan,
            'permohonan_status_atasan' => 'Diterima',
            'permohonan_petugas_atasan' => Auth::user()->pengurus_id,
            'survey_status' => 'Belum Selesai',
        ]);

        if ($data->permohonan_jenis == "Individu") {
            $pemohon =$data->permohonan_nama_pemohon;
        } elseif ($data->permohonan_jenis == "Entitas") {
            $pemohon = $data->permohonan_namapj_entitas;
        } 

        $survey = DB::table('pengguna')->join('pengurus', 'pengurus.pengurus_id', '=', 'pengguna.pengurus_id')
        ->join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->join('divisi', 'divisi.divisi_id', '=', 'jabatan.divisi_id')
        ->where('divisi.divisi_id', '78e31483-4c70-4736-8768-621ec862b30d')
        ->where('pengguna.status', '1')
        ->first();

        $keuangan = DB::table('pengguna')->join('pengurus', 'pengurus.pengurus_id', '=', 'pengguna.pengurus_id')
        ->join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->join('divisi', 'divisi.divisi_id', '=', 'jabatan.divisi_id')
        ->where('divisi.divisi_id', 'e6e554db-da6a-42d7-8bd7-3ccdb250fb2e')
        ->where('pengguna.status', '1')
        ->first();

        $asnaf = DB::table('asnaf')->where('asnaf_id', $data->asnaf_id)->value('asnaf');
        // $url =  "https://e-tasyaruf.nucarecilacap.id/detail-permohonan/" . $this->permohonan_id;

        if ($this->survey_pilihan == 'Perlu') {
            $this->notif(
                // Helper::getNohpPengurus($survey->pengurus_id),
                '089639481199',
    
                "Assalamualaikum Warahmatullahi Wabarakatuh" . "\n" . "\n" .
    
                    "Yth. " . "*" . $this->nama_pengurus($survey->pengurus_id) .  "*" . "\n" .
                    $this->jabatan_pengurus($survey->pengurus_id) . "\n" . "\n" .
    
                     "*Permohonan disetujui Atasan.*" . "\n" . "*Segera input lampiran dokumentasi & hasil survey*" . "\n" . "\n" .
                    "*Konfirmasi jika telah selesai survey.*" . "\n" . "\n" .
    
                    "# Permohonan Baznas Cilacap" .  "\n"  . "\n" .
                    "*" .  "Nomor"  . "*" .  "\n" .
                    $data->permohonan_nomor  . "\n" .
                    "*" .  "Tanggal Permohonan"  . "*" .  "\n" .
                    \Carbon\Carbon::parse($data->permohonan_tgl)->isoFormat('D MMMM Y')  .  "\n" .
                    "*" .  "Nama Pemohon"  . "*" .  "\n" .
                    $data->permohonan_jenis . " - " . $pemohon  .  "\n" .
                    "*" .  "Nominal Diajukkan"  . "*" .  "\n" .
                    'Rp' . number_format($data->permohonan_nominal, 0, '.', '.')  . "\n" . "\n" .
                    "========================" . "\n" ."\n" .
                    "*" .  "Asnaf"  . "*" .  "\n" .
                    $asnaf .  "\n" .
                    "*" .  "Pilar"  . "*" .  "\n" .
                    $this->nama_program($data->program_id) .  "\n" .
                    $this->nama_sub($data->sub_program_id) .  "\n" .
                    "*" .  "Keterangan Permohonan"  . "*" .  "\n" .
                    $data->permohonan_catatan_input .  "\n" . "\n" .
    
                    "Terima Kasih." 
                    // url($url)
            );
        } else {
            $this->notif(
                // Helper::getNohpPengurus($keuangan->pengurus_id),
                '089639481199',
    
                "Assalamualaikum Warahmatullahi Wabarakatuh" . "\n" . "\n" .
    
                    "Yth. " . "*" . $this->nama_pengurus($keuangan->pengurus_id) .  "*" . "\n" .
                    $this->jabatan_pengurus($keuangan->pengurus_id) . "\n" . "\n" .
    
                     "*Permohonan disetujui Atasan (Tanpa Survey).*" . "\n" . "\n" .
    
                    "# Permohonan Baznas Cilacap" .  "\n"  . "\n" .
                    "*" .  "Nomor"  . "*" .  "\n" .
                    $data->permohonan_nomor  . "\n" .
                    "*" .  "Tanggal Permohonan"  . "*" .  "\n" .
                    \Carbon\Carbon::parse($data->permohonan_tgl)->isoFormat('D MMMM Y')  .  "\n" .
                    "*" .  "Nama Pemohon"  . "*" .  "\n" .
                    $data->permohonan_jenis . " - " . $pemohon  .  "\n" .
                    "*" .  "Nominal Diajukkan"  . "*" .  "\n" .
                    'Rp' . number_format($data->permohonan_nominal, 0, '.', '.')  . "\n" . "\n" .
                    "========================" . "\n" ."\n" .
                    "*" .  "Asnaf"  . "*" .  "\n" .
                    $asnaf .  "\n" .
                    "*" .  "Pilar"  . "*" .  "\n" .
                    $this->nama_program($data->program_id) .  "\n" .
                    $this->nama_sub($data->sub_program_id) .  "\n" .
                    "*" .  "Keterangan Permohonan"  . "*" .  "\n" .
                    $data->permohonan_catatan_input .  "\n" . "\n" .
    
                    "Terima Kasih." 
                    // url($url)
            );
        }
        

        session()->flash('alert_atasan', 'Permohonan berhasil di ACC oleh Atasan');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
        $this->none_block_acc_atasan = 'none';
    }

    public function tolak_atasan()
    {
        $data = Permohonan::where('permohonan_id', $this->permohonan_id)->first();

        $permohonan = Permohonan::where('permohonan_id', $this->permohonan_id)->update([
            'denial_date_atasan' => $this->denial_date_atasan,
            'survey_pilihan' => null,
            'survey_petugas_survey' => null,
            'denial_note_atasan' => $this->denial_note_atasan,
            'permohonan_status_atasan' => 'Ditolak',
            'permohonan_petugas_atasan' => Auth::user()->pengurus_id,
        ]);

        if ($data->permohonan_jenis == "Individu") {
            $pemohon =$data->permohonan_nama_pemohon;
        } elseif ($data->permohonan_jenis == "Entitas") {
            $pemohon = $data->permohonan_namapj_entitas;
        } 

        $asnaf = DB::table('asnaf')->where('asnaf_id', $data->asnaf_id)->value('asnaf');

        $front = DB::table('pengguna')->join('pengurus', 'pengurus.pengurus_id', '=', 'pengguna.pengurus_id')
        ->join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->join('divisi', 'divisi.divisi_id', '=', 'jabatan.divisi_id')
        ->where('divisi.divisi_id', '83c88d02-3d27-45d4-95a5-9a9c56ae61f0')
        ->where('pengguna.status', '1')
        ->first();

        $this->notif(
            // Helper::getNohpPengurus($front->pengurus_id),
            '6289639481199',

            "Assalamualaikum Warahmatullahi Wabarakatuh" . "\n" . "\n" .

                "Yth. " . "*" . $this->nama_pengurus($front->pengurus_id) .  "*" . "\n" .
                $this->jabatan_pengurus($front->pengurus_id) . "\n" . "\n" .

                 "*" .  "Mohon segera ditinjau kembali"  . "*" .  "\n" .
                "Permohonan telah " . "*" . "di-tolak" . "*" . " oleh Atasan, dengan detail sebagai berikut :" . "\n" . "\n" .

                "# Permohonan Baznas Cilacap" .  "\n"  . "\n" .
                    "*" .  "Nomor"  . "*" .  "\n" .
                    $data->permohonan_nomor  . "\n" .
                    "*" .  "Tanggal Permohonan"  . "*" .  "\n" .
                    \Carbon\Carbon::parse($data->permohonan_tgl)->isoFormat('D MMMM Y')  .  "\n" .
                    "*" .  "Nama Pemohon"  . "*" .  "\n" .
                    $data->permohonan_jenis . " - " . $pemohon  .  "\n" .
                    "*" .  "Nominal Diajukkan"  . "*" .  "\n" .
                    'Rp' . number_format($data->permohonan_nominal, 0, '.', '.')  . "\n" . "\n" .
                    "========================" . "\n" ."\n" .
                    "*" .  "Asnaf"  . "*" .  "\n" .
                    $asnaf .  "\n" .
                    "*" .  "Pilar"  . "*" .  "\n" .
                    $this->nama_program($data->program_id) .  "\n" .
                    $this->nama_sub($data->sub_program_id) .  "\n" .
                    "*" .  "Keterangan Permohonan"  . "*" .  "\n" .
                    $data->permohonan_catatan_input .  "\n" . "\n" .

                "Terima Kasih." 
                // url($url)
        );

        session()->flash('alert_atasan', 'Permohonan berhasil di Tolak oleh Atasan');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
        $this->none_block_tolak_atasan = 'none';
    }

    public function survey()
    {
        $data = Permohonan::where('permohonan_id', $this->permohonan_id);

        if ($this->survey_form_url) {
            $ext = $this->survey_form_url->extension();
            $file_name = Str::uuid()->toString() . '.' . $ext;
            $this->survey_form_url->storeAs('lampiran_survey', $file_name);
        }

        $permohonan = Permohonan::where('permohonan_id', $this->permohonan_id)->update([
            'survey_tgl' => $this->survey_tgl,
            'survey_form_url' => $file_name,
            'survey_hasil' => $this->survey_hasil,
            'survey_catatan' => $this->survey_catatan,
            'survey_status' => 'Selesai',
            'survey_petugas_survey' => Auth::user()->pengurus_id,
            'survey_petugas_pyl' => $this->survey_petugas_survey,
        ]);

        if ($this->permohonan_jenis == "Individu") {
            $pemohon =$this->permohonan_nama_pemohon;
        } elseif ($this->permohonan_jenis == "Entitas") {
            $pemohon =$this->permohonan_namapj_entitas;
        } 

        $keuangan = DB::table('pengguna')->join('pengurus', 'pengurus.pengurus_id', '=', 'pengguna.pengurus_id')
        ->join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->join('divisi', 'divisi.divisi_id', '=', 'jabatan.divisi_id')
        ->where('divisi.divisi_id', 'e6e554db-da6a-42d7-8bd7-3ccdb250fb2e')
        ->where('pengguna.status', '1')
        ->first();

        $asnaf = DB::table('asnaf')->where('asnaf_id', $data->asnaf_id)->value('asnaf');

        $this->notif(
            // Helper::getNohpPengurus($keuangan->pengurus_id),
            '089639481199',

            "Assalamualaikum Warahmatullahi Wabarakatuh" . "\n" . "\n" .

                "Yth. " . "*" . $this->nama_pengurus($keuangan->pengurus_id) .  "*" . "\n" .
                $this->jabatan_pengurus($keuangan->pengurus_id) . "\n" . "\n" .

                 "*Permohonan telah selesai survey.*" . "\n" . "\n" .

                "# Permohonan Baznas Cilacap" .  "\n"  . "\n" .
                "*" .  "Nomor"  . "*" .  "\n" .
                $data->permohonan_nomor  . "\n" .
                "*" .  "Tanggal Permohonan"  . "*" .  "\n" .
                \Carbon\Carbon::parse($data->permohonan_tgl)->isoFormat('D MMMM Y')  .  "\n" .
                "*" .  "Nama Pemohon"  . "*" .  "\n" .
                $data->permohonan_jenis . " - " . $pemohon  .  "\n" .
                "*" .  "Nominal Diajukkan"  . "*" .  "\n" .
                'Rp' . number_format($data->permohonan_nominal, 0, '.', '.')  . "\n" . "\n" .
                "========================" . "\n" ."\n" .
                "*" .  "Asnaf"  . "*" .  "\n" .
                $asnaf .  "\n" .
                "*" .  "Pilar"  . "*" .  "\n" .
                $this->nama_program($data->program_id) .  "\n" .
                $this->nama_sub($data->sub_program_id) .  "\n" .
                "*" .  "Keterangan Permohonan"  . "*" .  "\n" .
                $data->permohonan_catatan_input .  "\n" . "\n" .

                "Terima Kasih." 
                // url($url)
        );

        session()->flash('alert_survey', 'Survey berhasil di ACC');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
        $this->none_block_survey = 'none';
    }

    public function penyaluran()
    {
        if ($this->pyl_form_url) {
            $ext = $this->pyl_form_url->extension();
            $file_name = Str::uuid()->toString() . '.' . $ext;
            $this->pyl_form_url->storeAs('penyaluran', $file_name);
        }

        $permohonan = Permohonan::where('permohonan_id', $this->permohonan_id)->update([
            'pyl_tgl' => $this->pyl_tgl,
            'pyl_form_url' => $file_name,
            'pyl_hasil' => $this->pyl_hasil,
            'pyl_catatan' => $this->pyl_catatan,
            'pyl_status' => 'Selesai',
            'survey_petugas_pyl' => Auth::user()->pengurus_id,
        ]);

        session()->flash('alert_pyl', 'Penyaluran telah Selesai dilakukan');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
        $this->none_block_pyl = 'none';
    }

    public function acc_pencairan()
    {
        $data = Permohonan::where('permohonan_id', $this->permohonan_id)->first();

        $permohonan = Permohonan::where('permohonan_id', $this->permohonan_id)->update([
            'pencairan_timestamp' => $this->pencairan_timestamp,
            'pencairan_nominal' => str_replace('.', '', $this->pencairan_nominal), 
            'pencairan_sumberdana' => $this->pencairan_sumberdana ?? '-',
            'pencairan_catatan' => $this->pencairan_catatan,
            'pencairan_status' => 'Berhasil Dicairkan',
            'pencairan_petugas_keuangan' => Auth::user()->pengurus_id,
        ]);

       if ($data->permohonan_jenis == "Individu") {
            $pemohon =$data->permohonan_nama_pemohon;
        } elseif ($data->permohonan_jenis == "Entitas") {
            $pemohon = $data->permohonan_namapj_entitas;
        } 

        $front = DB::table('pengguna')->join('pengurus', 'pengurus.pengurus_id', '=', 'pengguna.pengurus_id')
        ->join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->join('divisi', 'divisi.divisi_id', '=', 'jabatan.divisi_id')
        ->where('divisi.divisi_id', '83c88d02-3d27-45d4-95a5-9a9c56ae61f0')
        ->where('pengguna.status', '1')
        ->first();

        $asnaf = DB::table('asnaf')->where('asnaf_id', $data->asnaf_id)->value('asnaf');

        $this->notif(
            // Helper::getNohpPengurus($front->pengurus_id),
            '089639481199',

            "Assalamualaikum Warahmatullahi Wabarakatuh" . "\n" . "\n" .

                "Yth. " . "*" . $this->nama_pengurus($front->pengurus_id) .  "*" . "\n" .
                $this->jabatan_pengurus($front->pengurus_id) . "\n" . "\n" .

                 "*Permohonan telah berhasil dicairkan.*" . "\n" . "\n" .

                "# Permohonan Baznas Cilacap" .  "\n"  . "\n" .
                "*" .  "Nomor"  . "*" .  "\n" .
                $data->permohonan_nomor  . "\n" .
                "*" .  "Tanggal Permohonan"  . "*" .  "\n" .
                \Carbon\Carbon::parse($data->permohonan_tgl)->isoFormat('D MMMM Y')  .  "\n" .
                "*" .  "Nama Pemohon"  . "*" .  "\n" .
                $data->permohonan_jenis . " - " . $pemohon  .  "\n" .
                "*" .  "Nominal Diajukkan"  . "*" .  "\n" .
                'Rp' . number_format($data->permohonan_nominal, 0, '.', '.')  . "\n" . "\n" .
                "========================" . "\n" ."\n" .
                "*" .  "Asnaf"  . "*" .  "\n" .
                $asnaf .  "\n" .
                "*" .  "Pilar"  . "*" .  "\n" .
                $this->nama_program($data->program_id) .  "\n" .
                $this->nama_sub($data->sub_program_id) .  "\n" .
                "*" .  "Keterangan Permohonan"  . "*" .  "\n" .
                $data->permohonan_catatan_input .  "\n" . "\n" .

                "Terima Kasih." 
                // url($url)
        );

        session()->flash('alert_pencairan', 'Pencairan berhasil di ACC Keuangan');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
        $this->none_block_acc_pencairan = 'none';
    }

    public function tolak_pencairan()
    {
        $data = Permohonan::where('permohonan_id', $this->permohonan_id);
        
        $permohonan = Permohonan::where('permohonan_id', $this->permohonan_id)->update([
            'denial_date_pencairan' => $this->denial_date_pencairan,
            'pencairan_nominal' => null, 
            'pencairan_sumberdana' => null,
            'denial_note_pencairan' => $this->denial_note_pencairan,
            'pencairan_status' => 'Ditolak',
            'pencairan_petugas_keuangan' => Auth::user()->pengurus_id,
        ]);

        if ($this->permohonan_jenis == "Individu") {
            $pemohon =$this->permohonan_nama_pemohon;
        } elseif ($this->permohonan_jenis == "Entitas") {
            $pemohon =$this->permohonan_namapj_entitas;
        } 

        $asnaf = DB::table('asnaf')->where('asnaf_id', $data->asnaf_id)->value('asnaf');

        $front = DB::table('pengguna')->join('pengurus', 'pengurus.pengurus_id', '=', 'pengguna.pengurus_id')
        ->join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->join('divisi', 'divisi.divisi_id', '=', 'jabatan.divisi_id')
        ->where('divisi.divisi_id', '83c88d02-3d27-45d4-95a5-9a9c56ae61f0')
        ->where('pengguna.status', '1')
        ->first();

        $this->notif(
            // Helper::getNohpPengurus($front->pengurus_id),
            '089639481199',

            "Assalamualaikum Warahmatullahi Wabarakatuh" . "\n" . "\n" .

                "Yth. " . "*" . $this->nama_pengurus($front->pengurus_id) .  "*" . "\n" .
                $this->jabatan_pengurus($front->pengurus_id) . "\n" . "\n" .

                "*" .  "Mohon segera ditinjau kembali"  . "*" .  "\n" .
                "Permohonan telah " . "*" . "di-tolak" . "*" . " oleh Bagian Keuangan, dengan detail sebagai berikut :" . "\n" . "\n" .

                "# Permohonan Baznas Cilacap" .  "\n"  . "\n" .
                "*" .  "Nomor"  . "*" .  "\n" .
                $data->permohonan_nomor  . "\n" .
                "*" .  "Tanggal Permohonan"  . "*" .  "\n" .
                \Carbon\Carbon::parse($data->permohonan_tgl)->isoFormat('D MMMM Y')  .  "\n" .
                "*" .  "Nama Pemohon"  . "*" .  "\n" .
                $data->permohonan_jenis . " - " . $pemohon  .  "\n" .
                "*" .  "Nominal Diajukkan"  . "*" .  "\n" .
                'Rp' . number_format($data->permohonan_nominal, 0, '.', '.')  . "\n" . "\n" .
                "========================" . "\n" ."\n" .
                "*" .  "Asnaf"  . "*" .  "\n" .
                $asnaf .  "\n" .
                "*" .  "Pilar"  . "*" .  "\n" .
                $this->nama_program($data->program_id) .  "\n" .
                $this->nama_sub($data->sub_program_id) .  "\n" .
                "*" .  "Keterangan Permohonan"  . "*" .  "\n" .
                $data->permohonan_catatan_input .  "\n" . "\n" .

                "Terima Kasih." 
                // url($url)
        );

        session()->flash('alert_pencairan', 'Pencairan berhasil di Tolak Keuangan');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
        $this->none_block_tolak_pencairan = 'none';
    }

    

    public function notif($nomor, $pesan)
    {
        $url = "http://103.23.198.175:3125/sendMessageTextWithveriyExistsNumber";

        $data = [
            'id' => $nomor . '@s.whatsapp.net',
            'text' => $pesan,
            'token' => 'eyJSb2xlIjoiQWRtaW4iLCJJc3N1ZXIiOiJJc3N1ZXIiLCJVc2VybmFtZSI6IkphdmFJblVzZSIsImV4cCI6MTY4ODg5NzMyNSwiaWF0IjoxNjg4ODk3MzI1fQ', // ganti dengan token kamu yang valid
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->post($url, $data);

        if ($response->successful()) {
            // Kirim berhasil
            session()->flash('success', 'Notifikasi WA berhasil dikirim');
        } else {
            // Kirim gagal
            session()->flash('error', 'Gagal kirim notifikasi WA');
        }
    }


    


}
