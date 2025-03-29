<div class="card mt-3 ml-2 mr-2">
    <div class="card-body">

        @if ($dp->permohonan_status_input == 'Selesai Input')
            <sup class="text-light badge badge-success">Pengajuan Selesai diinput FO</sup>
        @else
            <sup class="text-light badge badge-warning">Pengajuan Blm Selesai diinput FO</sup>
        @endif

        @if ($dp->permohonan_status_input == 'Selesai Input')
            @if ($dp->permohonan_status_atasan == 'Diterima')
                <sup class="text-light badge badge-success">Sudah Disetujui Atasan</sup>
            @elseif ($dp->permohonan_status_atasan == 'Ditolak')
                <sup class="text-light badge badge-danger">Ditolak Atasan</sup>
            @else
                <sup class="text-light badge badge-warning">Blm Direspon Atasan</sup>
            @endif
        @endif

        @if ($dp->permohonan_status_atasan == 'Diterima')
            @if ($dp->survey_status == 'Selesai')
                <sup class="text-light badge badge-success">Survey Disetujui</sup>
            @else
                <sup class="text-light badge badge-warning">Survey Blm Selesai</sup>
            @endif
        @endif

        @if ($dp->permohonan_status_atasan == 'Diterima')
            @if ($dp->pencairan_status == 'Berhasil Dicairkan')
                <sup class="text-light badge badge-success">Sudah Dicairkan</sup>
            @elseif ($dp->pencairan_status == 'Ditolak')
                <sup class="text-light badge badge-danger">Pencairan Ditolak</sup>
            @else
                <sup class="text-light badge badge-warning">Blm Dicairkan</sup>
            @endif
        @endif

        <br>
        <span>
            <i class="fas fa-info-circle"></i>
            Penyaluran/realisasi. Lampirkan scan hasil lpj dan dokumentasi penyaluran.
        </span>
    </div>
</div>

<div class="tab-persetujuan-atasan">

    <div class="card card-body mt-3 mr-2 ml-2" style="display: {{ $none_block_pyl }};">
        <div class="d-flex justify-content-between align-items-center">
            <b class="text-success">INPUT HASIL PENYALURAN</b>
            <a wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>

        {{-- form --}}
        <form wire:submit.prevent="penyaluran">
            <div class="form-row mt-4">

                {{-- Direktur --}}
                <div class="form-group col-md-6">
                    <input type="input" class="form-control"
                        value="{{ Auth::user()->pengurus->jabatan->jabatan }} - {{ Auth::user()->nama }}" readonly>
                </div>
                {{-- end direktur --}}


                {{-- tgl disetujui --}}
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">
                                Tgl Penyaluran</span>
                        </div>
                        <input wire:model="pyl_tgl" type="date" class="form-control">
                    </div>
                </div>
                {{-- end tgl disetujui --}}

                <div class="form-group col-md-6">
                    <div class="input-group">
                        <input type="file" wire:model="survey_form_url"
                            accept="application/pdf, image/png, image/jpg, image/jpeg" class="custom-file-input"
                            id="file" name="file">
                        <label class="custom-file-label" for="customFile">Masukan file LPJ</label>

                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Hasil</span>
                        </div>
                        <input wire:model="pyl_hasil" type="input" class="form-control " id="survey_hasil"
                            placeholder="Masukan Hasil Penyaluran">

                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Catatan</span>
                        </div>
                        <input wire:model="pyl_catatan" type="input" class="form-control " id="survey_catatan"
                            placeholder="Masukan Catatan">

                    </div>
                </div>


                {{-- info --}}
                <div class="form-group col-md-12">
                    <div class="card card-body " style="background-color:#e0e0e0;">
                        <b>INFORMASI!</b>
                        <span>
                            Dengan klik tombol Simpan, penyaluran dinyatakan selesai. Lampirkan dokumentasi penyaluran/scan LPJ.
                        </span>
                    </div>
                </div>
                {{-- end info --}}

                <div class="form-group col-md-9">
                </div>

                {{-- tombol acc --}}
                <div class="form-group col-md-3">
                    @if ($pyl_hasil == '')
                        <button class="btn btn-success btn-block" disabled wire:loading.attr="disabled"><i
                                class="fas fa-check-circle"></i>
                            Simpan</button>
                    @else
                        <button type="submit" name="submit" class="btn btn-success btn-block"
                            wire:loading.attr="disabled"><i class="fas fa-check-circle"></i>
                            Simpan</button>
                    @endif
                </div>
                {{-- acc --}}

            </div>
        </form>

    </div>
    {{-- end card acc --}}


</div>

