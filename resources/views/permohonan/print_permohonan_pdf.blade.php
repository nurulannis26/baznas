<!DOCTYPE html>
<html>

{{-- @php
use Carbon\Carbon;

$start_date = Carbon::parse(explode(' - ', $filter_daterange)[0])->translatedFormat('d F Y');
$end_date   = Carbon::parse(explode(' - ', $filter_daterange)[1])->translatedFormat('d F Y');
@endphp --}}



<head>
    <title>{{ 'PERMOHONAN_' . $filter_daterange }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>


<style>
    @page {
        margin: 0.5cm;
    }

    header {
        /* position: fixed; */
        margin-top: -0.1cm;
        left: 0cm;
        right: 0cm;
        height: 1cm;
        text-align: center;
    }

    footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 1cm;
        text-align: center;
    }

    footer .pagenum:before {
        content: counter(page);
    }

    body {
        font-family: sans-serif;
        font-size: 12px;
    }

    #data-table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }

    #data-table th,
    #data-table td {
        border: 1px solid #333;
        padding: 6px;
        vertical-align: top;
        text-align: left;
    }

    #data-table th {
        background-color: #f0f0f0;
        text-align: center;
    }

    .badge {
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 9px;
        display: inline-block;
    }

    .badge-success {
        background-color: #198754;
        color: #fff;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #000;
    }

    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .badge-primary {
        background-color: #0d6efd;
        color: #fff;
    }

    .text-bold {
        font-weight: bold;
    }

    .text-center {
        text-align: center;
    }
</style>

<footer>
    <div class="pagenum-container">


        <div style="clear:both;color:#9d9d9d">

            <p
                style="margin-top:0pt; margin-bottom:0pt; text-align:right; line-height:normal; border-bottom:2.25pt double #000000; padding-bottom:1px; font-size:10pt;">
                <strong><em>&nbsp;</em></strong>
            </p>
            <p
                style="margin-top:3pt; margin-bottom:0pt; text-align:right; line-height:150%; widows:0; orphans:0; font-size:11px;">
            </p>
            <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; line-height:normal; font-size:10pt;">
                <strong><em>E-Disday</em></strong>
            </p>

            <p style="margin-top:0pt; margin-bottom:0pt; text-align:right; line-height:normal; font-size:10pt;">
                <em>Dicetak
                    {{ Carbon\Carbon::parse(now())->isoFormat('D MMMM Y') . ' ' . Carbon\Carbon::parse(now())->format('H:i:s') . ' ' }}

                </em>
            </p>

        </div>

    </div>
</footer>

