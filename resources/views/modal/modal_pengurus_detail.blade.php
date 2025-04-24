<div class="modal fade" id="modal_pengurus_detail{{ $p->pengguna_id }}" tabindex="-1" role="dialog" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Profil Pengurus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {{-- Bagian Profil Pengguna --}}
                <div class="border p-3 mb-3 mt-2">
                    <div class="row">
                        <div class="col-md-3 text-center mt-2">
                            {{-- Placeholder jika foto tidak ada --}}
                            <div class="d-flex align-items-center justify-content-center"
                                style="width: 150px; height: 150px;">
                                @if ($p->foto_url)
                                    <img src="{{ asset('uploads/foto_pengguna/' . $p->foto_url) }}" alt="Avatar"
                                        style="width: 150px; height: 160px; object-fit: cover; border-radius:10%">
                                @else
                                    <img src="{{ asset('images/profil.png') }}" alt="Avatar"
                                        style="width: 150px; height: 160px; object-fit: cover; border-radius:10%">
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-center"
                                style="width: 150px; height: 150px;">
                                @if ($p->ttd_url)
                                    <img src="{{ asset('uploads/ttd_pengguna/' . $p->ttd_url) }}" alt="Avatar"
                                        style=" width: 150px; height: 120px; object-fit: cover; border-radius:10%">
                                @else
                                    <img src="{{ asset('images/ttd.jpg') }}" alt="Avatar"
                                        style="opacity: 0.3; width: 150px; height: 120px; object-fit: cover; border-radius:10%">
                                @endif
                            </div>
                            {{-- @endif --}}
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <span class="col-sm-6 mt-1">
                                    <span class="font-weight-bold">Nama</span><br> {{ $p->nama }}
                                </span>
                                <span class="col-sm-6 ">
                                    <span class="font-weight-bold">No HP</span><br> {{ $p->nohp }}
                                </span>
                                <span class="col-sm-6 mt-2">
                                    <span class="font-weight-bold">Email</span><br> {{ $p->email }}
                                </span>
                                <span class="col-sm-6 mt-2">
                                    <span class="font-weight-bold">NIK</span><br> {{ $p->nik }}
                                </span>
                                <span class="col-sm-6 mt-2">
                                    <span class="font-weight-bold">Jenis Kelamin</span><br> {{ $p->jenis_kelamin }}
                                </span>
                                <span class="col-sm-6 mt-2">
                                    <span class="font-weight-bold">Tempat, Tanggal Lahir</span><br>
                                    {{ $p->tempat_lahir }},
                                    {{ \Carbon\Carbon::parse($p->tgl_lahir)->translatedFormat('d F Y') }}
                                </span>
                                <span class="col-sm-12 mt-2">
                                    <span class="font-weight-bold">Alamat</span><br> {{ $p->alamat }}
                                </span>
                            </div>

                            {{-- <button  data-toggle="modal"
                                data-target="#modal_pengurus_detaill{{ $p->pengguna_id }}"
                                class="btn btn-outline-secondary btn-sm" style="cursor: pointer">
                                <i class="fa fa-edit"></i> Edit
                            </button> --}}

                            {{-- <button class="btn btn btn-success btn-block tombol-tambah" data-toggle="modal"
                            data-target="#modal_pengurus_detaill{{ $p->pengguna_id }}" type="button"><i class="fas fa-plus-circle"></i>
                            Edit</button> --}}


                        </div>
                    </div>
                </div>

                <table class="table table-bordered" style="font-size: 13px;">
                    <tr style="line-height: 2;">
                        <th style="width: 30%; padding: 4px; font-size: 11pt;">Jabatan</th>
                        <th style="width: 20%; padding: 4px; font-size: 11pt;">Tgl Mulai</th>
                        <th style="width: 20%; padding: 4px; font-size: 11pt;">Tgl Selesai</th>
                    </tr>
                    <tr style="line-height: 2;">
                        <td style="padding: 4px; font-size: 11pt;">{{ $p->pengurus->jabatan->jabatan ?? '-' }}</td>
                        <td style="padding: 4px; font-size: 11pt;">
                            {{ \Carbon\Carbon::parse($p->pengurus->tgl_mulai)->format('d-m-Y') }}</td>
                        <td style="padding: 4px; font-size: 11pt;">
                            {{ \Carbon\Carbon::parse($p->pengurus->tgl_selesai)->format('d-m-Y') }}</td>
                    </tr>
                    <tr style="line-height: 2;">
                        <th style="padding: 4px; font-size: 11pt;">Divisi</th>
                        <th style="padding: 4px; font-size: 11pt;">No SK</th>
                        <th style="padding: 4px; font-size: 11pt;">File SK</th>
                    </tr>
                    <tr style="line-height: 2;">
                        <td style="padding: 4px; font-size: 11pt;">{{ $p->pengurus->jabatan->divisi->divisi ?? '-' }}

                        </td>
                        <td style="padding: 4px; font-size: 11pt;">{{ $p->pengurus->sk_nomor ?? '-' }}</td>
                        <td style="padding: 4px; font-size: 11pt;"><a
                                href="{{ asset('uploads/sk/' . $p->pengurus->sk_url) }}" target="_blank"
                                rel="noopener noreferrer"> Lihat </a></td>
                    </tr>
                </table>
            </div>
            

        </div>
    </div>

    @include('modal.modal_pengurus_detaill')

    
</div>
