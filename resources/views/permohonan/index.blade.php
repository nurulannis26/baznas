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
                    <li class="breadcrumb-item active">
                        {{ Carbon\Carbon::parse(now())->locale('id')->isoFormat('dddd, D MMMM Y') }}
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
                        @if ($filter_permohonan == 'on')
                            <livewire:permohonan :c_filter_daterange="$c_filter_daterange" :c_filters_fo="$c_filters_fo" :c_filters_atasan="$c_filters_atasan" :c_filters_survey="$c_filters_survey"
                                :c_filters_pencairan="$c_filters_pencairan" :c_filters_lpj="$c_filters_lpj" :filter_permohonan="$filter_permohonan">
                            @else
                                <livewire:permohonan :filter_permohonan="$filter_permohonan">
                        @endif
                    </div>
                    {{-- end card body --}}



                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            window.loadContactDeviceSelect2 = () => {
                bsCustomFileInput.init();
                $('.tombol-tambah').click(function() {
                    $(".custom-file-surat").html('').change();
                });
    
            }
        });
    </script>
</section>
@endsection

@section('js')



<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>

@endsection


