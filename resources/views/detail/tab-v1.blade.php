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
            Data permohonan, penerima manfaat & lampiran diinput oleh Front Office.
        </span>
    </div>
</div>



<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6  tab-tab-detail-pengajuan-umum-pc">
        {{-- end diinput oleh --}}
        {{-- judul --}}
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="col-lg-12 col-md-6 col-sm-12">
                <b class="ml-2">A. DETAIL
                    PERMOHONAN</b>
            </div>
        </div>

        @if (session()->has('alert_permohonan'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <i class="far fa-check-circle"></i> {{ session('alert_permohonan') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="col-12 mt-2">
            <table class="table  table-bordered">
                <thead>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Nomor Permohonan</td>
                        <td>{{ $dp->permohonan_nomor }}
                        </td>
                    </tr>

                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Tgl Permohonan</td>
                        <td>{{ Carbon\Carbon::parse($dp->permohonan_tgl)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        </td>
                    </tr>

                    @php
                        if ($dp->permohonan_jenis == 'Individu') {
                            $bg_jenis = 'badge-success';
                            $nama = $dp->permohonan_nama_pemohon;
                            $nohp = $dp->permohonan_nohp_pemohon;
                            $alamat = $dp->permohonan_alamat_pemohon;
                        } else {
                            $bg_jenis = 'badge-warning';
                            $nama = \App\Models\Permohonan::getNamaUPZ($dp->permohonan_upz_id);
                            $nohp = \App\Models\Permohonan::getNoHP($dp->permohonan_upz_id);
                            $alamat = \App\Models\Permohonan::getAlamat($dp->permohonan_upz_id);
                        }
                    @endphp

                    <tr>
                        <td class="text-bold" style="width: 35%;vertical-align: middle;">
                            Data Pemohon
                        </td>
                        <td style="vertical-align: middle;">
                            <sup class="text-light badge {{ $bg_jenis }}">{{ $dp->permohonan_jenis }} </sup> <br>
                            <span class="font-weight-bold" style="font-size: 12pt;"> {{ $nama }}</span> <br>
                            <span style="font-size:11pt;">No HP &nbsp;&nbsp;&nbsp;:
                                {{ $nohp }}</span><br>
                            <span style="font-size:11pt;">Alamat&nbsp; :
                                {{ $alamat }}</span>
                        </td>

                    </tr>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Nominal</td>
                        <td>Rp{{ number_format((float) $dp->permohonan_nominal, 0, '.', '.') }}
                        </td>
                    </tr>
                    @php
                        if ($dp->permohonan_bentuk_bantuan == 'Uang Tunai') {
                            $bg_bentuk = 'badge-success';
                        } else {
                            $bg_bentuk = 'badge-primary';
                        }
                    @endphp
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Bentuk</td>
                        <td><sup class="text-light badge {{ $bg_bentuk }}">{{ $dp->permohonan_bentuk_bantuan }}
                            </sup> <br>
                        </td>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Asnaf</td>
                        <td>{{ \App\Models\Permohonan::getAsnaf($dp->asnaf_id) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Program & Sub Program</td>
                        <td>
                            <span class="font-weight-bold">
                                {{ \App\Models\Permohonan::getProgram($dp->program_id) }}</span><br>
                            <span class="">
                                {{ \App\Models\Permohonan::getSubProgram($dp->program_id) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Keterangan</td>
                        <td>{{ $dp->permohonan_catatan_input }}
                        </td>
                    <tr>
                </thead>
            </table>
        </div>

    </div>

    <div class="col-sm-6 col-md-6 col-lg-6  tab-tab-detail-pengajuan-umum-pc">

        <div class="d-flex align-items-center justify-content-end mb-2 mt-3 text-right" style="flex-grow: 1;">
            <button wire:click="modal_permohonan_hapus('{{ $permohonan_id }}')" style="cursor: pointer"
                class="btn btn-outline-secondary btn-sm mr-1" data-toggle="modal" data-target="#modal_pc_hapus"
                type="button">
                <i class="fas fa-trash"></i> Hapus
            </button>

            <button wire:click="modal_permohonan_ubah('{{ $permohonan_id }}')" style="cursor: pointer"
                class="btn btn-outline-secondary btn-sm mr-1" data-toggle="modal"
                data-target="#modal_permohonan_ubah" type="button">
                <i class="fas fa-edit"></i> Ubah
            </button>

            <button class="btn btn-outline-secondary btn-sm dropdown-toggle hover" type="button" id="dropdownMenu2"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Selesai input
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" wire:click="selesai_input('{{ $dp->permohonan_id }}')">
                    <i class="fas fa-check"></i> Selesai input
                </button>
                <button class="dropdown-item" wire:click="batal_input('{{ $dp->permohonan_id }}')">
                    <i class="fas fa-ban"></i> Belum selesai input
                </button>
            </div>
        </div>


        {{-- end judul --}}
        {{-- tabel lanjutan --}}
        <div class="col-12">
            <table class="table  table-bordered" wire:ignore>
                <thead>

                    <tr>
                        <td class="text-bold">Surat Permohonan
                        </td>
                        <td>
                            <a href="{{ asset('public/' . $dp->file_surat_permohonan) }}" target="_blank">
                                <i class="fas fa-file-pdf"></i> Permohonan
                                Bantuan.pdf
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Nomor Surat</td>
                        <td>
                            {{ $dp->surat_nomor }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Tgl Surat</td>
                        <td>{{ Carbon\Carbon::parse($dp->surat_tgl)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Tgl Input</td>
                        <td>{{ Carbon\Carbon::parse($dp->permohonan_timestamp_input)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
        {{-- end tabel --}}
    </div>
</div>

<div class="col-sm-12 mt-3 col-md-12 col-lg-12 tab-tab-lampiran-pengajuan-umum-pc">
    {{-- judul --}}
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <b>B. DAFTAR MUSTAHIK</b>
        </div>
        <button class="btn btn-outline-success btn-sm tombol-tambah" data-toggle="modal"
            wire:click="modal_mustahik_tambah" data-target="#modal_mustahik_tambah" type="button"><i
                class="fas fa-plus-circle"></i>
            Tambah</button>
    </div>

    {{-- alert --}}
    @if (session()->has('alert_mustahik'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <i class="far fa-check-circle"></i> {{ session('alert_mustahik') }}
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
                <th style="width: 15%;">Nama</th>
                <th style="width: 15%;">Nomor Identitas</th>
                <th style="width: 15%;">Tempat, Tgl Lahir</th>
                <th style="width: 15%;">Alamat</th>
                <th style="width: 15%;">Kontak</th>
                <th style="width: 10%;">Asnaf</th>
                <th style="width: 10%;">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @forelse($daftar_mustahik as $a)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $a->nama }}
                    </td>
                    <td>
                        <span>NIK&nbsp;&nbsp;: {{ $a->nik }}</span><br>
                        <span>KK&nbsp;&nbsp;&nbsp;: {{ $a->kk }}</span>
                    </td>
                    <td>
                        <span>{{ $a->tempat_lahir }}</span><br>
                        <span> {{ Carbon\Carbon::parse($a->tgl_lahir)->isoFormat('D MMMM YYYY') }}</span>
                    </td>
                    <td>
                        {{ $a->alamat }}
                    </td>
                    <td>
                        <span>No HP&nbsp;&nbsp;: {{ $a->nohp }}</span><br>
                        <span>Email&nbsp;&nbsp;: {{ $a->email }}</span>
                    </td>
                    <td>
                        {{ \App\Models\Permohonan::getAsnaf($a->asnaf_id) }}
                    </td>
                    <td>
                        <!-- tombol aksi -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Aksi</button>
                            <button type="button"
                                class="btn btn-success dropdown-toggle dropdown-toggle-split btn-sm"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle
                                    Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <a onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='black'"
                                    class="dropdown-item tombol-ubah tombol-tambah"
                                    wire:click="modal_mustahik_ubah('{{ $a->mustahik_id }}')" type="button"
                                    data-toggle="modal" data-target="#modal_mustahik_ubah"><i
                                        class="fas fa-edit"></i>
                                    Ubah</a>
                                <a onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'"
                                    class="dropdown-item" wire:click="modal_mustahik_hapus('{{ $a->mustahik_id }}')"
                                    data-toggle="modal" data-target="#modal_mustahik_hapus" type="button"><i
                                        class="fas fa-trash"></i>
                                    Hapus</a>

                            </div>
                        </div>
                        {{-- end tombol aksi --}}
                    </td>


                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center"> Belum ada data</td>
                </tr>
            @endforelse


        </tbody>
    </table>
    {{-- end tabel --}}
</div>

<div class="col-sm-12 mt-3 col-md-12 col-lg-12 tab-tab-lampiran-pengajuan-umum-pc">
    {{-- judul --}}
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <b>C. LAMPIRAN PERMOHONAN</b>
        </div>
        <button class="btn btn-outline-success btn-sm tombol-tambah" data-toggle="modal"
            wire:click="modal_lampiran_pengajuan_tambah" data-target="#modal_lampiran_pengajuan_tambah"
            type="button"><i class="fas fa-plus-circle"></i>
            Tambah</button>
    </div>

    {{-- alert --}}
    @if (session()->has('alert_lampiran'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            <i class="far fa-check-circle"></i> {{ session('alert_lampiran') }}
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

            @forelse($lampiran_pengajuan as $a)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $a->keterangan }} <br>
                    </td>
                    <td>
                        <a href="{{ asset('uploads/pengajuan_lampiran/' . $a->url) }}" target="_blank">
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
                                    class="dropdown-item tombol-ubah tombol-tambah"
                                    wire:click="modal_lampiran_pengajuan_ubah('{{ $a->lampiran_id }}','{{ $a->url }}')"
                                    type="button" data-toggle="modal"
                                    data-target="#modal_lampiran_pengajuan_ubah"><i class="fas fa-edit"></i>
                                    Detail</a>
                                <a onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'"
                                    class="dropdown-item"
                                    wire:click="modal_lampiran_pengajuan_hapus('{{ $a->lampiran_id }}','{{ $a->url }}')"
                                    data-toggle="modal" data-target="#modal_lampiran_pengajuan_hapus"
                                    type="button"><i class="fas fa-trash"></i>
                                    Hapus</a>
                                <a href="#" {{-- <a href="/unduh-lampiran/{{ $a->lampiran_id }}" --}} onMouseOver="this.style.color='green'"
                                    onMouseOut="this.style.color='black'" class="dropdown-item" type="button">
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
    
    @include('modal.modal_permohonan_ubah')
</div>
