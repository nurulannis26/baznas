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
            Survey dilakukan oleh staff yang ditugaskan melalui survey. Lampirkan dokumentasi surveynya.
        </span>
    </div>
</div>

<div class="tab-persetujuan-atasan">

    <div class="card card-body mt-3 mr-2 ml-2" style="display: {{ $none_block_acc_pencairan }};">
        <div class="d-flex justify-content-between align-items-center">
            <b class="text-success">INPUT HASIL PENCAIRAN KEUANGAN</b>
            <a wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>

        {{-- form --}}
        <form wire:submit.prevent="acc_pencairan">
            <div class="form-row mt-4">

                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Tgl
                                Tgl Dicairkan</span>
                        </div>
                        <input wire:model="pencairan_timestamp" type="date" class="form-control">
                    </div>
                </div>

                {{-- Direktur --}}
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Tgl
                                Yang Mencairkan</span>
                        </div>
                        <input type="input" class="form-control" value="{{ Auth::user()->nama }}" readonly>
                    </div>
                </div>
                {{-- end direktur --}}

                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Nominal</span>
                        </div>
                        <input wire:model="pencairan_nominal" type="input" class="form-control " id="pencairan_nominal"
                            placeholder="Masukan Nominal">

                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Sumber
                                Dana</span>
                        </div>
                        <select class="form-control" name="pencairan_sumberdana" wire:model="pencairan_sumberdana">
                            <option value="" selected>Pilih Sumber Dana</option>

                        </select>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Catatan</span>
                        </div>
                        <input wire:model="pencairan_catatan" type="input" class="form-control "
                            id="pencairan_catatan" placeholder="Masukan Catatan">

                    </div>
                </div>


                {{-- info --}}
                <div class="form-group col-md-12">
                    <div class="card card-body " style="background-color:#e0e0e0;">
                        <b>INFORMASI!</b>
                        <span>
                            Dengan klik tombol Simpan, pencairan permohonan telah berhasil dilakukan.
                        </span>
                    </div>
                </div>
                {{-- end info --}}

                <div class="form-group col-md-9">
                </div>

                {{-- tombol acc --}}
                <div class="form-group col-md-3">
                    {{-- @if ($survey_nominal == '')
                        <button class="btn btn-success btn-block" disabled wire:loading.attr="disabled"><i
                                class="fas fa-check-circle"></i>
                            Simpan</button>
                    @else --}}
                        <button type="submit" name="submit" class="btn btn-success btn-block"
                            wire:loading.attr="disabled"><i class="fas fa-check-circle"></i>
                            Simpan</button>
                    {{-- @endif --}}
                </div>
                {{-- acc --}}

            </div>
        </form>

    </div>

    <div class="card card-body mt-3 mr-2 ml-2" style="display: {{ $none_block_tolak_pencairan }};">
        <div class="d-flex justify-content-between align-items-center">
            <b class="text-danger">RESPON TOLAK PENCAIRAN</b>
            <a wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>

        <form wire:submit.prevent="tolak_pencairan">

            <div class="form-row mt-4">

                {{-- Direktur --}}
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Tgl
                                Yang Mencairkan</span>
                        </div>
                        <input type="input" class="form-control" value="{{ Auth::user()->nama }}" readonly>
                    </div>
                </div>
                {{-- end rekening --}}

                {{-- tgl penolakan --}}
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tgl Penolakan</span>
                        </div>
                        <input wire:model="denial_date_pencairan" type="date" class="form-control">
                    </div>
                </div>
                {{-- end tgl penolakan --}}


                {{-- denial note --}}
                <div class="form-group col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Alasan</span>
                        </div>
                        <input wire:model="denial_note_pencairan" type="input" class="form-control"
                            placeholder="Masukan Alasan Penolakan">
                    </div>
                </div>
                {{-- end denial note --}}


                {{-- info --}}
                <div class="form-group col-md-12">
                    <div class="card card-body " style="background-color:#e0e0e0;">
                        <b>INFORMASI!</b>
                        <span>
                            Dengan klik tombol tolak, Atasan memberikan penolakan untuk permohonan ini.
                        </span>
                    </div>
                </div>
                {{-- end info --}}

                <div class="form-group col-md-9">
                </div>

                {{-- tombol tolak --}}
                <div class="form-group col-md-3">
                    @if ($denial_note_pencairan == '')
                        <button class="btn btn-danger btn-block" disabled wire:loading.attr="disabled"><i
                                class="fas fa-minus-circle"></i>
                            Tolak</button>
                    @else
                        <button type="submit" name="submit" class="btn btn-danger btn-block"
                            wire:loading.attr="disabled"><i class="fas fa-minus-circle"></i>
                            Tolak</button>
                    @endif
                </div>
                {{-- tolak --}}


            </div>
        </form>
    </div>


