<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Helper;
use Livewire\Component;
use App\Models\Permohonan as ModelsPermohonan;
use App\Models\Program;
use App\Models\SubProgram;
use App\Models\Surat;
use App\Models\Upz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Permohonan extends Component
{
    use WithFileUploads;
    // filter
    public $filter_permohonan;
    public $filter_daterange;
    public $filters_fo;
    public $filters_atasan;
    public $filters_pencairan;
    public $filters_survey;
    public $filters_lpj;
    public $c_filter_daterange;
    public $c_filters_fo;
    public $c_filters_atasan;
    public $c_filters_pencairan;
    public $c_filters_survey;
    public $c_filters_lpj;
    // tambah permohonan
    public $permohonan_jenis;
    public $permohonan_nomor;
    public $permohonan_nama_pemohon;
    public $permohonan_nohp_pemohon;
    public $permohonan_alamat_pemohon;
    public $upz;
    public $nohp;
    public $alamat;
    public $pj_nama;
    public $pj_jabatan;
    public $pj_nohp;
    public $keterangan;
    public $surat_judul;
    public $surat_nomor;
    public $surat_tgl;
    public $surat_url;
    public $asnaf_id;
    public $program_id;
    public $sub_program_id; 
    public $daftar_program = [];
    public $daftar_kegiatan = [];
    public $daftar_kegiatan2 = [];
    public $permohonan_nominal;
    public $permohonan_bentuk_bantuan;
    public $permohonan_catatan_input;
    public $selectedProgram;
    public $permohonan_tgl;
    
    public $permohonan_nama_entitas;
    public $permohonan_nohp_entitas;
    public $permohonan_alamat_entitas;
    public $permohonan_namapj_entitas;
    public $surat_diterima;
    
    // public $fileName;

    public function updatedSelectedProgram($value)
    {
        // dd($value);
        $this->sub_program_id = $value;
    }

    public function mount()
    {
        if ($this->filter_permohonan == 'on') {
            $this->filter_daterange = $this->c_filter_daterange;
            $this->filters_fo = $this->c_filters_fo;
            $this->filters_atasan = $this->c_filters_atasan;
            $this->filters_pencairan = $this->c_filters_pencairan;
            $this->filters_survey = $this->c_filters_survey;
            $this->filters_lpj = $this->c_filters_lpj;
        } else {
            $currentMonthStartDate = date('Y-m-01');
            $currentMonthEndDate = date('Y-m-t');
            
            $this->filter_daterange = $currentMonthStartDate . '+-+' . $currentMonthEndDate;
            
        }
    }

    // public function updatedSuratUrl()
    // {
    //     if ($this->surat_url) {
    //         $this->fileName = $this->surat_url->getClientOriginalName();
    //     }
    // }

    public function render()
    {
        $date_range = $this->filter_daterange;
        // dd($date_range);    
        // dd($this->filter_daterange);
        $start_date = null;
        $end_date = null;

        if (strpos($date_range, '+-+') !== false) {
            // Case where the date range is formatted with '+-+'
            $date_parts = explode("+-+", $date_range);
            $start_date = $date_parts[0];
            $end_date = $date_parts[1];
        } else {
            // Case where the date range is formatted with ' - '
            $date_parts = explode(" - ", $date_range);
            $start_date = $date_parts[0];
            $end_date = $date_parts[1];
        }

        $filter_daterange = $start_date . ' - ' . $end_date;

        $data = DB::table('permohonan')->select('permohonan.*')
            ->when($filter_daterange != '', function ($query) use ($start_date, $end_date) {
                // filter bulan dan tahun for pengajuan_detail
                return $query->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                    if ($start_date == $end_date) {
                        return $query->whereDate('permohonan_tgl', '=', $start_date);
                    } else {
                        return $query->whereDate('permohonan_tgl', '>=', $start_date)
                            ->whereDate('permohonan_tgl', '<=', $end_date);
                    }
                });
            })
            // filter fo
            ->when($this->filters_fo != 'Semua' && $this->filters_fo != '', function ($query) {
                return $query->where('permohonan_status_input', $this->filters_fo);
            })
            ->when($this->filters_atasan != 'Semua' && $this->filters_atasan != '', function ($query) {
                if ($this->filters_atasan == 'Belum Dicek') {
                    return $query->where('permohonan_status_input', 'Selesai Input');
                } else {
                    return $query->where('permohonan_status_atasan', $this->filters_atasan);
                };
            })
            ->when($this->filters_survey != 'Semua' && $this->filters_survey != '', function ($query) {
                return $query->where('survey_pilihan', $this->filters_survey);
            })
            ->when($this->filters_pencairan != 'Semua' && $this->filters_pencairan != '', function ($query) {
                if ($this->filters_pencairan == 'Belum Dicairkan') {
                    return $query->where('permohonan_status_atasan', 'Diterima');
                } else {
                    return $query->where('pencairan_status', $this->filters_pencairan);
                };
            })
            ->when($this->filters_lpj != 'Semua' && $this->filters_lpj != '', function ($query) {
                return $query->where('tujuan', $this->filters_lpj);
            })
            ->orderBy('permohonan.created_at', 'desc')
            ->get();

            // dd($data);

            $permohonan_total = $data ->count();
            $total_nominal_permohonan = $data->sum('permohonan_nominal');
            $total_nominal_pencairan = $data->sum('pencairan_nominal');
            $cilacap_peduli = $data->where('program_id', '9e2ea277-9550-4ff7-bd6a-5fb36ef30633')->count();
            $cilacap_cerdas = $data->where('program_id', '2a700a8d-dd49-46d3-9e25-2953266cf9a5')->count();
            $cilacap_makmur = $data->where('program_id', '30746c18-3f7a-4736-ae47-ea91154a5a00')->count();
            $cilacap_sehat = $data->where('program_id', 'ce2ac72c-02bc-4d8c-b143-9d526b1edd2b')->count();
            $cilacap_taqwa = $data->where('program_id', 'd578e2e4-23d4-4cc6-9657-2415ba633420')->count();
            $layanan_baznas = $data->where('program_id', 'e47c6712-98b5-42b9-9b47-22f7b843745f')->count();
            $peduli_bencana = $data->where('program_id', 'e47c6722-98b5-42b9-9b37-22f7b8437450')->count();
            $this->daftar_program = Program::orderBy('created_at', 'DESC')->get();
            $this->daftar_kegiatan = SubProgram::where('program_id', $this->program_id)
            ->whereRaw('LENGTH(no_urut) = 3')
            ->orderBy('no_urut', 'ASC')->get();
            // dd($this->daftar_kegiatan);lah 
            $this->daftar_kegiatan2 = SubProgram::where('program_id', $this->program_id)
                ->whereRaw('LENGTH(no_urut) = 4')
                ->orderBy('no_urut', 'ASC')->get();

        return view('livewire.permohonan', compact(
            'start_date',
            'end_date',
            'filter_daterange',
            'data',
            'permohonan_total',
            'total_nominal_permohonan',
            'total_nominal_pencairan',
            'cilacap_peduli',
            'cilacap_cerdas',
            'cilacap_makmur',
            'cilacap_sehat',
            'cilacap_taqwa',
            'layanan_baznas',
            'peduli_bencana',
            ));
    }
    
    // public function nama_upz($id)
    // {
    //     $a = DB::table('permohonan')->join('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
    //     ->where('upz.upz_id', $id)->first();
    //     return $a->nama ?? '-';
    // }

    public function modal_tambah_permohonan()
    {

    }

    public function updatedPermohonanJenis()
{
    $romawi = $this->getRomawi(date('m'));
    
    if ($this->permohonan_jenis == 'Individu') {
        $this->generateNomorPermohonan('INDIVIDU', $romawi);
    } elseif ($this->permohonan_jenis == 'Entitas') {
        $this->generateNomorPermohonan('ENTITAS', $romawi);
    }
}

