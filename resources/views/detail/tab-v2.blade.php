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

            @if ($dp->survey_pilihan == 'Perlu')
                <sup class="text-light badge badge-succes">Perlu Survey</sup>
                @if ($dp->survey_status == 'Selesai')
                    <sup class="text-light badge badge-success">Survey Disetujui</sup>
                @else
                    <sup class="text-light badge badge-warning">Survey Blm Selesai</sup>
                @endif
            @else
                <sup class="text-light badge badge-secondary">Tidak Perlu Survey</sup>
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

        @if ($dp->pencairan_status == 'Berhasil Dicairkan')
            @if ($dp->pyl_status == 'Selesai')
                <sup class="text-light badge badge-success">Penyaluran Disetujui</sup>
            @else
                <sup class="text-light badge badge-warning">Penyaluran Blm Selesai</sup>
            @endif
        @endif

        <br>
        <span>
            <i class="fas fa-info-circle"></i>
            Pengecekan dan persetujuan permohonan oleh Atasan.
        </span>
    </div>
</div>

<div class="tab-persetujuan-atasan">

    <div class="card card-body mt-3 mr-2 ml-2" style="display: {{ $none_block_acc_atasan }};">
        <div class="d-flex justify-content-between align-items-center">
            <b class="text-success">RESPON ACC ATASAN</b>
            <a wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>

        {{-- form --}}
        <form wire:submit.prevent="acc_atasan">
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
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Tgl
                                Tgl Disetujui</span>
                        </div>
                        <input wire:model="permohonan_timestamp_atasan" type="date" class="form-control">
                    </div>
                </div>
                {{-- end tgl disetujui --}}

                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Survey</span>
                        </div>
                        <select class="form-control" name="survey_pilihan" wire:model="survey_pilihan">
                            <option value="" selected>Pilih Survey</option>
                            <option value="Tidak Perlu">Tidak Perlu</option>
                            <option value="Perlu">Perlu</option>

                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Survey</span>
                        </div>
                        <select class="form-control" name="survey_petugas_survey" wire:model="survey_pilihan" @if($survey_pilihan == 'Tidak Perlu') disabled @endif>
                            <option value="" selected>Pilih Petugas</option>
                            @foreach ($petugas_survey as $petugas)
                                <option value="{{ $petugas->pengurus_id }}">{{ $petugas->nama }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Catatan</span>
                        </div>
                        <input wire:model="permohonan_catatan_atasan" type="input" class="form-control "
                            id="permohonan_catatan_atasan" placeholder="Masukan Keterangan ACC">

                    </div>
                </div>


                {{-- info --}}
                <div class="form-group col-md-12">
                    <div class="card card-body " style="background-color:#e0e0e0;">
                        <b>INFORMASI!</b>
                        <span>
                            Dengan klik tombol ACC, Atasan memberikan persetujuan untuk permohonan ini.
                        </span>
                    </div>
                </div>
                {{-- end info --}}

                <div class="form-group col-md-9">
                </div>

                {{-- tombol acc --}}
                <div class="form-group col-md-3">
                    @if ($survey_pilihan == '')
                        <button class="btn btn-success btn-block" disabled wire:loading.attr="disabled"><i
                                class="fas fa-check-circle"></i>
                            ACC</button>
                    @else
                        <button type="submit" name="submit" class="btn btn-success btn-block"
                            wire:loading.attr="disabled"><i class="fas fa-check-circle"></i>
                            ACC</button>
                    @endif
                </div>
                {{-- acc --}}

            </div>
        </form>

    </div>
    {{-- end card acc --}}

    {{-- card tolak --}}
    <div class="card card-body mt-3 mr-2 ml-2" style="display: {{ $none_block_tolak_atasan }};">
        <div class="d-flex justify-content-between align-items-center">
            <b class="text-danger">RESPON TOLAK ATASAN</b>
            <a wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>

        <form wire:submit.prevent="tolak_atasan">

            <div class="form-row mt-4">

                {{-- Direktur --}}
                <div class="form-group col-md-6">
                    <input type="input" class="form-control"
                        value="{{ Auth::user()->pengurus->jabatan->jabatan }} - {{ Auth::user()->nama }}" readonly>
                </div>
                {{-- end rekening --}}

                {{-- tgl penolakan --}}
                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Tgl Penolakan</span>
                        </div>
                        <input wire:model="denial_date_atasan" type="date" class="form-control">
                    </div>
                </div>
                {{-- end tgl penolakan --}}


                {{-- denial note --}}
                <div class="form-group col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Alasan</span>
                        </div>
                        <input wire:model="denial_note_atasan" type="input" class="form-control"
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
                    @if ($denial_note_atasan == '')
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
    {{-- end card tolak --}}
    {{-- @endif --}}


</div>

<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6  tab-persetujuan_direktur-detail-umum-pc">

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="ml-1">
                <b> A. RESPON ATASAN </b>
            </div>
            @if (Auth::user()->pengurus_id != null and Auth::user()->pengurus->jabatan->divisi->divisi = '0e883f67-9130-43cf-ac95-54395388538b
            ')
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
                        <a wire:click="tombol_acc_atasan" onMouseOver="this.style.color='green'"
                            onMouseOut="this.style.color='black'" class="dropdown-item" data-toggle="modal"
                            data-target="#modal_acc" type="button"><i class="fas fa-user-check"></i>
                            ACC
                        </a>
                        <a wire:click="tombol_tolak_atasan" onMouseOver="this.style.color='red'"
                            onMouseOut="this.style.color='black'" class="dropdown-item" data-toggle="modal"
                            data-target="#modal_tolak" type="button"><i class="fas fa-ban"></i>
                            Tolak</a>
                    </div>
                </div>
            @endif
        </div>
        {{-- end judul --}}


        @if (session()->has('alert_atasan'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <i class="far fa-check-circle"></i> {{ session('alert_atasan') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        {{-- tabel --}}
        <div class="col-12 mt-2">
            <table class="table  table-bordered">
                @php
                    $namaPengguna = \App\Models\Pengguna::pengguna($dp->permohonan_petugas_atasan);
                    $petugasSurvey = \App\Models\Pengguna::pengguna($dp->survey_petugas_survey);
                    $petugasPenyaluran = \App\Models\Pengguna::pengguna($dp->survey_petugas_pyl);
                    $jabatanPenyaluran = \App\Models\Pengguna::jabatan($dp->survey_petugas_pyl);
                    $jabatanSurvey = \App\Models\Pengguna::jabatan($dp->survey_petugas_survey);
                    $jabatan = \App\Models\Pengguna::jabatan($dp->permohonan_petugas_atasan);

                    if ($dp->permohonan_status_atasan == 'Diterima') {
                        $bg_atasan = 'badge-success';
                        $ket_atasan = 'Sudah Disetujui Atasan';
                    } elseif ($dp->permohonan_status_atasan == 'Ditolak') {
                        $bg_atasan = 'badge-danger';
                        $ket_atasan = 'Ditolak Atasan';
                    } else {
                        $bg_atasan = 'badge-warning';
                        $ket_atasan = 'Blm Direspon Atasan';
                    }

                    if ($dp->survey_pilihan == 'Perlu') {
                        $bg_survey = 'badge-success';
                        $ket_survey = 'Perlu Survey';
                    } else {
                        $bg_survey = 'badge-warning';
                        $ket_survey = 'Tidak Perlu';
                    }

                    if ($dp->survey_pilihan == 'Perlu') {
                        $bg_pyl = 'badge-success';
                        $ket_pyl = 'Perlu Survey';
                    } else {
                        $bg_pyl = 'badge-warning';
                        $ket_pyl = 'Tidak Perlu';
                    }
                @endphp
                <thead>
                    {{-- disetujui oleh --}}
                    <tr>
                        @if ($dp->permohonan_status_atasan != 'Ditolak')
                            <td class="text-bold" style="width: 30%;vertical-align: middle;">
                                Direspon Oleh
                            </td>
                            <td style="vertical-align: middle;">
                                @if ($dp->permohonan_petugas_atasan == null)
                                    -
                                @else
                                    <b
                                        style="font-size: 12pt;">{{ $namaPengguna }}</b>
                                    <br>
                                    <span
                                        style="font-size:11pt;">{{ $jabatan }}</span>
                                @endif
                            </td>
                        @elseif($dp->permohonan_status_atasan == 'Ditolak')
                            <td class="text-bold" style="width: 30%;vertical-align: middle;">
                                Ditolak Oleh
                            </td>
                            <td style="vertical-align: middle;">
                                @if ($dp->permohonan_petugas_atasan == null)
                                    -
                                @else
                                {{ $namaPengguna }}
                                    <br>
                                    <span
                                        style="font-size:11pt;">{{ $jabatan }}/span>
                                @endif
                            </td>
                        @endif
                    </tr>
                    {{-- end petugas pentasyaruan --}}
                    @if ($dp->permohonan_status_atasan != 'Ditolak')
                        <tr>
                            <td class="text-bold " style="width: 30%">
                                Status & Tgl Disetujui</td>
                            <td class="mr-2">
                                    <span class="text-light badge {{ $bg_atasan }}">{{ $ket_atasan }}
                                    </span>
                                <br>
                                {{ Carbon\Carbon::parse($dp->permohonan_timestamp_atasan)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                <br>
                                <b style="font-size: 12pt;">Catatan Atasan</b> <br>
                                <span>
                                    {{ $dp->permohonan_catatan_atasan ?? '-' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b style="font-size: 12pt;">Survey</b>
                            </td>
                            <td>
                                    <span class="text-light badge {{ $bg_survey }}">{{ $ket_survey }}</span>
                                <br>
                                Petugas Survey:
                                <b style="font-size: 12pt;">
                                    {{ $petugasSurvey ?? '-'}}
                                </b>
                                <br>
                                <span style="font-size: 11pt;">
                                    {{ $jabatanSurvey ?? '-'}}
                                </span>
    
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b style="font-size: 12pt;">Penyaluran</b>
                            </td>
                            <td>
                                    <span class="text-light badge {{ $bg_pyl }}">{{ $ket_pyl }}</span>
                                <br>
                                Petugas Penyaluran:
                                <b style="font-size: 12pt;">
                                    {{ $petugasPenyaluran ?? '-' }}
                                </b>
                                <br>
                                <span style="font-size: 11pt;">
                                    {{ $jabatanPenyaluran ?? '-'}}
                                </span>
    
                            </td>
                        </tr>
                    @elseif($dp->permohonan_status_atasan == 'Ditolak')
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Status & Tgl Ditolak</td>
                        <td class="mr-2">
                                <span class="text-light badge {{ $bg_atasan }}">{{ $ket_atasan }}
                                </span>
                            <br>
                            {{ Carbon\Carbon::parse($dp->denial_date_atasan)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                            <br>
                            <b style="font-size: 12pt;">Catatan Atasan</b> <br>
                            <span>
                                {{ $dp->denial_note_atasan }}
                            </span>
                        </td>
                    </tr>
                    @endif
                    



                </thead>
            </table>
        </div>

    </div>
</div>