</div>

<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6  tab-persetujuan_direktur-detail-umum-pc">

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="ml-1">
                <b> A. HASIL PENCAIRAN </b>
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
                        <a wire:click="tombol_acc_pencairan" onMouseOver="this.style.color='green'"
                            onMouseOut="this.style.color='black'" class="dropdown-item" data-toggle="modal"
                            data-target="#modal_acc" type="button"><i class="fas fa-user-check"></i>
                            ACC
                        </a>
                        <a wire:click="tombol_tolak_pencairan" onMouseOver="this.style.color='red'"
                            onMouseOut="this.style.color='black'" class="dropdown-item" data-toggle="modal"
                            data-target="#modal_tolak" type="button"><i class="fas fa-ban"></i>
                            Tolak</a>
                    </div>
                </div>
            @endif
        </div>
        {{-- end judul --}}


        @if (session()->has('alert_pencairan'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <i class="far fa-check-circle"></i> {{ session('alert_pencairan') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        {{-- tabel --}}
        <div class="col-12 mt-2">
            <table class="table  table-bordered">
                @php
                    $namaPengguna = \App\Models\Pengguna::pengguna($dp->pencairan_petugas_keuangan);
                    $jabatan = \App\Models\Pengguna::jabatan($dp->pencairan_petugas_keuangan);

                    if ($dp->pencairan_status == 'Berhasil Dicairkan') {
                        $bg_pencairan = 'badge-success';
                        $ket_pencairan = 'Sudah Dicairkan';
                    } elseif ($dp->pencairan_status == 'Ditolak') {
                        $bg_pencairan = 'badge-danger';
                        $ket_pencairan = 'Ditolak';
                    } else {
                        $bg_pencairan = 'badge-warning';
                        $ket_pencairan = 'Blm Dicairkan';
                    }
                @endphp
                <thead>
                    {{-- disetujui oleh --}}
                    <tr>
                        @if ($dp->pencairan_status != 'Ditolak')
                            <td class="text-bold" style="width: 30%;vertical-align: middle;">
                                Direspon Oleh
                            </td>
                            <td style="vertical-align: middle;">
                                @if ($dp->pencairan_petugas_keuangan == null)
                                    -
                                @else
                                    <b style="font-size: 12pt;">{{ $namaPengguna }}</b>
                                    <br>
                                    <span style="font-size:11pt;">{{ $jabatan }}</span>
                                @endif
                            </td>
                        @elseif($dp->pencairan_status == 'Ditolak')
                            <td class="text-bold" style="width: 30%;vertical-align: middle;">
                                Ditolak Oleh
                            </td>
                            <td style="vertical-align: middle;">
                                @if ($dp->pencairan_petugas_keuangan == null)
                                    -
                                @else
                                    {{ $namaPengguna }}
                                    <br>
                                    <span style="font-size:11pt;">{{ $jabatan }}/span>
                                @endif
                            </td>
                        @endif
                    </tr>
                    {{-- end petugas pentasyaruan --}}
                    @if ($dp->pencairan_status != 'Ditolak')
                        <tr>
                            <td class="text-bold " style="width: 30%">
                                Status & Tgl Disetujui</td>
                            <td class="mr-2">
                                <span class="text-light badge {{ $bg_pencairan }}">{{ $ket_pencairan }}
                                </span>
                                <br>
                                {{ Carbon\Carbon::parse($dp->pencairan_timestamp)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                <br>
                                <b style="font-size: 12pt;">Catatan Pencairan</b> <br>
                                <span>
                                    {{ $dp->pencairan_catatan ?? '-' }}
                                </span>
                            </td>
                            
                        </tr>
                        <tr>
                            <td class="text-bold " style="width: 30%">
                                Nominal Pencairan</td>
                            <td style="width: 30%">
                                @if($dp->pencairan_nominal)
                                {{ number_format($dp->pencairan_nominal), 0, '.', '.'  }}
                                @else - @endif</td>
                        </tr>
                        
                    @elseif($dp->pencairan_status == 'Ditolak')
                        <tr>
                            <td class="text-bold " style="width: 30%">
                                Status & Tgl Ditolak</td>
                            <td class="mr-2">
                                <span class="text-light badge {{ $bg_pencairan }}">{{ $ket_pencairan }}
                                </span>
                                <br>
                                {{ Carbon\Carbon::parse($dp->denial_date_pencairan)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                <br>
                                <b style="font-size: 12pt;">Alasan Penolakan</b> <br>
                                <span>
                                    {{ $dp->denial_note_pencairan }}
                                </span>
                            </td>
                        </tr>
                    @endif




                </thead>
            </table>
        </div>

    </div>
</div>

<div class="col-sm-12 mt-3 col-md-12 col-lg-12 tab-tab-lampiran-pengajuan-umum-pc">
    {{-- judul --}}
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <b>B. LAMPIRAN PENCAIRAN</b>
        </div>
        <button class="btn btn-outline-success btn-sm tombol-tambah" data-toggle="modal"
            wire:click="modal_lampiran_pencairan_tambah" data-target="#modal_lampiran_pencairan_tambah" type="button"><i
                class="fas fa-plus-circle"></i>
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

            @forelse($lampiran_pencairan as $a)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $a->keterangan }} <br>
                    </td>
                    <td>
                        <a href="{{ asset('uploads/lampiran_pencairan/' . $a->url) }}" target="_blank">
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
                                    wire:click="modal_lampiran_pencairan_ubah('{{ $a->lampiran_id }}','{{ $a->url }}')"
                                    type="button" data-toggle="modal" data-target="#modal_lampiran_pencairan_ubah"><i
                                        class="fas fa-edit"></i>
                                    Ubah</a>
                                <a onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'"
                                    class="dropdown-item"
                                    wire:click="modal_lampiran_pencairan_hapus('{{ $a->lampiran_id }}','{{ $a->url }}')"
                                    data-toggle="modal" data-target="#modal_lampiran_pencairan_hapus" type="button"><i
                                        class="fas fa-trash"></i>
                                    Hapus</a>
                                {{-- <a href="#" <a href="/unduh-lampiran/{{ $a->lampiran_id }}" onMouseOver="this.style.color='green'"
                                    onMouseOut="this.style.color='black'" class="dropdown-item" type="button">
                                    <i class="fa fa-download"></i> Cetak
                                </a> --}}

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

    @include('modal.modal_lampiran_pencairan_tambah')
    @include('modal.modal_lampiran_pencairan_ubah')
    @include('modal.modal_lampiran_pencairan_hapus')

    <script>
        $(document).ready(function() {

            window.loadContactDeviceSelect2 = () => {
                bsCustomFileInput.init();
                $('#pencairan_nominal').on('input', function(e) {
                    $('#pencairan_nominal').val(formatRupiah($('#pencairan_nominal').val(),
                        'Rp. '));
                });
            }

            loadContactDeviceSelect2();
            window.livewire.on('loadContactDeviceSelect2', () => {
                loadContactDeviceSelect2();
            });

        });
    </script>
</div>
