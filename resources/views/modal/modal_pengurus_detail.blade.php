<div class="modal fade" id="modal_pengurus_detail{{ $p->id }}" tabindex="-1" role="dialog" aria-hidden="true"
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
                                <img src="{{ asset('images/profil.png') }}" alt="Avatar"
                                    style="width: 150px; height: 160px; object-fit: cover; border-radius:10%">

                            </div>
                            <div class="d-flex align-items-center justify-content-center"
                                style="width: 150px; height: 150px;">
                                <img src="{{ asset('images/ttd.jpg') }}" alt="Avatar"
                                    style="opacity: 0.3; width: 150px; height: 120px; object-fit: cover; border-radius:10%">

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
                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <button wire:click="" class="btn btn-outline-secondary btn-sm">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </div>
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
                        <td style="padding: 4px; font-size: 11pt;">{{ \Carbon\Carbon::parse($p->pengurus->tgl_mulai)->format('d-m-Y') }}</td>
                        <td style="padding: 4px; font-size: 11pt;">{{ \Carbon\Carbon::parse($p->pengurus->tgl_selesai)->format('d-m-Y') }}</td>
                    </tr>
                    <tr style="line-height: 2;">
                        <th style="padding: 4px; font-size: 11pt;">Divisi</th>
                        <th style="padding: 4px; font-size: 11pt;">No SK</th>
                        <th style="padding: 4px; font-size: 11pt;">File SK</th>
                    </tr>
                    <tr style="line-height: 2;">
                        <td style="padding: 4px; font-size: 11pt;">{{ $p->pengurus->jabatan->divisi->divisi ?? '-' }}</td>
                        <td style="padding: 4px; font-size: 11pt;">{{ $p->pengurus->sk_nomor ?? '-' }}</td>
                        <td style="padding: 4px; font-size: 11pt;"><a href="{{ asset('public/sk/' .  $p->pengurus->sk_url ) }}" target="_blank" rel="noopener noreferrer"> Lihat </a></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>
