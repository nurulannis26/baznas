<?php

namespace App\Http\Livewire;

use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\Pengguna;
use App\Models\Pengurus as ModelsPengurus;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Pengurus extends Component
{
    use WithFileUploads;
    public $nama_pengurus;
    public $jenis_kelamin_pengurus;
    public $nohp_pengurus;
    public $email_pengurus;
    public $nik_pengurus;
    public $kk_pengurus;
    public $tempat_lahir_pengurus;
    public $tgl_lahir_pengurus;
    public $alamat_pengurus;
    public $rt_pengurus;
    public $rw_pengurus;
    public $foto_url;
    public $ttd_url;
    public $divisi_id;
    public $tgl_mulai;
    public $tgl_selesai;
    public $sk_nomor;
    public $sk_url;
    public $listJabatan = [];
    public $jabatan_id;
    public $pengguna_id;
    public $nama_pengurus_edit;
    public $jenis_kelamin_pengurus_edit;
    public $nohp_pengurus_edit;
    public $email_pengurus_edit;
    public $nik_pengurus_edit;
    public $kk_pengurus_edit;
    public $tgl_lahir_pengurus_edit;
    public $alamat_pengurus_edit;
    public $rt_pengurus_edit;
    public $tempat_lahir_pengurus_edit;
    public $foto_url_edit;
    public $rw_pengurus_edit;
    public $ttd_url_edit;
    public $jabatan_id_edit;
    public $divisi_id_edit;
    public $tgl_mulai_edit;
    public $tgl_selesai_edit;
    public $sk_nomor_edit;
    public $sk_url_edit;


    public function render()
    {
        $penggunas = Pengguna::with('pengurus.jabatan.divisi')->get();
        
        // dd($penggunas);
        return view('livewire.pengurus', compact('penggunas'));
    }

    public function hydrate()
    {
        $this->emit('loadContactDeviceSelect2');
        $this->emit('select2');
    }

    public function updatedDivisiId($value)
    {
        $this->listJabatan = Jabatan::where('divisi_id', $value)->get();
        $this->jabatan_id = null;
    }

    public function modal_tambah_pengurus()
    {

    }

    public function tambah_pengurus()
    {
        if ($this->sk_url) {
            $ext = $this->sk_url->extension();
            $file_name = Str::uuid()->toString() . '.' . $ext;
            $this->sk_url->storeAs('sk', $file_name);
        }

        $pengurus = ModelsPengurus::create([
            'pengurus_id' => Str::uuid(),
            'jabatan_id' => $this->jabatan_id,
            'sk_nomor' => $this->sk_nomor,
            'sk_url' => $file_name ?? null,
            'tgl_mulai' => $this->tgl_mulai,
            'tgl_selesai' => $this->tgl_selesai,
        ]);

        if ($this->foto_url) {
            $ext = $this->foto_url->extension();
            $file_name_foto = Str::uuid()->toString() . '.' . $ext;
            $this->foto_url->storeAs('foto_pengguna', $file_name_foto);
        }
        if ($this->ttd_url) {
            $ext = $this->ttd_url->extension();
            $file_name_ttd = Str::uuid()->toString() . '.' . $ext;
            $this->ttd_url->storeAs('ttd_pengguna', $file_name_ttd);
        }
        Pengguna::create([
            'pengguna_id' => Str::uuid(),
            'pengurus_id' => $pengurus->pengurus_id,
            'driver_id' => null,
            'wilayah_id' => '33.01.21.1002', // Ganti dengan wilayah_id yang sesuai
            'nama' => $this->nama_pengurus,
            'jenis_kelamin' => $this->jenis_kelamin_pengurus,
            'nohp' => $this->nohp_pengurus,
            'email' => $this->email_pengurus,
            'nik' => $this->nik_pengurus,
            'kk' => $this->kk_pengurus,
            'tempat_lahir' => $this->tempat_lahir_pengurus,
            'tgl_lahir' => $this->tgl_lahir_pengurus,
            'alamat' => $this->alamat_pengurus,
            'rt' => $this->rt_pengurus,
            'rw' => $this->rw_pengurus,
            'foto_url' => $file_name_foto ?? null,
            'ttd_url' => $file_name_ttd ?? null,
            'password'=> Hash::make($this->nohp_pengurus),
        ]);

        session()->flash('alert_pengurus', 'Pengurus berhasil ditambahkan!');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('closeModall');

        $this->dispatchBrowserEvent('success', ['message' => 'Data pengurus berhasil ditambah.']);
        return redirect()->route('pengurus')->with('success', 'Data pengurus berhasil ditambah.');
        
    }
    public $selectedId;

    public function modal_edit_pengurus($pengguna_id)
    {
        // dd('kkjk');
        $this->selectedId = $pengguna_id;
        $this->pengguna_id = $pengguna_id;
        $pengurus = Pengguna::with('pengurus.jabatan.divisi')->where('pengguna_id', $pengguna_id)->first();
        $this->nama_pengurus_edit = $pengurus->nama;
        $this->jenis_kelamin_pengurus_edit = $pengurus->jenis_kelamin;
        $this->nohp_pengurus_edit = $pengurus->nohp;
        $this->email_pengurus_edit = $pengurus->email;
        $this->nik_pengurus_edit = $pengurus->nik;
        $this->kk_pengurus_edit = $pengurus->kk;
        $this->tempat_lahir_pengurus_edit = $pengurus->tempat_lahir;
        $this->tgl_lahir_pengurus_edit = $pengurus->tgl_lahir;
        $this->alamat_pengurus_edit = $pengurus->alamat;
        $this->rt_pengurus_edit = $pengurus->rt;
        $this->rw_pengurus_edit = $pengurus->rw;
        $this->jabatan_id_edit = $pengurus->pengurus->jabatan_id;
        $this->divisi_id_edit = $pengurus->pengurus->jabatan->divisi_id;
        $this->tgl_mulai_edit = $pengurus->pengurus->tgl_mulai;
        $this->tgl_selesai_edit = $pengurus->pengurus->tgl_selesai;
        $this->sk_nomor_edit = $pengurus->pengurus->sk_nomor;
        $this->dispatchBrowserEvent('show-edit-modal');

    }

    public function ubah_pengurus()
    {
        $pengurus = Pengguna::with('pengurus.jabatan.divisi')->where('pengguna_id', $this->pengguna_id)->first();
        
        $pengurus_idd = $pengurus->value('pengurus_id');

        if ($this->sk_url_edit != NULL) {
            if ($pengurus->sk_url != null) {
                $path = public_path() . "/uploads/sk" . $pengurus->sk_url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->sk_url_edit->extension();
            $sk_url_name = Str::uuid()->toString() . '.' . $ext;
            $this->sk_url_edit->storeAs('sk', $sk_url_name);
        } else {
            $sk_url_name = $pengurus->pengurus->sk_url;
        }

        if ($this->foto_url_edit != NULL) {
            if ($pengurus->foto_url != null) {
                $path = public_path() . "/uploads/foto_pengguna" . $pengurus->foto_url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->foto_url_edit->extension();
            $foto_url_name = Str::uuid()->toString() . '.' . $ext;
            $this->foto_url_edit->storeAs('foto_pengguna', $foto_url_name);
        } else {
            $foto_url_name = $pengurus->foto_url;
        }

        if ($this->ttd_url_edit != NULL) {
            if ($pengurus->ttd_url != null) {
                $path = public_path() . "/uploads/ttd_pengguna" . $pengurus->ttd_url;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $ext = $this->ttd_url_edit->extension();
            $ttd_url_name = Str::uuid()->toString() . '.' . $ext;
            $this->ttd_url_edit->storeAs('ttd_pengguna', $ttd_url_name);
        } else {
            $ttd_url_name = $pengurus->ttd_url;
        }

        $pengguna = Pengguna::where('pengguna_id', $pengurus->pengguna_id)->update([
            'nama' => $this->nama_pengurus_edit,
            'jenis_kelamin' => $this->jenis_kelamin_pengurus_edit,
            'nohp' => $this->nohp_pengurus_edit,
            'email' => $this->email_pengurus_edit,
            'nik' => $this->nik_pengurus_edit,
            'kk' => $this->kk_pengurus_edit,
            'tempat_lahir' => $this->tempat_lahir_pengurus_edit,
            'tgl_lahir' => $this->tgl_lahir_pengurus_edit,
            'alamat' => $this->alamat_pengurus_edit,
            'rt' => $this->rt_pengurus_edit,
            'rw' => $this->rw_pengurus_edit,
            'foto_url' => $foto_url_name ?? null,
            'ttd_url' => $ttd_url_name ?? null,
        ]);

        $pengurus = ModelsPengurus::where('pengurus_id', $pengurus_idd)->update([
            'jabatan_id' => $this->jabatan_id_edit,
            'sk_nomor' => $this->sk_nomor_edit,
            'sk_url' => $sk_url_name ?? null,
            'tgl_mulai' => $this->tgl_mulai_edit,
            'tgl_selesai' => $this->tgl_selesai_edit,
        ]);

        session()->flash('alertt', 'Pengurus berhasil diubah');
        $this->emit('waktu_alert');
        $this->dispatchBrowserEvent('CloseModall');
        $this->dispatchBrowserEvent('hide-edit-modal');

        $this->dispatchBrowserEvent('success', ['message' => 'Pengurus berhasil diubah']);
        return redirect()->route('pengurus')->with('success', 'Pengurus berhasil diubah');
        
    }
}
