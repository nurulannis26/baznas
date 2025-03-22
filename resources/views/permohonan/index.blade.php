@extends('main')

@section('css')
@section('content')
@section('permohonan', 'active')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row ">

                <div class="col-sm-6 text-secondary mt-1">
                    <a href="/"> Dashboard</a> /
                    <a> Permohonan</a>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ Carbon\Carbon::parse(now())->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content ">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card ijo-atas">


                        {{-- tabbed --}}
                        <div class="row mt-2 mr-2 ml-2 card-header-data-pengajuan-pc">
                            <div class="col-12 col-md-3 col-sm-12 mb-2 mb-xl-0">
                                <h5 class=" mt-2">
                                    <span class="text-success mt-1">Data Permohonan</span>
                                </h5>
                            </div>
                        </div>


                        {{-- card body --}}
                        <div class="card-body ">

                            halo permohonan!
                        </div>
                        {{-- end card body --}}



                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>

@endsection




@push('intro-data-pengajuan-pc-lazisnu')
    <script>
        var yesoy = document.getElementById("panduan");
        yesoy.onclick = function() {
            introJs().setOptions({
                steps: [{
                        element: document.querySelector('.card-header-data-pengajuan-pc'),
                        title: 'Data Pengajuan',
                        intro: 'Menampilkan pengajuan pentasyarufan tingkat Internal Manajemen Eksekutif dan Umum Lazisnu Cilacap'
                    },
                    {
                        element: document.querySelector('.intro-header-data-pengajuan-pcs'),
                        title: 'Aksi',
                        intro: 'Menampilkan informasi dan aksi mengenai data pengajuan yang dipilih'
                    },
                    {
                        element: document.querySelector('.intro-filter-data-pengajuan-pc'),
                        title: 'Filter Pengajuan',
                        intro: 'Untuk menampilkan data pentasyarufan secara spesifik, gunakan filter'
                    },
                    {
                        element: document.querySelector('.intro-ekspor-data-pengajuan-pc'),
                        title: 'Ekspor',
                        intro: 'Klik disini untuk ekspor data pengajuan pentasyarufan '
                    },
                    {
                        element: document.querySelector('.intro-reset-filter-data-pengajuan-pc'),
                        title: 'Reset',
                        intro: 'Klik disini untuk mereset filter'
                    },
                    {
                        element: document.querySelector('.intro-tambah-data-pengajuan-pc'),
                        title: 'Tambah',
                        intro: 'Klik disini untuk menambahkan pengajuan'
                    },


                    {
                        element: document.querySelector('.intro-table-data-pengajuan-pc'),
                        title: 'Data Pengajuan',
                        intro: 'Data pengajuan berdasarkan filter akan tampil di tabel berikut, klik mana saja pada salah satu data untuk melihat detail'
                    },
                ]

            }).onbeforechange(function() {

                if (this._currentStep === 0) {
                    $('#internal-tab').find('span').trigger('click');
                    return true;
                }
            }).oncomplete(function() {
                location.reload();
            }).start();


        }
    </script>
@endpush