<main>
    <div>
        <header>
            <table style="width: 100%;margin-bottom: 10px;">
                <tr>
                    <!-- Logo di kiri -->
                    <td style="width: 33%; text-align: right;">
                        <img src="{{ public_path('/images/baznas.png') }}" width="100" height="80">
                    </td>

                    <!-- Teks di tengah -->
                    <td style="width: 40%; text-align: center;">
                        <p style="margin:0; font-size:14pt; font-weight:bold;">
                            REKAP PERMOHONAN E-DISDAY
                        </p>
                        <p style="margin:0; font-size:14pt; font-weight:bold;">
                            BAZNAS CILACAP
                        </p>
                        <p style="margin:0; font-size:13pt;">
                            Periode {{ $start_date }} - {{ $end_date }}
                        </p>
                    </td>

                    <!-- Kolom kanan kosong -->
                    <td style="width: 32%;"></td>
                </tr>
            </table>
            
            <hr class="mt-4">


        </header>
    </div>
    <br><br><br><br>
    <br><br>

    <body class="mt-3">
        <table id="data-table">
            <thead>
                <tr>
                    <th style="vertical-align:middle;width: 3%;">No</th>
                    <th style="vertical-align:middle;width: 25%;">Nomor & Nominal Pengajuan</th>
                    <th style="vertical-align:middle;width: 20%;">Program & Sub Program</th>
                    <th style="vertical-align:middle;width: 15%;">Survey</th>
                    <th style="vertical-align:middle;width: 17%;">Pencairan</th>
                    <th style="vertical-align:middle;width: 17%;">LPJ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $a)
                    @php
                        $bg_fo = $a->permohonan_status_input == 'Selesai Input' ? 'badge-success' : 'badge-warning';
                        $ket_fo =
                            $a->permohonan_status_input == 'Selesai Input'
                                ? 'Pengajuan Selesai diinput FO'
                                : 'Pengajuan Blm Selesai diinput FO';

                        $bg_atasan =
                            $a->permohonan_status_atasan == 'Diterima'
                                ? 'badge-success'
                                : ($a->permohonan_status_atasan == 'Ditolak'
                                    ? 'badge-danger'
                                    : 'badge-warning');
                        $ket_atasan =
                            $a->permohonan_status_atasan == 'Diterima'
                                ? 'Disetujui Atasan'
                                : ($a->permohonan_status_atasan == 'Ditolak'
                                    ? 'Ditolak Atasan'
                                    : 'Blm Direspon Atasan');

                        $bg_survey = $a->survey_status == 'Selesai' ? 'badge-success' : 'badge-warning';
                        $ket_survey = $a->survey_status == 'Selesai' ? 'Survey Selesai' : 'Blm Survey';
                        $survey = $a->survey_status == 'Selesai' ? 'Selesai' : 'Blm Selesai';

                        $bg_pyl = $a->pyl_status == 'Selesai' ? 'badge-success' : 'badge-warning';
                        $ket_pyl = $a->pyl_status == 'Selesai' ? 'LPJ Selesai' : 'LPJ Blm Selesai';
                        $pyl = $a->pyl_status == 'Selesai' ? 'Sudah disalurkan' : 'Blm disalurkan';

                        $bg_pencairan =
                            $a->pencairan_status == 'Berhasil Dicairkan'
                                ? 'badge-success'
                                : ($a->pencairan_status == 'Ditolak'
                                    ? 'badge-danger'
                                    : 'badge-warning');
                        $ket_pencairan =
                            $a->pencairan_status == 'Berhasil Dicairkan'
                                ? 'Sudah Dicairkan'
                                : ($a->pencairan_status == 'Ditolak'
                                    ? 'Ditolak Dicairkan'
                                    : 'Blm Dicairkan');

                        $bg_jenis = $a->permohonan_jenis == 'Individu' ? 'badge-success' : 'badge-primary';
                        $nama =
                            $a->permohonan_jenis == 'Individu'
                                ? $a->permohonan_nama_pemohon
                                : App\Http\Controllers\PermohonanController::nama_upz($a->upz_id);
                    @endphp

                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge {{ $bg_fo }}">{{ $ket_fo }}</span><br>
                            <strong>{{ $a->permohonan_nomor }}</strong>
                        
                            <table style="width: 100%; border: none; margin-top: 5px;">
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Nominal</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        Rp{{ number_format($a->permohonan_nominal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Tgl Permohonan</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        {{ \Carbon\Carbon::parse($a->permohonan_tgl)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Selesai Input</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        {{ \Carbon\Carbon::parse($a->permohonan_timestamp_input)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Pemohon</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        <span class="badge {{ $bg_jenis }}">{{ $a->permohonan_jenis }}</span>
                                        {{ $nama }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        
                        
                        
                        
                        
                        <td>
                            <span class="badge {{ $bg_atasan }}">{{ $ket_atasan }}</span><br>
                        
                            <table style="width: 100%; border: none; margin-top: 5px;">
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Program</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        <strong>{{ App\Models\Program::find($a->program_id)->program ?? '-' }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Sub Program</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        {{ App\Models\SubProgram::find($a->sub_program_id)->sub_program ?? '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Catatan</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        {{ $a->permohonan_catatan_atasan ?? '-' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        
                        <td>
                            <span class="badge {{ $bg_survey }}">{{ $ket_survey }}</span><br>
                        
                            <table style="width: 100%; border: none; margin-top: 5px;">
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Status</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        <strong>{{ $survey }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Tanggal</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        {{ \Carbon\Carbon::parse($a->survey_tgl)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Catatan</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        {{ $a->survey_hasil ?? '-' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        
                        <td>
                            <span class="badge {{ $bg_pencairan }}">{{ $ket_pencairan }}</span><br>
                        
                            <table style="width: 100%; border: none; margin-top: 5px;">
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Sumber</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">DANA ZAKAT</td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Tgl Cair</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        {{ \Carbon\Carbon::parse($a->pencairan_timestamp)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Nominal</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        Rp{{ number_format($a->pencairan_nominal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Catatan</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        {{ $a->pencairan_catatan ?? '-' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        
                        <td>
                            <span class="badge {{ $bg_pyl }}">{{ $ket_pyl }}</span><br>
                        
                            <table style="width: 100%; border: none; margin-top: 5px;">
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Status</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        <strong>{{ $pyl }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Tanggal</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        {{ \Carbon\Carbon::parse($a->survey_tgl)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Bentuk</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">Uang Tunai</td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">Catatan</td>
                                    <td style="border: none; padding: 2px 0; text-align: right;">
                                        {{ $a->pencairan_catatan ?? '-' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>

    </body>
</main>
