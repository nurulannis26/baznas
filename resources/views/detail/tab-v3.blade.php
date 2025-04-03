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

    <div class="card card-body mt-3 mr-2 ml-2" style="display: {{ $none_block_survey }};">
        <div class="d-flex justify-content-between align-items-center">
            <b class="text-success">INPUT HASIL SURVEY</b>
            <a wire:click="close" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
        </div>

        {{-- form --}}
        <form wire:submit.prevent="survey">
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
                                Tgl Disetujui</span>
                        </div>
                        <input wire:model="survey_tgl" type="date" class="form-control">
                    </div>
                </div>
                {{-- end tgl disetujui --}}

                <div class="form-group col-md-6">
                    <div class="input-group">
                        <input type="file" wire:model="survey_form_url"
                            accept="application/pdf, image/png, image/jpg, image/jpeg" class="custom-file-input"
                            id="file" name="file">
                        <label class="custom-file-label" for="customFile">Masukan scan form survey</label>

                    </div>
                </div>

                <div class="form-group col-md-6">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Hasil</span>
                        </div>
                        <input wire:model="survey_hasil" type="input" class="form-control " id="survey_hasil"
                            placeholder="Masukan Hasil Survey">

                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                style="width: 200px; display: flex; justify-content: center; align-items: center;">Catatan</span>
                        </div>
                        <input wire:model="survey_catatan" type="input" class="form-control " id="survey_catatan"
                            placeholder="Masukan Catatan">

                    </div>
                </div>


                {{-- info --}}
                <div class="form-group col-md-12">
                    <div class="card card-body " style="background-color:#e0e0e0;">
                        <b>INFORMASI!</b>
                        <span>
                            Dengan klik tombol Simpan, survey dinyatakan selesai. Lampirkan dokumentasi survey.
                        </span>
                    </div>
                </div>
                {{-- end info --}}

                <div class="form-group col-md-9">
                </div>

                {{-- tombol acc --}}
                <div class="form-group col-md-3">
                    @if ($survey_hasil == '')
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
                <b> A. HASIL SURVEY </b>
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
                        <a wire:click="tombol_survey" onMouseOver="this.style.color='green'"
                            onMouseOut="this.style.color='black'" class="dropdown-item" data-toggle="modal"
                            data-target="#modal_acc" type="button"><i class="fas fa-user-check"></i>
                            ACC
                        </a>
                    </div>
                </div>
            @endif
        </div>
        {{-- end judul --}}


        @if (session()->has('alert_survey'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <i class="far fa-check-circle"></i> {{ session('alert_survey') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        {{-- tabel --}}
        <div class="col-12 mt-2">
            <table class="table  table-bordered">
                @php
                    $petugasSurvey = \App\Models\Pengguna::pengguna($dp->survey_petugas_survey);
                    $jabatanSurvey = \App\Models\Pengguna::jabatan($dp->survey_petugas_survey);

                    if ($dp->survey_status == 'Selesai') {
                        $bg_survey = 'badge-success';
                        $ket_survey = 'Survey Disetujui';
                    } else {
                        $bg_survey = 'badge-warning';
                        $ket_survey = 'Survey Blm Selesai';
                    }
                @endphp
                <thead>
                    {{-- disetujui oleh --}}
                    <tr>
                        <td class="text-bold" style="width: 30%;vertical-align: middle;">
                            Direspon Oleh
                        </td>
                        <td style="vertical-align: middle;">
                            @if ($dp->survey_petugas_survey == null)
                                -
                            @else
                                <b style="font-size: 12pt;">{{ $petugasSurvey }}</b>
                                <br>
                                <span style="font-size:11pt;">{{ $jabatanSurvey }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Hasil Survey</td>
                        <td class="mr-2">
                            <span class="text-light badge {{ $bg_survey }}">{{ $ket_survey }}
                            </span>
                            <br>
                            {{ Carbon\Carbon::parse($dp->survey_timestamp)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                            <br>
                            <b style="font-size: 12pt;">Catatan Tambahan</b> <br>
                            <span>
                                {{ $dp->survey_hasil ?? '-' }}<br>
                            </span>
                            <span>
                                {{ $dp->survey_catatan ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold " style="width: 30%">
                            Scan Form Survey</td>
                        <td class="mr-2">
                            <a href="">Form.pdf</a>
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
            <b>B. LAMPIRAN SURVEY</b>
        </div>
        <button class="btn btn-outline-success btn-sm tombol-tambah" data-toggle="modal"
                wire:click="modal_lampiran_survey_tambah" data-target="#modal_lampiran_survey_tambah"
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

            @forelse($lampiran_survey as $a)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $a->keterangan }} <br>
                    </td>
                    <td>
                        <a href="{{ asset('uploads/survey_lampiran/' . $a->url) }}" target="_blank">
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
                                    wire:click="modal_lampiran_survey_ubah('{{ $a->lampiran_id }}','{{ $a->url }}')"
                                    type="button" data-toggle="modal" data-target="#modal_lampiran_survey_ubah"><i
                                        class="fas fa-edit"></i>
                                    Ubah</a>
                                <a onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'"
                                    class="dropdown-item"
                                    wire:click="modal_lampiran_survey_hapus('{{ $a->lampiran_id }}','{{ $a->url }}')"
                                    data-toggle="modal" data-target="#modal_lampiran_survey_hapus"
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

    @include('modal.modal_lampiran_survey_tambah')
    @include('modal.modal_lampiran_survey_ubah')
    @include('modal.modal_lampiran_survey_hapus')
</div>
