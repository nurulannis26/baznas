<div wire:ignore.self class="modal fade" id="modal_edit_pengurus{{ $p->pengguna_id }}" tabindex="-1" role="dialog" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ubah Pengurus</h5>  
                <div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>             
            </div>

            <div class="modal-body">
                {{-- Bagian Profil Pengguna --}}
                <form wire:submit.prevent="ubah_pengurus">

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>NAMA &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                <input wire:model="nama_pengurus_edit" type="text"
                                    class="form-control" placeholder="Masukan Nama">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputNama">JENIS KELAMIN &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                <select wire:model="jenis_kelamin_pengurus_edit" class="select2dulus form-control ">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>

                                </select>
                            </div>
                            <hr>

                            <div class="form-group col-md-6">
                                <label for="inputNama">NOMOR HP &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                <input wire:model="nohp_pengurus_edit" type="text" class="form-control"
                                    placeholder="Masukan Nomor HP">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputNama">EMAIL &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                <input wire:model="email_pengurus_edit" type="text" class="form-control"
                                    placeholder="Masukan Email">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>NIK &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="nik_pengurus_edit" type="text" class="form-control"
                                    placeholder="Masukkan NIK">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>KK &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="kk_pengurus_edit" type="text" class="form-control"
                                    placeholder="Masukkan KK">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>TEMPAT LAHIR &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="tempat_lahir_pengurus_edit" type="text" class="form-control"
                                    placeholder="Masukkan Tempat Lahir">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>TGL LAHIR &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="tgl_lahir_pengurus_edit" type="date" class="form-control"
                                    placeholder="Masukkan Tgl Lahir">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>ALAMAT &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                <input wire:model="alamat_pengurus_edit" type="text" class="form-control"
                                    placeholder="Masukkan Alamat">
                            </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label>RT &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                <input wire:model="rt_pengurus_edit" type="text" class="form-control"
                                    placeholder="Masukkan Alamat">
                            </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label>RW &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                <input wire:model="rw_pengurus_edit" type="text" class="form-control"
                                    placeholder="Masukkan Alamat">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputHP">FOTO DIRI</label>
                                <div class="custom-file custom-file-surat">
                                    <input type="file" wire:model="foto_url_edit"
                                        accept="application/pdf, image/png, image/jpg, image/jpeg"
                                        class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputHP">TTD</label>
                                <div class="custom-file custom-file-surat">
                                    <input type="file" wire:model="ttd_url_edit"
                                        accept="application/pdf, image/png, image/jpg, image/jpeg"
                                        class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                            <hr style="width: 100%; border: none; border-top: 1px solid #797b7d; margin: 10px 0;">
                            <hr>

                            <div class="form-group col-md-6">
                                <label for="inputNama">DIVISI &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                @php
                                    $divisi = DB::table('divisi')->get();
                                @endphp
                                <select wire:model="divisi_id_edit" class="select2dulus form-control ">
                                    <option value="">Pilih Divisi</option>
                                    @foreach ($divisi as $d)
                                        <option value="{{ $d->divisi_id }}">{{ $d->divisi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputNama">JABATAN &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                @php
                                    $jabatan = DB::table('jabatan')->get();
                                @endphp
                                <select wire:model="jabatan_id_edit" class="select2dulus form-control ">
                                    <option value="">Pilih Jabatan</option>
                                    @foreach ($jabatan as $d)
                                        <option value="{{ $d->jabatan_id }}">{{ $d->jabatan }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label>TGL MULAI &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="tgl_mulai_edit" type="date" class="form-control"
                                    placeholder="Masukkan Tgl Mulai">
                            </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label>TGL SELESAI &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="tgl_selesai_edit" type="date" class="form-control"
                                    placeholder="Masukkan Tgl Selesai">
                            </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label>SK NOMOR &nbsp;</label><span style="color:rgba(230, 82, 82)">*</span>
                                <input wire:model="sk_nomor_edit" type="text" class="form-control"
                                    placeholder="Masukkan Nomor SK">
                            </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label for="inputHP">FILE SK</label>
                                <div class="custom-file custom-file-surat">
                                    <input type="file" wire:model="sk_url_edit"
                                        accept="application/pdf, image/png, image/jpg, image/jpeg"
                                        class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>




                        </div>
                        
                        {{-- info --}}
                            <div class="card card-body" style="background-color:#cbf2d6;">
                                <b>INFORMASI!</b>
                                <span>
                                    Jika ada tanda ( <span style="color:rgba(230, 82, 82)">*</span> ) menunjukkan kolom harus diisi.
                                </span>
                            </div>
                            {{-- end info --}}
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-ban"></i>
                            Batal</button>

                        {{-- @if ($permohonan_nominal == '' or $permohonan_bentuk_bantuan == '' or $permohonan_jenis == '')
                            <button class="btn btn-success" disabled wire:loading.attr="disabled"><i
                                    class="fas fa-save"></i>
                                Simpan</button>
                        @else --}}
                        <button type="submit" name="submit" class="btn btn-success"
                            wire:loading.attr="disabled"><i class="fas fa-save"></i>
                            Simpan</button>
                        {{-- @endif --}}
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