private function generateNomorPermohonan($jenis, $romawi)
{
    $a = ModelsPermohonan::whereYear('created_at', date('Y'))
        ->where('permohonan_jenis', $jenis)
        ->latest()
        ->first();

    $urut = $a ? $this->extractUrutNumber($a->permohonan_nomor) : 0;

    $this->permohonan_nomor = sprintf('%02d', $urut + 1) . '/E-DISDAY/' . $jenis . '/' . $romawi . '/' . date('Y');
}

private function extractUrutNumber($nomor)
{
    $pos = strpos($nomor, '/E-DISDAY');
    $urutt = substr($nomor, 0, $pos);
    return is_numeric($urutt) ? (int)$urutt : 0;
}

private function getRomawi($month)
{
    $romawi = [
        '01' => 'I', '02' => 'II', '03' => 'III', '04' => 'IV', 
        '05' => 'V', '06' => 'VI', '07' => 'VII', '08' => 'VIII', 
        '09' => 'IX', '10' => 'X', '11' => 'XI', '12' => 'XII'
    ];
    return $romawi[$month];
}


    public function hydrate()
    {
        $this->emit('loadContactDeviceSelect2');
        $this->emit('select2');
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

    public function tambah_permohonan()
    {
        // dd('baba');
        if ($this->surat_url) {
            $ext = $this->surat_url->extension();
            $file_name = Str::uuid()->toString() . '.' . $ext;
            $this->surat_url->storeAs('permohonan', $file_name);
        }
        

        $surat = Surat::create([
            'surat_id' => Str::uuid(),
            'surat_judul' => $this->surat_judul,
            'surat_nomor' => $this->surat_nomor,
            'surat_tgl' => $this->surat_tgl,
            'surat_diterima' => $this->surat_diterima,
            'surat_keterangan' => null,
            'surat_url' => $file_name,
        ]);
    
        

        // dd($this->selectedProgram);

    
        $permohonan = ModelsPermohonan::create([
            'permohonan_id' => Str::uuid(),
            'permohonan_jenis' => $this->permohonan_jenis,
            'permohonan_nomor' => $this->permohonan_nomor,
            'permohonan_nama_pemohon' => $this->permohonan_nama_pemohon,
            'permohonan_nohp_pemohon' => $this->permohonan_nohp_pemohon,
            'permohonan_alamat_pemohon' => $this->permohonan_alamat_pemohon,
            
            'permohonan_nama_entitas' => $this->permohonan_nama_entitas,
            'permohonan_nohp_entitas' => $this->permohonan_nohp_entitas,
            'permohonan_alamat_entitas' => $this->permohonan_alamat_entitas,
            'permohonan_namapj_entitas' => $this->permohonan_namapj_entitas,
            
            'surat_id' => $surat->surat_id, 
            'asnaf_id' => $this->asnaf_id,
            'program_id' => $this->program_id,
            'sub_program_id' => $this->selectedProgram,
            'permohonan_nominal' => str_replace('.', '', $this->permohonan_nominal),
            'permohonan_bentuk_bantuan' => $this->permohonan_bentuk_bantuan,
            'permohonan_catatan_input' => $this->permohonan_catatan_input,
            'permohonan_status_input' => 'Belum Selesai Input',
            'permohonan_status_atasan' => 'Belum Dicek',
            'permohonan_petugas_input' => Auth::user()->pengurus_id,
            'permohonan_tgl' => date('Y-m-d'),
            'permohonan_timestamp_input' => date('Y-m-d H:i:s'),
        ]);
        
        // dd($permohonan);

        

        if ($this->permohonan_jenis == "Individu") {
            $pemohon =$this->permohonan_nama_pemohon;
        } elseif ($this->permohonan_jenis == "Entitas") {
            $pemohon =$this->permohonan_namapj_entitas;
        } 

        $front = DB::table('pengguna')->join('pengurus', 'pengurus.pengurus_id', '=', 'pengguna.pengurus_id')
        ->join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->join('divisi', 'divisi.divisi_id', '=', 'jabatan.divisi_id')
        ->where('divisi.divisi_id', '83c88d02-3d27-45d4-95a5-9a9c56ae61f0')
        ->where('pengguna.status', '1')
        ->first();
        
        // dd($front);

        $asnaf = DB::table('asnaf')->where('asnaf_id', $this->asnaf_id)->value('asnaf');
        // $url =  "https://e-tasyaruf.nucarecilacap.id/detail-permohonan/" . $this->permohonan_id;

        $this->notif(
            Helper::getNohpPengurus($front->pengurus_id),
            // '089639481199',

            "Assalamualaikum Warahmatullahi Wabarakatuh" . "\n" . "\n" .

                "Yth. " ."*". $this->nama_pengurus($front->pengurus_id) ."*". "\n" .
                $this->jabatan_pengurus($front->pengurus_id) . "\n" . "\n" .

                "*Permohonan berhasil diinputkan*" . "\n" . "*Lengkapi lampiran & daftar mustahik lalu konfirmasi selesai input.*" . "\n" . "\n" .

                "# Permohonan Baznas Cilacap" .  "\n"  . "\n" .
                "*" .  "Nomor"  . "*" .  "\n" .
                $this->permohonan_nomor  . "\n" .
                "*" .  "Tanggal Permohonan"  . "*" .  "\n" .
                \Carbon\Carbon::parse($this->permohonan_tgl)->isoFormat('D MMMM Y')  .  "\n" .
                "*" .  "Nama Pemohon"  . "*" .  "\n" .
                $this->permohonan_jenis . " - " . $pemohon  .  "\n" .
                "========================" . "\n" ."\n" .
                "*" .  "Asnaf"  . "*" .  "\n" .
                $asnaf .  "\n" .
                "*" .  "Pilar"  . "*" .  "\n" .
                $this->nama_program($this->program_id) .  "\n" .
                $this->nama_sub($this->sub_program_id) .  "\n" .
                "*" .  "Keterangan Permohonan"  . "*" .  "\n" .
                $this->permohonan_catatan_input .  "\n" . "\n" .

                "Terima Kasih." 
                // url($url)
        );

        $this->dispatchBrowserEvent('closeModal');

        return redirect('/detail-permohonan/' . $permohonan->permohonan_id);
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
