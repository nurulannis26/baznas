<div>

    <div class="row mt-2">

        {{-- card pilar --}}
        <div class="col col-md-4 col-sm-12 intro-daftar-pilar-table">
            <div class="card ijo-atas">
                <b class="d-flex justify-content-center mt-3 ">Daftar Program </b>



                <div class="card-body ">

                    {{-- tabel --}}
                    @if ($pilars != null)

                        <table class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px;vertical-align:middle;">No</th>
                                    <th class="align-middle">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div> Program</div>
                                        </div>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pilars as $object)
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center"> Data tidak ditemukan</td>
                                    </tr>
                                @endforelse
                                @foreach ($pilars as $a)
                                    <tr wire:click="click_kegiatan('{{ $a->program_id }}','{{ $a->program }}')"
                                        style="cursor: pointer;
                                                @if ($program_id == $a->program_id) background-color:#ECECEC; @endif">
                                        <td wire:click="click_kegiatan('{{ $a->program_id }}','{{ $a->program }}')">
                                            {{ $loop->iteration }}</td>
                                        <td wire:click="click_kegiatan('{{ $a->program_id }}','{{ $a->program }}')">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div><span class="font-weight-bold">{{ $a->program }}</span>  <br>
                                                    <span>Sub Program: {{ $a->sub_programs_count }}</span>


                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    {{-- end tabel --}}

                </div>
            </div>
        </div>
        {{-- end pilar --}}

        {{--  kegiatan --}}
        <div class="col col-md-8 col-sm-12 intro-daftar-program-table">
            <div class="card ijo-atas">
                <b class="d-flex justify-content-center mt-3 ">Daftar Sub Program </b>

                {{-- nama kegiatan --}}
                @if ($kegiatans != null)
                    <span class="d-flex justify-content-center ">({{ $pilar }})</span>
                @endif
                {{-- end nama kegiatan --}}

                <div class="card-body ">

                    {{-- info --}}
                    @if ($kegiatans == null)
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-info-circle"></i> Pilih program terlebih dahulu
                            </div>
                        </div>
                    @endif
                    {{-- end info --}}

                    {{-- alert --}}
                    @if (session()->has('alert_kegiatan'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="far fa-check-circle"></i> {{ session('alert_kegiatan') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{-- alert --}}
                    @if (session()->has('alert_danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="far fa-check-circle"></i> {{ session('alert_danger') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {{-- end alert --}}

                    {{-- tabel --}}
                    @if ($kegiatans != null)
                        {{-- jika tabel kosong --}}
                        @forelse($kegiatans as $object)
                        @empty
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-info-circle"></i> Program {{ $pilar }} belum memiliki
                                    sub program
                                </div>
                            </div>
                        @endforelse
                        <table class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10px;vertical-align:middle;">No Urut</th>
                                    <th class="align-middle">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div> Nama Sub Program</div>

                                            <div class="d-flex  align-items-center">
                                                {{-- search --}}
                                                <div class="col-8 input-group ">
                                                    <input wire:model="cari" type="search"
                                                        class="form-control form-control-sm" placeholder="Cari"
                                                        value="">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm btn-default noClick">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                {{-- end search --}}

                                                {{-- tombol tambah --}}
                                                <button class="col-4 btn btn-sm btn-success float-right"
                                                    data-toggle="modal" wire:click="modal_kegiatan_tambah"
                                                    data-target="#modal_kegiatan_tambah" type="button"><i
                                                        class="fas fa-plus-circle"></i>
                                                    Tambah</button>
                                                {{-- end tombol tambah --}}
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kegiatans as $object)
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center"> Data tidak ditemukan</td>
                                    </tr>
                                @endforelse
                                @foreach ($kegiatans as $a)
                                    <tr @if ($sub_program_id == $a->sub_program_id) style="background-color:#ECECEC;" @endif>
                                        <td>{{ $a->no_urut }}</td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div> {{ $a->sub_program }}</div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    {{-- tombol ubah --}}
                                                    <a wire:click="modal_kegiatan_ubah('{{ $a->sub_program_id }}','{{ $a->sub_program }}','{{ $a->no_urut }}')"
                                                        data-toggle="modal" data-target="#modal_kegiatan_ubah"
                                                        type="button" class="mr-2"><i class="fas fa-edit"
                                                            style="color: blue;"></i></a>
                                                    {{-- end tombol ubah --}}
                                                    {{-- tombol hapus --}}
                                                    <a wire:click="modal_kegiatan_hapus('{{ $a->sub_program_id }}','{{ $a->sub_program }}')"
                                                        data-toggle="modal" data-target="#modal_kegiatan_hapus"
                                                        type="button" class="mr-3"><i class="fas fa-trash"
                                                            style="color: red;"></i></a>
                                                    {{-- end tombol hapus --}}


                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="float-right mt-1">
                            <small>
                                {{-- pagination --}}
                                {{ $kegiatans->links() }}
                            </small>
                        </div>
                    @endif
                    {{-- end tabel --}}

                </div>
            </div>
        </div>
        {{-- end card kegiatan --}}
    </div>


    {{-- kegiatan --}}
    @include('modal.modal_kegiatan_tambah')
    @include('modal.modal_kegiatan_ubah')
    @include('modal.modal_kegiatan_hapus')

</div>