<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6  tab-persetujuan_direktur-detail-umum-pc">

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="ml-1">
                <b> A. LPJ & BA  </b>
            </div>
            @if (Auth::user()->pengurus_id != null)
                {{-- <div class="ml-2" style="padding-left: 250px;"> --}}
                <div class="btn-group">

                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" style="background-color: #cccccc">Respon</button>
                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="background-color: #cccccc">
                        <span class="sr-only">Toggle
                            Dropdown</span>
                    </button>

                    <div class="dropdown-menu ">
                        <a wire:click="tombol_pyl" onMouseOver="this.style.color='green'"
                            onMouseOut="this.style.color='black'" class="dropdown-item" data-toggle="modal"
                            data-target="#modal_acc" type="button"><i class="fas fa-user-check"></i>
                            ACC
                        </a>
                    </div>
                </div>
            @endif
        </div>
        {{-- end judul --}}


        @if (session()->has('alert_pyl'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <i class="far fa-check-circle"></i> {{ session('alert_pyl') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        {{-- tabel --}}
        <div class="col-12 mt-2">
            <table class="table  table-bordered">
                @php
                    $petugasPyl = \App\Models\Pengguna::pengguna($dp->survey_petugas_pyl);
                    $jabatanPyl = \App\Models\Pengguna::jabatan($dp->survey_petugas_pyl);

                    if ($dp->pyl_status == 'Selesai') {
                        $bg_pyl = 'badge-success';
                        $ket_pyl = 'Sudah LPJ';
                    } else {
                        $bg_pyl = 'badge-warning';
                        $ket_pyl = 'Belum LPJ';
                    }
                @endphp
                <thead>
                    {{-- disetujui oleh --}}
                    <tr>
                        <td class="text-bold" style="width: 30%;vertical-align: middle;">
                            Direspon Oleh
                        </td>
                        <td style="vertical-align: middle;">
                            @if ($dp->survey_petugas_pyl == null)
                                -
                            @else
                                <b style="font-size: 12pt;">{{ $petugasPyl }}</b>
                                <br>
                                <span style="font-size:11pt;">{{ $jabatanPyl }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Hasil Penyaluran</td>
                        <td class="mr-2">
                            <span class="text-light badge {{ $bg_pyl }}">{{ $ket_pyl }}
                            </span>
                            <br>
                            {{ Carbon\Carbon::parse($dp->pyl_timestamp)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                            <br>
                            <b style="font-size: 12pt;">Catatan Tambahan</b> <br>
                            <span>
                                {{ $dp->pyl_hasil ?? '-' }}<br>
                            </span>
                            <span>
                                {{ $dp->pyl_catatan ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Scan Form LPJ</td>
                        <td class="mr-2">
                            <a href="">LPJ.pdf</a>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>

<div class="col-sm-12 mt-3 col-md-12 col-lg-12 tab-tab-lampiran-pengajuan-umum-pc">
    {{-- judul --}}
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <b>B. LAMPIRAN LPJ</b>
        </div>
        <button class="btn btn-outline-success btn-sm tombol-tambah" data-toggle="modal"
                wire:click="modal_lampiran_pyl_tambah" data-target="#modal_lampiran_pyl_tambah"
                type="button"><i class="fas fa-plus-circle"></i>
                Tambah</button>
    </div>

    {{-- alert --}}
    @if (session()->has('alert_la'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <i class="far fa-check-circle"></i> {{ session('alert_la') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    {{-- end alert --}}

    {{-- tabel --}}
    {{-- tabel dokumentasi --}}
    <table class="table table-bordered mt-2 mb-2" style="width:100%">
        <thead>
            <tr class="text-center">
                <th style="width: 5%;">No</th>
                <th style="width: 40%">Judul</th>
                <th>File</th>
                <th>Waktu Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            @forelse($lampiran_pyl as $a)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $a->keterangan }} <br>
                    </td>
                    <td>
                        <a href="{{ asset('uploads/pyl_lampiran/' . $a->url) }}" target="_blank">
                            {{ $a->url }}
                        </a>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($a->created_at)->format('d/m/Y H:i:s') }}
                    </td>
                    <td>
                        <!-- tombol aksi -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Kelola</button>
                            <button type="button"
                                class="btn btn-success dropdown-toggle dropdown-toggle-split btn-sm"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle
                                    Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='black'"
                                    class="dropdown-item"
                                    wire:click="modal_lampiran_pyl_ubah('{{ $a->lampiran_id }}','{{ $a->url }}')"
                                    type="button" data-toggle="modal" data-target="#modal_lampiran_pyl_ubah"><i
                                        class="fas fa-edit"></i>
                                    Ubah</a>
                                <a onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'"
                                    class="dropdown-item"
                                    wire:click="modal_lampiran_pyl_hapus('{{ $a->lampiran_id }}','{{ $a->url }}')"
                                    data-toggle="modal" data-target="#modal_lampiran_pyl_hapus"
                                    type="button"><i class="fas fa-trash"></i>
                                    Hapus</a>
                                <a href="#"
                                {{-- <a href="/unduh-lampiran/{{ $a->lampiran_id }}" --}}
                                    onMouseOver="this.style.color='green'" onMouseOut="this.style.color='black'"
                                    class="dropdown-item" type="button">
                                    <i class="fa fa-download"></i> Cetak
                                </a>

                            </div>
                        </div>
                        {{-- end tombol aksi --}}
                    </td>


                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center"> Belum ada data</td>
                </tr>
            @endforelse


        </tbody>
    </table>
    {{-- end tabel --}}
</div>
