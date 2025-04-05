<?php

namespace App\Http\Livewire;

use App\Models\Program as ModelsProgram;
use App\Models\SubProgram;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Program extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $page_number = '5';
    public $cari;

    // pilar
    public $id_program;
    public $program;
    public $ubah_pilar;

    // kegiatan
    public $sub_program_id;
    public $program_id;
    public $pilar;
    public $no_urut;
    public $kegiatan;
    public $ubah_kegiatan;
    public $ubah_no_urut;

    public function render()
    {
        $pilars = ModelsProgram::orderBy('created_at', 'ASC')->get();
        // dd($pilars);


        if ($this->program_id == NULL) {
            $kegiatans = NULL;
        } else {
            $kegiatans = SubProgram::where('program_id', $this->program_id)
                        // Pencarian
                        ->when($this->cari, function ($query) {
                            return $query->where('sub_program', 'like', '%' . $this->cari . '%')
                                ->orWhere('no_urut', 'like', '%' . $this->cari . '%');
                        })
                        // Sorting numerik
                        ->orderByRaw("
                            CAST(SUBSTRING_INDEX(no_urut, '.', 1) AS UNSIGNED) ASC,
                            CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(no_urut, '.', -2), '.', 1) AS UNSIGNED) ASC,
                            CAST(SUBSTRING_INDEX(no_urut, '.', -1) AS UNSIGNED) ASC
                        ")
                        ->paginate($this->page_number);
        }
        $this->updatingSearch();
        return view(
            'livewire.program',
            compact('pilars', 'kegiatans')
        );
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function click_kegiatan($program_id, $pilar)
    {
        // dd('wdw');

        $this->program_id = $program_id;
        $this->pilar = $pilar;
    }

    public function modal_kegiatan_tambah()
    {
        $lastKegiatan = SubProgram::where('program_id', $this->program_id)
            ->orderByRaw("
            CAST(SUBSTRING_INDEX(no_urut, '.', 1) AS UNSIGNED) desc,
            CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(no_urut, '.', -2), '.', 1) AS UNSIGNED) desc,
            CAST(SUBSTRING_INDEX(no_urut, '.', -1) AS UNSIGNED) desc
        ")
        ->first();
        // dd($lastKegiatan);

        // Tentukan no_urut baru
        if ($lastKegiatan) {
            $lastNoUrut = $lastKegiatan->no_urut;
            $parts = explode('.', $lastNoUrut);
            $mainNumber = $parts[0]; // Bagian sebelum titik
            $subNumber = isset($parts[1]) ? (int)$parts[1] : 0; // Bagian setelah titik
            $newSubNumber = $subNumber + 1; // Tambahkan 1
            $this->no_urut = "$mainNumber.$newSubNumber"; // Format baru
        } else {
            $this->no_urut = "1.1"; // Jika tidak ada data, mulai dari 1.1
        }

        $this->kegiatan = '';
    }

    public function modal_kegiatan_ubah($sub_program_id, $kegiatan, $no_urut)
    {
        $this->sub_program_id = $sub_program_id;
        $this->ubah_kegiatan = $kegiatan;
        $this->ubah_no_urut = $no_urut;
    }

    public function modal_kegiatan_hapus($sub_program_id)
    {
        $this->sub_program_id = $sub_program_id;
    }

    public function tambah_kegiatan()
    {
        SubProgram::create([
            'sub_program_id' => Str::uuid(),
            // 'id_program' => $this->id_program,
            'program_id' => $this->program_id,
            'no_urut' => $this->no_urut,
            'sub_program' => $this->kegiatan
        ]);

        session()->flash('alert_kegiatan', 'Sub Program Berhasil Ditambahkan');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }


    public function ubah_kegiatan()
    {
        SubProgram::where('sub_program_id', $this->sub_program_id)->update([
            'no_urut' => $this->ubah_no_urut,
            'sub_program' => $this->ubah_kegiatan
        ]);

        // set kegiatan yang baru untuk tampil
        $this->kegiatan = $this->ubah_kegiatan;

        session()->flash('alert_kegiatan', 'Sub Program Berhasil Diubah');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModal');
    }

    public function hapus_kegiatan()
    {
        try {
            SubProgram::where('sub_program_id', $this->sub_program_id)->delete();
            session()->flash('alert_kegiatan', 'Sub Program Berhasil Dihapus');
            $this->emit('waktu_alert');
        } catch (\Exception $e) {
            session()->flash('alert_danger', 'Sub Program Tidak Bisa Dihapus');
            $this->emit('waktu_alert');
        }
    }


}
