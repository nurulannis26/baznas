<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Permohonan as ModelsPermohonan;
use App\Models\Surat;
use App\Models\Upz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public $sub_programs = [];
    public $permohonan_nominal;
    public $permohonan_bentuk_bantuan;
    public $permohonan_catatan_input;

    protected $listeners = ['updateSubProgram'];

    public function updateSubProgram($value)
    {
        $this->sub_program_id = $value; // Simpan nilai yang dipilih
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

    public function updatedProgramId($value)
    {
        $this->sub_programs = DB::table('sub_program')
        ->where('program_id', $value)
        ->get()
        ->toArray();
    }

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

        $data = DB::table('permohonan')->leftJoin('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
        ->select('permohonan.*', 'upz.*')
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


        return view('livewire.permohonan', compact(
            'start_date',
            'end_date',
            'filter_daterange',
            'data'
            ));
    }
    
    public function nama_upz($id)
    {
        $a = DB::table('permohonan')->join('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
        ->where('upz.upz_id', $id)->first();
        return $a->nama;
    }

    public function modal_tambah_permohonan()
    {
    }

    public function updatedPermohonanJenis($value) {
        if (date('m') == '01') {
            $romawi = 'I';
        } elseif (date('m') == '02') {
            $romawi = 'II';
        } elseif (date('m') == '03') {
            $romawi = 'III';
        } elseif (date('m') == '04') {
            $romawi = 'IV';
        } elseif (date('m') == '05') {
            $romawi = 'V';
        } elseif (date('m') == '06') {
            $romawi = 'VI';
        } elseif (date('m') == '07') {
            $romawi = 'VII';
        } elseif (date('m') == '08') {
            $romawi = 'VIII';
        } elseif (date('m') == '09') {
            $romawi = 'IX';
        } elseif (date('m') == '10') {
            $romawi = 'X';
        } elseif (date('m') == '11') {
            $romawi = 'XI';
        } elseif (date('m') == '12') {
            $romawi = 'XII';
        }

        if ($value == 'Individu') {
            $a = ModelsPermohonan::whereYear('created_at', date('Y'))
                ->where('permohonan_jenis', 'Individu')
                ->latest()
                ->first();

            if ($a == NULL) {
                $urut = 0;
            } else {
                $string = $a->permohonan_nomor;

                $pos = strpos($string, '/E-DISDAY');

                $urutt = substr($string, 0, $pos);

                if (!isset($urutt) || strlen($urutt) === 0) {
                    // Handle the case where $urutt is not set or is an empty string
                    $urut = 0; // or some other default value
                } elseif (strlen($urutt) == 1 || strlen($urutt) == 2) {
                    $urut = (int)$urutt;
                } elseif (strlen($urutt) == 3) {
                    $urut1 = (int)$urutt[0] . $urutt[1];
                    $urut = $urut1 . (int)$urutt[2];
                } else {
                    $urut1 = (int)$urutt[0] . $urutt[1];
                    $urut2 = $urut1 . (int)$urutt[2];
                    $urut = $urut2 . (int)$urutt[3];
                }
            }

            if (($urut + 1) < 10) {
                $this->permohonan_nomor = '0' . $urut + 1 . '/' . 'E-DISDAY' . '/INDIVIDU/' . $romawi . '/' . date('Y');
            } else {
                $this->permohonan_nomor = $urut + 1 . '/' . 'E-DISDAY' . '/INDIVIDU/' . $romawi . '/' . date('Y');
            }
        } else if ($value == 'UPZ') {
            $a = ModelsPermohonan::whereYear('created_at', date('Y'))
                ->where('permohonan_jenis', 'UPZ')
                ->latest()
                ->first();

            if ($a == NULL) {
                $urut = 0;
            } else {
                $string = $a->permohonan_nomor;

                $pos = strpos($string, '/E-DISDAY');

                $urutt = substr($string, 0, $pos);

                if (!isset($urutt) || strlen($urutt) === 0) {
                    // Handle the case where $urutt is not set or is an empty string
                    $urut = 0; // or some other default value
                } elseif (strlen($urutt) == 1 || strlen($urutt) == 2) {
                    $urut = (int)$urutt;
                } elseif (strlen($urutt) == 3) {
                    $urut1 = (int)$urutt[0] . $urutt[1];
                    $urut = $urut1 . (int)$urutt[2];
                } else {
                    $urut1 = (int)$urutt[0] . $urutt[1];
                    $urut2 = $urut1 . (int)$urutt[2];
                    $urut = $urut2 . (int)$urutt[3];
                }
            }
            $this->reset('permohonan_nomor');

            if (($urut + 1) < 10) {
                $this->permohonan_nomor = '0' . $urut + 1 . '/' . 'E-DISDAY' . '/UPZ/' . $romawi . '/' . date('Y');
            } else {
                $this->permohonan_nomor = $urut + 1 . '/' . 'E-DISDAY' . '/UPZ/' . $romawi . '/' . date('Y');
            }
        }

        $this->dispatch('$refresh');
    }

    public function hydrate()
    {
        $this->dispatch('loadContactDeviceSelect2');
        $this->dispatch('select2');
    }

    public function tambah_permohonan()
    {
        
        $path = $this->surat_url->store('scan_surat', 'public');

        $surat = Surat::create([
            'surat_id' => Str::uuid(),
            'surat_judul' => $this->surat_judul,
            'surat_nomor' => $this->surat_nomor,
            'surat_tgl' => $this->surat_tgl,
            'surat_keterangan' => null,
            'surat_url' => 'aaaaa'
        ]);
    
        $upz_id = null;
        if ($this->permohonan_jenis === 'UPZ') {
            $upz = Upz::create([
                'upz_id' => Str::uuid(),
                'nohp' => $this->nohp,
                'alamat' => $this->alamat,
                'pj_nama' => $this->pj_nama,
                'pj_jabatan' => $this->pj_jabatan,
                'pj_nohp' => $this->pj_nohp,
                'keterangan' => $this->keterangan,
            ]);

            $upz_id = $upz->upz_id;
        }

    
        $permohonan = ModelsPermohonan::create([
            'permohonan_id' => Str::uuid(),
            'permohonan_jenis' => $this->permohonan_jenis,
            'permohonan_nomor' => $this->permohonan_nomor,
            'permohonan_nama_pemohon' => $this->permohonan_nama_pemohon,
            'permohonan_nohp_pemohon' => $this->permohonan_nohp_pemohon,
            'permohonan_alamat_pemohon' => $this->permohonan_alamat_pemohon,
            'upz_id' => $upz_id, 
            'surat_id' => $surat->surat_id, 
            'asnaf_id' => $this->asnaf_id,
            'program_id' => $this->program_id,
            'sub_program_id' => $this->sub_program_id,
            'permohonan_nominal' => str_replace('.', '', $this->permohonan_nominal),
            'permohonan_bentuk_bantuan' => $this->permohonan_bentuk_bantuan,
            'permohonan_catatan_input' => $this->permohonan_catatan_input,
            'permohonan_status_input' => 'Belum Selesai Input',
            'permohonan_petugas_input' => 'abcd1234',
            'permohonan_tgl' => date('Y-m-d'),
            'permohonan_timestamp_input' => date('Y-m-d H:i:s'),
        ]);

        

        if ($this->permohonan_jenis == "Individu") {
            $pemohon =$this->permohonan_nama_pemohon;
            $nohp =$this->permohonan_nohp_pemohon;
        } elseif ($this->permohonan_jenis == "UPZ") {
            $pemohon =$this->pj_nama;
            $nohp =$this->nohp;
        } 

        return redirect('/detail-permohonan/' . $permohonan->permohonan_id);
    }
    
}
