<div>
    @php
        
        function penyebut($nilai)
        {
            $nilai = abs($nilai);
            $huruf = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
            $temp = '';
            if ($nilai < 12) {
                $temp = ' ' . $huruf[$nilai];
            } elseif ($nilai < 20) {
                $temp = penyebut($nilai - 10) . ' Belas';
            } elseif ($nilai < 100) {
                $temp = penyebut($nilai / 10) . ' Puluh' . penyebut($nilai % 10);
            } elseif ($nilai < 200) {
                $temp = ' Seratus' . penyebut($nilai - 100);
            } elseif ($nilai < 1000) {
                $temp = penyebut($nilai / 100) . ' Ratus' . penyebut($nilai % 100);
            } elseif ($nilai < 2000) {
                $temp = ' Seribu' . penyebut($nilai - 1000);
            } elseif ($nilai < 1000000) {
                $temp = penyebut($nilai / 1000) . ' Ribu' . penyebut($nilai % 1000);
            } elseif ($nilai < 1000000000) {
                $temp = penyebut($nilai / 1000000) . ' Juta' . penyebut($nilai % 1000000);
            } elseif ($nilai < 1000000000000) {
                $temp = penyebut($nilai / 1000000000) . ' Milyar' . penyebut(fmod($nilai, 1000000000));
            } elseif ($nilai < 1000000000000000) {
                $temp = penyebut($nilai / 1000000000000) . ' Trilyun' . penyebut(fmod($nilai, 1000000000000));
            }
            return $temp;
        }
        
        function terbilang($nilai)
        {
            if ($nilai < 0) {
                $hasil = 'Minus ' . trim(penyebut($nilai));
            } elseif ($nilai == 0) {
                $hasil = 'Nol ' . trim(penyebut($nilai));
            } else {
                $hasil = trim(penyebut($nilai));
            }
            return '(' . $hasil . ' Rupiah)';
        }
    @endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col col-md-12 col-sm-12">
                    <div class="card ijo-atas">
                        <div class="card-body">

                            {{-- card pengajuan --}}
                            <div class="card card-body" id="nt-0"
                                style="display: bg-success block">
                                {{-- tabbed --}}
                                <div class="row">
                                    <div class="col-4 col-md-12  col-sm-12 ">
                                        <ul class="nav nav-tabs mt-1 ml-1 mr-1" id="myTab1" role="tablist">
                                            <style>
                                                div>ul>li>a.active {
                                                    color: #28a745 !important;
                                                    font-weight: bold;
                                                }

                                                div>ul>li>a.active:hover {
                                                    color: #28a745 !important;
                                                    font-weight: bold;
                                                }

                                                div>ul>li>a.nav-link:hover {
                                                    font-weight: bold;
                                                }
                                            </style>
                                            {{-- tab v1 --}}
                                            <li class="nav-item tab-tab-pengajuan-umum-pc" role="presentation">
                                                <a wire:ignore.self class="nav-link text-secondary active"
                                                    id="v1-tab" data-toggle="tab" data-target="#v1"
                                                    type="button" role="tab" aria-controls="v1"
                                                    aria-selected="true">1. Data Permohonan</a>
                                            </li>
                                            {{-- tab v3 --}}
                                            <li class="nav-item " role="presentation">
                                                <a wire:ignore.self class="nav-link text-secondary " id="v2-tab"
                                                    data-toggle="tab" data-target="#v2" type="button"
                                                    role="tab" aria-controls="v2" aria-selected="false">2.
                                                    Persetujuan Atasan</a>
                                            </li>
                                            {{-- end tab v3 --}}

                                            {{-- tab v3 --}}
                                            <li class="nav-item survey" role="presentation">
                                                <a wire:ignore.self class="nav-link text-secondary "
                                                    id="v3-tab" data-toggle="tab" data-target="#v3"
                                                    type="button" role="tab" aria-controls="v3"
                                                    aria-selected="false">3.
                                                    Survey</a>
                                            </li>
                                            {{-- end tab v3 --}}
                                            {{-- tab v4 --}}
                                            <li class="nav-item tab-keuangan-umum-pc" role="presentation">
                                                <a wire:ignore.self class="nav-link text-secondary " id="v4-tab"
                                                    data-toggle="tab" data-target="#v4" type="button"
                                                    role="tab" aria-controls="v4" aria-selected="false">4.
                                                    Pencairan Keuangan</a>
                                            </li>
                                            {{-- end tab v4 --}}

                                            {{-- tab lpj --}}
                                            <li class="nav-item" role="presentation">
                                                <a wire:ignore.self
                                                    class="nav-link text-secondary " id="v5-tab"
                                                    data-toggle="tab" data-target="#v5" type="button"
                                                    role="tab" aria-controls="v5" aria-selected="false">5. LPJ
                                                    & BA</a>
                                            </li>
                                            {{-- end tab lpj --}}


                                        </ul>
                                    </div>
                                </div>
                                {{-- end tabbed --}}



                                {{-- isi tabbed --}}
                                <div class="tab-content" id="myTab1">


                                    <div wire:ignore.self class="tab-pane fade show active " id="v1"
                                        role="tabpanel" aria-labelledby="v1-tab">
                                        @include('detail.tab-v1')
                                    </div>

                                    <div wire:ignore.self class="tab-pane fade" id="v2"
                                        role="tabpanel" aria-labelledby="v2-tab">
                                        @include('detail.tab-v2')
                                    </div>

                                    <div wire:ignore.self class="tab-pane fade " id="v3" role="tabpanel"
                                        aria-labelledby="v3-tab">
                                        @include('detail.tab-v3')
                                    </div>

                                    <div wire:ignore.self class="tab-pane fade " id="v4" role="tabpanel"
                                        aria-labelledby="v4-tab">
                                        @include('detail.tab-v4')
                                    </div>

                                    <div wire:ignore.self class="tab-pane fade " id="v5" role="tabpanel"
                                        aria-labelledby="v5-tab">
                                        @include('detail.tab-v5')
                                    </div>

                                </div>
                                {{-- end isi tabbed --}}
                            </div>
                            {{-- end card pengajuan --}}

                        </div>

                    </div>
                </div>


            </div>

        </div>

        {{-- @include('modal.modal_pengajuan_kegiatan') --}}
        
    </div>
</div>
</div>
