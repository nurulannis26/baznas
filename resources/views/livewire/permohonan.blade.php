<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="/filter_permohonan_post" method="post" id="filterFormPermohonan">
                @csrf

                {{-- baris 1 --}}
                <div class="form-row ">
                    <div class="col-12 col-md-3 col-sm-12 mb-2 mb-xl-0">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control text-center icon-input" id="reportrange"
                                wire:ignore name="filter_daterange" readonly
                                style="background-color: white;cursor: pointer;min-width:175px;height:37.5px;">
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-sm-12 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bor-abu" style="width: 90px;">Status FO </span>
                            </div>
                            <select wire:model="filters_fo" wire:loading.attr="disabled" class="form-control"
                                onchange="submitPermohonan();" name="fo_lv">
                                <option value="Semua">Semua</option>
                                <option value="Belum Selesai Input">Belum Selesai Input</option>
                                <option value="Selesai Input">Selesai Input</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-sm-12 mb-2 mb-xl-0">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bor-abu">Acc Atasan</span>
                            </div>
                            <select wire:model="filters_atasan" wire:loading.attr="disabled" class="form-control"
                                onchange="submitPermohonan();" name="atasan_lv">
                                <option value="Semua">Semua</option>
                                <option value="Belum Dicek">Belum Dicek</option>
                                <option value="Diterima">Diterima</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-sm-12 mb-2 ">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bor-abu" style="width: 90px;">Survey</span>
                            </div>
                            <select wire:model="filters_survey" wire:loading.attr="disabled" class="form-control"
                                onchange="submitPermohonan();" name="survey_lv">
                                <option value="Semua">Semua</option>
                                <option value="Tidak Perlu">Tidak Perlu</option>
                                <option value="Perlu">Perlu</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-sm-12 mb-2 ">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bor-abu" style="width: 90px;">ACC Keu</span>
                            </div>
                            <select wire:model="filters_pencairan" wire:loading.attr="disabled" class="form-control"
                                onchange="submitPermohonan();" name="pencairan_lv">
                                <option value="Semua">Semua</option>
                                <option value="Belum Dicairkan">Belum Dicairkan</option>
                                <option value="Berhasil Dicairkan">Berhasil Dicairkan</option>
                            </select>
                        </div>
                    </div>
                    {{-- end status --}}

                    {{-- status --}}
                    <div class="col-12 col-md-3 col-sm-12 mb-2 ">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bor-abu" style="width: 90px;">LPJ</span>
                            </div>
                            <select wire:model="filters_lpj" wire:loading.attr="disabled" class="form-control"
                                onchange="submitPermohonan();" name="lpj_lv">
                                <option value="Semua">Semua</option>
                                <option value="Belum LPJ">Belum LPJ</option>
                                <option value="Sudah LPJ">Sudah LPJ</option>
                            </select>
                        </div>
                    </div>
                    {{-- tombol reset --}}
                    <div class="col-12 col-md-1 col-sm-12 mb-2 mb-xl-0">
                        <a form="none" class="btn btn-light border-grey hover btn-block tombol-reset-pc"
                            href=""><i class="fas fa-sync-alt"></i>&nbsp;
                        </a>
                    </div>
                    {{-- end tombol reset --}}
                    <div class="col-12 col-md-2 col-sm-12 mb-2 mb-xl-0">
                        <div class="btn-group btn-block ">
                            <button type="button" class="btn btn-outline-success btn-block dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-file"></i>&nbsp; Ekspor
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" onMouseOver="this.style.color='red'"
                                    onMouseOut="this.style.color='black'" type="button"
                                    href="{{ route('print_permohonan_pdf', [
                                        'filter_daterange' => $filter_daterange,
                                        'filters_fo' => $filters_fo,
                                        'filters_atasan' => $filters_atasan,
                                        'filters_pencairan' => $filters_pencairan,
                                        'filters_survey' => $filters_survey,
                                        'filters_lpj' => $filters_lpj,
                                    ]) }}"
                                    target="_blank">
                                    <i class="fas fa-file-pdf"></i>&nbsp; Pdf
                                </a>

                                {{-- <a form="none" class="dropdown-item" onMouseOver="this.style.color='green'"
                                    onMouseOut="this.style.color='black'" type="button" href="#">
                                    <i class="fas fa-file-excel"></i>&nbsp; Excel
                                </a> --}}

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 col-sm-12 mb-2 mb-xl-0 intro-tambah-data-pengajuan-pc">
                        <button class="btn btn btn-success btn-block tombol-tambah" data-toggle="modal"
                            data-target="#modal_tambah_permohonan" type="button"><i class="fas fa-plus-circle"></i>
                            Tambah</button>
                    </div>




                    {{-- end ekspor --}}

                </div>
                {{-- end baris 1 --}}

            </form>

            <div class="form-row mt-0">

                {{-- info --}}
                <div>
                    <div class="d-flex flex-row bd-highlight align-items-center">
                        <div class="p-2 bd-highlight">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="p-1 bd-highlight">
                            <span>Menampilkan data permohonan pada filter terpilih.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="intro-table-data-permohonan">
        {{-- page number --}}


        {{-- tabel --}}
        <div class="table-responsive ">
            <table class="table table-bordered table-hover" id="Permohonan" style="width:100%" wire:ignore>
                <thead>
                    <tr class="text-center">
                        <th style="vertical-align:middle;width: 3%;">No</th>
                        <th style="vertical-align:middle;width: 25%;">Nomor
                            &amp; Nominal Pengajuan</th>
                        <th style="vertical-align:middle;width: 20%;">Program
                            &amp; Sub Program</th>
                        <th style="vertical-align:middle;width: 15%;">Survey
                        </th>
                        <th style="vertical-align:middle;width: 17%;">Pencairan
                        </th>
                        <th style="vertical-align:middle;width: 17%;">LPJ
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $a)
                        {{-- {{dd($data)}} --}}
                        @php

                            if ($a->permohonan_status_input == 'Selesai Input') {
                                $bg_fo = 'badge-success';
                                $ket_fo = 'Pengajuan Selesai diinput FO';
                            } else {
                                $bg_fo = 'badge-warning';
                                $ket_fo = 'Pengajuan Blm Selesai diinput FO';
                            }

                            if ($a->permohonan_status_atasan == 'Diterima') {
                                $bg_atasan = 'badge-success';
                                $ket_atasan = 'Disetujui Atasan';
                            } elseif ($a->permohonan_status_atasan == 'Ditolak') {
                                $bg_atasan = 'badge-danger';
                                $ket_atasan = 'Ditolak Atasan';
                            } else {
                                $bg_atasan = 'badge-warning';
                                $ket_atasan = 'Blm Direspon Atasan';
                            }

                            if ($a->survey_status == 'Selesai') {
                                $bg_survey = 'badge-success';
                                $ket_survey = 'Survey Selesai';
                                $survey = 'Selesai';
                            } else {
                                $bg_survey = 'badge-warning';
                                $ket_survey = 'Blm Survey';
                                $survey = 'Blm Selesai';
                            }

                            if ($a->pyl_status == 'Selesai') {
                                $bg_pyl = 'badge-success';
                                $ket_pyl = 'LPJ Selesai';
                                $pyl = 'Sudah disalurkan';
                            } else {
                                $bg_pyl = 'badge-warning';
                                $ket_pyl = 'LPJ Blm Selesai';
                                $pyl = 'Blm disalurkan';
                            }

                            if ($a->pencairan_status == 'Berhasil Dicairkan') {
                                $bg_pencairan = 'badge-success';
                                $ket_pencairan = 'Sudah Dicairkan';
                            } elseif ($a->pencairan_status == 'Ditolak') {
                                $bg_pencairan = 'badge-danger';
                                $ket_pencairan = 'Ditolak Dicairkan';
                            } else {
                                $bg_pencairan = 'badge-warning';
                                $ket_pencairan = 'Blm Dicairkan';
                            }

                            if ($a->permohonan_jenis == 'Individu') {
                                $bg_jenis = 'badge-success';
                                $nama = $a->permohonan_nama_pemohon;
                            } else {
                                $bg_jenis = 'badge-primary';
                                $nama = $this->nama_upz($a->upz_id);
                            }

                        @endphp
                        <tr onclick="window.open('/detail-permohonan/{{ $a->permohonan_id }}', '_blank');"
                            style=" cursor: pointer;">
                            <td class="text-center text-bold">{{ $loop->iteration }}</td>
                            <td style="width: 25%">
                                <sup class="badge {{ $bg_fo }} text-white">{{ $ket_fo }}</sup>
                                <br>

                                <span class="text-bold" style="font-size: 13px">
                                    {{ $a->permohonan_nomor }}
                                </span>
                                <br>
                                <span class="d-flex justify-content-between" style="font-size: 13px">
                                    <span>Nominal Diajukan</span>
                                    <span class="text-bold">
                                        Rp{{ number_format($a->permohonan_nominal), 0, '.', '.' }}
                                    </span>
                                </span>
                                <span class="d-flex justify-content-between" style="font-size: 13px">
                                    <span>Tgl Permohonan</span>
                                    <span class="text-bold">
                                        {{ Carbon\Carbon::parse($a->permohonan_tgl)->isoFormat('D MMM YYYY') }}
                                    </span>
                                </span>
                                <span class="d-flex justify-content-between" style="font-size: 13px">
                                    <span>Tgl Selesai Diinput</span>
                                    <span class="text-bold">
                                        {{ Carbon\Carbon::parse($a->permohonan_timestamp_input)->isoFormat('D MMM YYYY') }}
                                    </span>
                                </span>
                                <span class="d-flex justify-content-between align-items-center"
                                    style="font-size: 13px;">
                                    <span class="d-flex align-items-center">
                                        <p class="mb-0 mr-2">Pemohon</p>
                                        <span class="badge px-3 py-1 text-white"
                                            style="background-color: #0F5132; border-radius: 20px;">{{ $a->permohonan_jenis }}</span>
                                    </span>
                                    <span class="font-weight-bold " style="font-size: 13px;">
                                        {{ $nama }}
                                    </span>
                                </span>
                            </td>

                            <td style="width: 20%">
                                <sup class="text-light badge {{ $bg_atasan }}">{{ $ket_atasan }}
                                </sup>
                                <br>
                                <span class="text-bold" style="font-size: 13px">
                                    {{ App\Models\Program::where('program_id', $a->program_id)->value('program') ?? '-' }}
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ App\Models\SubProgram::where('sub_program_id', $a->sub_program_id)->value('sub_program') ?? '-' }}
                                </span> <br>
                                <span class="text-bold" style="font-size: 13px">
                                    Catatan Tambahan:
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ $a->permohonan_catatan_atasan ?? '-' }}
                                </span>
                            </td>

                            <td>

                                <sup class="badge {{ $bg_survey }} text-white">{{ $ket_survey }}</sup>
                                <br>
                                <span class="text-bold" style="font-size: 13px">
                                    {{ $survey }}
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ Carbon\Carbon::parse($a->survey_tgl)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </span> <br>
                                <a href="" style="font-size: 13px">Form survey.pdf</a> <br>
                                <span class="text-bold" style="font-size: 13px">
                                    Catatan Tambahan:
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ $a->survey_hasil ?? '-' }}
                                </span>

                            </td>
                            <td>
                                <sup class="badge {{ $bg_pencairan }} text-white">{{ $ket_pencairan }}</sup>
                                <br>
                                <span class="text-bold" style="font-size: 13px">
                                    Sumber:DANA ZAKAT
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ Carbon\Carbon::parse($a->pencairan_timestamp)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </span> <br>
                                <span class="row text-right">
                                    <span class="col text-bold  text-left" style="font-size: 10pt;">
                                        Nominal Dicairkan
                                    </span>
                                    <span class="col text-bold text-right" style="font-size: 10pt;">
                                        <b class="" style="font-size: 10pt;">
                                            Rp{{ number_format($a->pencairan_nominal), 0, '.', '.' }}
                                        </b>
                                    </span>
                                </span>
                                <span class="text-bold" style="font-size: 13px">
                                    Catatan Tambahan:
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ $a->pencairan_catatan ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <sup class="badge {{ $bg_pyl }} text-white">{{ $ket_pyl }}
                                </sup>
                                <br>
                                <span class="text-bold" style="font-size: 13px">
                                    {{ $pyl }}
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ Carbon\Carbon::parse($a->survey_tgl)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </span> <br>
                                <span class="row text-right">
                                    <span class="col text-bold  text-left" style="font-size: 10pt;">
                                        Bentuk Penyaluran
                                    </span>
                                    <span class="col text-bold text-right" style="font-size: 10pt;">
                                        <b class="" style="font-size: 10pt;">
                                            Uang Tunai
                                        </b>
                                    </span>
                                </span>
                                <span class="text-bold" style="font-size: 13px">
                                    Catatan Tambahan:
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ $a->pencairan_catatan ?? '-' }}
                                </span>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="row">
            <div class="col-md-8">

                <div class="card " style="height: 50vh;" wire:ignore>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <strong>
                                Jumlah Permohonan Berdasarkan Program
                            </strong>
                        </div>
                        <div class="row">
                            <canvas id="myChart5"
                                style="min-height: 300px; height: 300px; max-height: 100%; max-width: 100%; "></canvas>


                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card " style="height: 50vh;">

                    <div class="card-body">
                        <strong>
                            Statistik Permohonan
                        </strong>
                        <br><br>

                        <div class="table-responsive">
                            <table class="table">


                                <tr>
                                    <th style="width:50%">Jumlah Permohonan:</th>
                                    <td>5 </td>
                                </tr>
                                <tr>
                                    <th>Total Nominal Permohonan:</th>
                                    <td> 10000</td>
                                </tr>
                                <tr>
                                    <th> Total Penerima :</th>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <th>Total Nominal Disetujui :</th>
                                    <td>Rp. 100000</td>
                                </tr>


                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            Chart.defaults.font.size = 12;
            const ctx3 = document.getElementById('myChart5');

            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: [
                        'Ekonomi', 'Pendidikan', 'Kesehatan', ['Dakwah', 'Kemanusiaan'],
                        'Lingkungan', 'Operasional'
                    ],
                    datasets: [{
                        label: 'Jumlah Kegiatan',
                        backgroundColor: 'rgba(0, 89, 59, 0.7)',
                        borderColor: 'rgba(0, 89, 59, 0.7)',
                        pointRadius: false,
                        pointColor: '#00593b',
                        pointStrokeColor: 'rgba(0, 89, 59, 0.7)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(0, 89, 59, 0.7)',
                        data: [2, 4, 6, 7, 4, 2]
                    }, ]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: false
                    }


                }
            });
        </script>

        @include('modal.modal_tambah_permohonan')

        {{-- end tabel --}}

        @push('script-permohonan')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                $(document).ready(function() {
                    $('#Permohonan').DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                        },
                        "paging": true, // Aktifkan pagination
                        "searching": true, // Aktifkan search box
                        "info": true, // Aktifkan informasi tampilan data
                        "lengthMenu": [5, 10, 25, 50, 100], // Pilihan jumlah baris per halaman
                        "pageLength": 5 // Jumlah baris awal yang ditampilkan
                    });
                });
            </script>


            @php
                $data_first = App\Models\Permohonan::orderBy('created_at', 'asc')->first();
                $data_last = App\Models\Permohonan::orderBy('created_at', 'desc')->first();

                if ($data_first) {
                    $data_first = $data_first->created_at->format('Y-m-d');
                } else {
                    $data_first = null;
                }

                if ($data_last) {
                    $data_last = $data_last->created_at->format('Y-m-d');
                } else {
                    $data_last = null;
                }
            @endphp

            <script>
                // daterange
                $(function() {

                    var start_date = '{{ $start_date }}';
                    var end_date = '{{ $end_date }}';

                    var start = moment(start_date);
                    var end = moment(end_date);

                    function cb(start, end) {
                        $('#reportrange').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                    }
                    // moment.locale('id');
                    $('#reportrange').daterangepicker({
                        startDate: start,
                        endDate: end,
                        locale: {
                            format: 'D MMMM YYYY',
                            separator: ' - ',
                            applyLabel: 'Pilih',
                            cancelLabel: 'Batal',
                            fromLabel: 'Dari',
                            toLabel: 'Hingga',
                            customRangeLabel: 'Pilih Tanggal',
                            weekLabel: 'Mg',
                            daysOfWeek: ['Mg', 'Sn', 'Sl', 'Rb', 'Km', 'Jm', 'Sb'],
                            monthNames: [
                                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                                'Agustus', 'September', 'Oktober', 'November', 'Desember'
                            ],
                            firstDay: 1
                        },
                        ranges: {
                            'Hari ini': [moment(), moment()],
                            'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                            '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                            'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                            'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                                'month').endOf('month')],
                            'Tahun Ini': [moment().startOf('year'), moment().endOf('year')],
                            'Semua': [moment('{{ $data_first }}'), moment('{{ $data_last }}')]

                        }
                    }, function(start, end) {
                        $('#reportrange').val(start.format('Y-MM-DD') + ' - ' + end.format('Y-MM-DD'));
                        $('#filterFormPermohonan').submit(); // Mengirimkan formulir saat terjadi perubahan
                    });

                    // moment.locale('id');
                    cb(start, end);
                    window.start = start;
                    window.end = end;

                });

                function submitPermohonan() {
                    $('#reportrange').val(window.start.format('Y-MM-DD') + ' - ' + window.end.format('Y-MM-DD'));
                    $('#filterFormPermohonan').submit();
                }
            </script>
        @endpush

    </div>
