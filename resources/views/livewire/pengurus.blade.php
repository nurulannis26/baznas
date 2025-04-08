<div>
    <div class="row">
        <div class="col-12 col-md-2 col-sm-12 mb-2 mb-xl-0 intro-tambah-data-pengajuan-pc">
            <button class="btn btn btn-success btn-block tombol-tambah" data-toggle="modal"
                data-target="#modal_tambah_pengurus" type="button"><i class="fas fa-plus-circle"></i>
                Tambah</button>
        </div>
        <div class="col-12 col-md-2 col-sm-12 mb-2 mb-xl-0">
            <div class="btn-group btn-block ">
                <button type="button" class="btn btn-outline-success btn-block dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
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


    </div>

    <div class="row mt-3">
        <div class="table-responsive mt-2 p-2">
            <table class="table table-bordered table-hover" id="Pengurus" style="width:100%" wire:ignore>
                <thead>
                    <tr class="text-center">
                        <th style="vertical-align:middle;width: 5%;">No</th>
                        <th style="vertical-align:middle;width: 25%;">Nama</th>
                        <th style="vertical-align:middle;width: 15%;">Jabatan</th>
                        <th style="vertical-align:middle;width: 23%;">Bidang</th>
                        <th style="vertical-align:middle;width: 20%;">Alamat</th>
                        <th style="vertical-align:middle;width: 12%;">No HP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penggunas as $index => $p)
                        {{-- {{ dd($p->pengurus) }} --}}

                        <tr data-toggle="modal" data-target="#modal_pengurus_detail{{ $p->id }}"
                            style="cursor: pointer;" wire:ignore.self>

                            <td class="text-center align-middle">{{ $loop->iteration }}.</td>
                            <td>

                                <div class="d-flex align-items-center">
                                    {{-- Avatar lingkaran --}}
                                    <div class="rounded-circle bg-light text-center d-flex align-items-center justify-content-center me-2"
                                        style="width: 50px; height: 40px; font-weight: bold; color: #2E7D32; overflow: hidden;">
                                        @if ($p->foto_url)
                                            <img src="{{ $p->foto_url }}" alt="Foto"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <span>
                                                {{ strtoupper(substr($p->nama, 0, 1)) }}
                                                {{ strtoupper(substr(explode(' ', $p->nama)[1] ?? '', 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Nama + No SK --}}
                                    <div class="d-flex flex-column">
                                        <span class="font-weight-bold">{{ $p->nama }}</span>
                                        <span style="font-size: 11pt;">No SK: {{ $p->pengurus->sk_nomor }}</span>
                                    </div>
                                </div>
                            </td>

                            <td class="align-middle">{{ $p->pengurus->jabatan->jabatan ?? '-' }}</td>
                            <td class="align-middle">{{ $p->pengurus->jabatan->divisi->divisi ?? '-' }}</td>
                            <td class="align-middle">{{ $p->alamat }}</td>
                            <td class="align-middle">{{ $p->nohp }}</td>

                        </tr>
                        {{-- @include('modal.modal_pengurus_detail') --}}
                    @endforeach
                </tbody>
            </table>

            @foreach ($penggunas as $p)
                @include('modal.modal_pengurus_detail')
            @endforeach
        </div>
    </div>


@include('modal.modal_tambah_pengurus')
</div>

@push('script-permohonan')
    <script>
        $(document).ready(function() {
            $('#Pengurus').DataTable({
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
