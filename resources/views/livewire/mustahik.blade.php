<div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="margin-left:5px; ">
                <h5 class=" mt-2">
                    <span class="text-success mt-1">Data Mustahik</span>
                </h5>
            </div>
            <div>
                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                     
                    
                    <!-- Tombol Import -->
                    <button type="button" class="btn btn-outline-success">
                        <i class="fas fa-file-excel"></i>&ensp;Import
                    </button>

                    <!-- Tombol Ekspor -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false"><i class="fas fa-file-download"></i>&ensp;Ekspor
                        </button>
                        <div class="dropdown-menu" style="border-radius: 10px">
                            <a class="dropdown-item" target="_blank" href="{{ route('import_mustahik', ['permohonan_id' => $data_detail->permohonan_id]) }}">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                            <a class="dropdown-item" target="_blank" href="">
                                <i class="fas fa-file-alt"></i> EXCEL
                            </a>
                        </div>
                    </div>
                    <button class="btn btn btn-success" data-toggle="modal"
                            data-target="#modal_tambah_mustahik" type="button"><i class="fas fa-plus-circle"></i>
                            Tambah</button>
                </div>

            </div>


        </div>
    </div>

    <br>


    <table class="table table-bordered table-hover" id="Mustahik" style="width:100%">
        <thead>
            <tr class="text-center ">
                <th style="width: 3%;vertical-align:middle;text-align:center"> No</th>
                <th style="width: 9%;vertical-align:middle;text-align:center">Tanggal <br> Realisasi</th>
                <th style="width: 24%;vertical-align:middle;text-align:center">Nama <br> Mustahik</th>
                <th style="width: 25%;vertical-align:middle;text-align:center">Alamat</th>
                <th style="width: 14%;vertical-align:middle;text-align:center">Tanggal <br> Lahir</th>
                <th style="width: 13%;vertical-align:middle;text-align:center">Jenis <br> Bantuan</th>
                <th style="width: 13%;vertical-align:middle;text-align:center">Nominal <br>Bantuan</th>
                <th style="width: 9%;vertical-align:middle;text-align:center">Keterangan</th>
            </tr>
        </thead>
        <tbody>

            {{-- @foreach ($penerima_manfaat_ranting as $p_manfaat_ranting) --}}
            <tr style=" cursor: pointer;">
                {{-- row1 --}}
                <td style="text-align:center;padding-top:3mm;">1</td>
                <td>25/07/2025</td>
                <td>Anindya Sekarnita<br>
                    NKK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 3301090000099099 <br>
                    NIK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 3301090000099099 <br>
                    NO HP &nbsp;: 089789909009
                </td>
                <td>Jalan Merbabu No.1 Sidanegara Cilacap</td>
                <td>02/01/1999<br>
                    Jumlah KK &nbsp;&nbsp;&nbsp;: 1 <br>
                    Jumlah Jiwa : 5
                </td>
                <td>Uang</td>
                <td>Rp 1.000.000,-</td>
                <td>-</td>

            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</div>

@push('script-permohonan')
    <script>
        $(document).ready(function() {
            $('#Mustahik').DataTable({
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
@endpush

</div>
