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
                                <option value="">Semua</option>
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
                                <option value="">Semua</option>
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
                                <option value="">Semua</option>
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
                                <option value="">Semua</option>
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
                                <option value="">Semua</option>
                                <option value="Belum LPJ">Belum LPJ</option>
                                <option value="Sudah LPJ">Sudah LPJ</option>
                            </select>
                        </div>
                    </div>
                    {{-- tombol reset --}}
                    <div class="col-12 col-md-3 col-sm-12 mb-2 mb-xl-0">
                        <a form="none" class="btn btn-light border-grey hover btn-block tombol-reset-pc"
                            href=""><i class="fas fa-sync-alt"></i>&nbsp;
                        </a>
                    </div>
                    {{-- end tombol reset --}}


                    <div class="col-12 col-md-3 col-sm-12 mb-2 mb-xl-0">
                        <div class="btn-group btn-block ">
                            <button type="button" class="btn btn-outline-success btn-block dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-file"></i>&nbsp; Ekspor
                            </button>
                            <div class="dropdown-menu">
                                <a form="none" class="dropdown-item" onMouseOver="this.style.color='red'"
                                    onMouseOut="this.style.color='black'" type="button" href="" target="_blank">
                                    <i class="fas fa-file-pdf"></i>&nbsp; Pdf
                                </a>
                                <a form="none" class="dropdown-item" onMouseOver="this.style.color='green'"
                                    onMouseOut="this.style.color='black'" type="button" href="#">
                                    <i class="fas fa-file-excel"></i>&nbsp; Excel
                                </a>

                            </div>
                        </div>
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
            <table class="table table-bordered table-hover" id="Permohonan" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th style="vertical-align:middle;width: 3%;">No</th>
                        <th style="vertical-align:middle;width: 30%;">Nomor
                            &amp; Nominal Pengajuan</th>
                        <th style="vertical-align:middle;width: 22%;">Program
                            &amp; Sub Program</th>
                        <th style="vertical-align:middle;width: 15%;">Survey
                        </th>
                        <th style="vertical-align:middle;width: 15%;">Pencairan
                        </th>
                        <th style="vertical-align:middle;width: 15%;">LPJ
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $a)
                        <tr onclick="window.open('/detail-permohonan/{{ $a->permohonan_id }}', '_blank');"
                            style=" cursor: pointer;">
                            <td class="text-center text-bold">{{ $loop->iteration }}</td>
                            <td style="width: 30%">
                                <sup class="badge {{ $bg_fo }} text-white">{{ $ket_fo }}</sup>
                                <br>

                                <span class="text-bold" style="font-size: 13px">
                                    {{ $a->permohonan_nomor }}
                                </span>
                                <br>
                                <div class="d-flex justify-content-between" style="font-size: 13px">
                                    <div>Nominal Diajukan</div>
                                    <div class="text-bold">
                                        Rp{{ number_format($a->permohonan_nominal), 0, '.', '.' }}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between" style="font-size: 13px">
                                    <div>Tgl Permohonan</div>
                                    <div class="text-bold">
                                        {{ Carbon\Carbon::parse($a->permohonan_tgl)->isoFormat('D MMM YYYY') }}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between" style="font-size: 13px">
                                    <div>Tgl Selesai Diinput</div>
                                    <div class="text-bold">
                                        {{ Carbon\Carbon::parse($a->permohonan_timestamp_input)->isoFormat('D MMM YYYY') }}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between" style="font-size: 13px">
                                    <div>Pemohon</div>
                                    <div class="flex flex-row">
                                        <p>Pemohon</p>
                                        <sup
                                            class="badge {{ $bg_jenis }} text-white">{{ $permohonan_jenis }}</sup>
                                    </div>
                                    <div class="text-bold" style="font-size: 13px">
                                        {{ $nama }}
                                    </div>
                                </div>
                            </td>

                            <td style="width: 10%">
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

                                <sup class="badge {{ $bg_survey }} text-white">{{ $ket_survey }}
                                    Direktur</sup>
                                <br>
                                <span class="text-bold" style="font-size: 13px">
                                    {{ $a->survey_status ?? '-' }}
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
                                <sup class="badge {{ $bg_pencairan }} text-white">{{ $ket_pencairan }}
                                    Keuangan</sup>
                                <br>
                                <span class="text-bold" style="font-size: 13px">
                                    Sumber:DANA ZAKAT
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ Carbon\Carbon::parse($a->pencairan_timestamp)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </span> <br>
                                <div class="row text-right">
                                    <div class="col text-bold  text-left" style="font-size: 10pt;">
                                        Nominal Dicairkan
                                    </div>
                                    <div class="col text-bold text-right" style="font-size: 10pt;">
                                        <b class="text-success" style="font-size: 10pt;">
                                            Rp{{ number_format($a->pencairan_nominal), 0, '.', '.' }}
                                        </b>
                                    </div>
                                </div>
                                <span class="text-bold" style="font-size: 13px">
                                    Catatan Tambahan:
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ $a->pencairan_catatan ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <sup class="badge {{ $bg_lpj }} text-white">{{ $ket_lpj }}
                                    Keuangan</sup>
                                <br>
                                <span class="text-bold" style="font-size: 13px">
                                    Sudah disalurkan
                                </span> <br>
                                <span style="font-size: 13px">
                                    {{ Carbon\Carbon::parse($a->survey_tgl)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                </span> <br>
                                <div class="row text-right">
                                    <div class="col text-bold  text-left" style="font-size: 10pt;">
                                        Bentuk Penyaluran
                                    </div>
                                    <div class="col text-bold text-right" style="font-size: 10pt;">
                                        <b class="text-success" style="font-size: 10pt;">
                                            Uang Tunai
                                        </b>
                                    </div>
                                </div>
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
        {{-- end tabel --}}

        @push('script-permohonan')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
        $(document).ready(function() {
            $('#Permohonan').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                "paging": true,    // Aktifkan pagination
                "searching": true, // Aktifkan search box
                "info": true,      // Aktifkan informasi tampilan data
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

            function submitFormUpzis() {
                $('#reportrange').val(window.start.format('Y-MM-DD') + ' - ' + window.end.format('Y-MM-DD'));
                $('#filterFormPermohonan').submit();
            }
        </script>
    @endpush

    </div>
