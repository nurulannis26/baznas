@if (Auth::user()->pengurus_id != null)
    {{--  tambah program_penguatan_kelembagaan --}}
    <div wire:ignore.self class="modal fade " id="modal_permohonan_ubah" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title"> UBAH PERMOHONAN
                    </h5>
                    <div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form wire:submit.prevent="ubah_permohonan">

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputNama">JENIS PERMOHONAN &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                <select wire:model="permohonan_jenis_edit" class="select2dulus form-control ">
                                    <option value="">Pilih Jenis Permohonan</option>
                                    <option value="Individu">INDIVIDU</option>
                                    <option value="UPZ">UPZ</option>

                                </select>
                            </div>
                            <hr>

                            <div class="form-group col-md-6">
                                <label for="inputNama">NOMOR PERMOHONAN &nbsp;</label>
                                <input wire:model="permohonan_nomor_edit" type="text" class="form-control" readonly>
                            </div>
                            @if ($this->permohonan_jenis_edit == 'Individu')
                                {{-- pemohon --}}
                                <div class="form-group col-md-6">
                                    <label>NAMA PEMOHON &nbsp;</label>
                                    {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                    <input wire:model="permohonan_nama_pemohon_edit" type="text" class="form-control"
                                        placeholder="Masukan Nama Pemohon">
                                </div>
                                <hr>
                                {{-- end pemohon --}}

                                {{-- nohp --}}
                                <div class="form-group col-md-6 ">
                                    <label>NO HP PEMOHON &nbsp;</label>

                                    {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                    <input wire:model="permohonan_nohp_pemohon_edit" id="permohonan_nohp_pemohon"
                                        type="text" class="form-control" placeholder="Masukan No HP Pemohon"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                </div>
                                <hr>
                                {{-- end nohp --}}
                                <div class="form-group col-md-12">
                                    <label>ALAMAT PEMOHON &nbsp;</label>
                                    {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                    <input wire:model="permohonan_alamat_pemohon_edit" type="text"
                                        class="form-control" placeholder="Masukan Alamat Pemohon">
                                </div>
                            @elseif($this->permohonan_jenis_edit == 'UPZ')
                                <div class="form-group col-md-6">
                                    <label>NAMA UPZ &nbsp;</label>
                                    {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                    <input wire:model="upz_edit" type="text" class="form-control"
                                        placeholder="Masukan Nama UPZ">
                                </div>
                                <hr>
                                <div class="form-group col-md-6 ">
                                    <label>NO HP UPZ &nbsp;</label>

                                    {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                    <input wire:model="nohp_edit" id="nohp" type="text" class="form-control"
                                        placeholder="Masukan No HP UPZ"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                </div>
                                <hr>
                                <div class="form-group col-md-12">
                                    <label>ALAMAT UPZ &nbsp;</label>
                                    {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                    <input wire:model="alamat_edit" type="text" class="form-control"
                                        placeholder="Masukan Alamat UPZ">
                                </div>
                                <hr>
                                <div class="form-group col-md-6">
                                    <label>NAMA PJ &nbsp;</label>
                                    {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                    <input wire:model="pj_nama_edit" type="text" class="form-control"
                                        placeholder="Masukan Nama PJ Permohonan">
                                </div>
                                <hr>
                                <div class="form-group col-md-6">
                                    <label>JABATAN &nbsp;</label>
                                    {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                    <input wire:model="pj_jabatan_edit" type="text" class="form-control"
                                        placeholder="Masukan Jabatan PJ">
                                </div>
                                <hr>
                            @endif
                            <hr style="width: 100%; border: none; border-top: 1px solid #797b7d; margin: 10px 0;">

                            <div class="form-group col-md-6">
                                <label>JUDUL SURAT &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="surat_judul_edit" type="text" class="form-control"
                                    placeholder="Masukkan Judul Surat">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>NOMOR SURAT &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="surat_nomor_edit" type="text" class="form-control"
                                    placeholder="Masukkan Nomor Surat">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>TGL SURAT &nbsp;</label>
                                <input wire:model="surat_tgl_edit" type="date" class="form-control">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputHP">FILE SCAN SURAT</label>
                                <sup class="badge badge-danger text-white mb-2"
                                    style="background-color:rgba(230,82,82)">WAJIB
                                    (PDF/JPG/JPEG/PNG)</sup>
                                <div class="custom-file custom-file-surat">
                                    <input type="file" wire:model="surat_url_edit"
                                        accept="application/pdf, image/png, image/jpg, image/jpeg"
                                        class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>

                            <hr style="width: 100%; border: none; border-top: 1px solid #797b7d; margin: 10px 0;">
                            <hr>
                            <div class="form-group col-md-6 modal-tambah-asnaf-pilar">
                                <label for="inputNama">ASNAF &nbsp;</label>
                                <sup class="badge badge-danger text-white mb-2"
                                    style="background-color:rgb(0, 187, 31)">Optional</sup>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                <select wire:model="asnaf_id_edit" class=" form-control ">
                                    <option value="">Pilih Asnaf</option>
                                    @php
                                        $asnaf_get = DB::table('asnaf')->get();
                                    @endphp
                                    @foreach ($asnaf_get as $as)
                                        <option value="{{ $as->asnaf_id }}">{{ $as->asnaf }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputNama">PROGRAM &nbsp;</label>
                                <sup class="badge badge-danger text-white mb-2"
                                    style="background-color:rgb(0, 187, 31)">Optional</sup>
                                <select wire:model="program_id_edit" id="id_program_pilars"
                                    class="select2dulur form-control pilar">
                                    <option value="">Pilih Program</option>
                                    @php
                                        $daftar_program = DB::table('program')->get();
                                    @endphp
                                    @foreach ($daftar_program as $a)
                                        <option value="{{ $a->program_id }}">{{ $a->program }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            {{-- end pilar --}}

                            <hr>
                            {{-- kegiatan --}}
                            <div class="form-group col-md-12">
                                <label for="inputNama">SUB PROGRAM &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white  mb-2"
                              style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                <select class="form-control" id="select2Permohonan" wire:model="sub_program_id_edit"
                                    data-placeholder="Pilih Program Terlebih Dahulu">
                                    @php
                                           $daftar_kegiatan_edit = App\Models\SubProgram::where('program_id', $this->program_id_edit)
                                               ->whereRaw('LENGTH(no_urut) = 3')
                                               ->orderBy('no_urut', 'ASC')
                                               ->get();

                                           $daftar_kegiatan2_edit = App\Models\SubProgram::where('program_id', $this->program_id_edit)
                                               ->whereRaw('LENGTH(no_urut) = 4')
                                               ->orderBy('no_urut', 'ASC')
                                               ->get();
                                       @endphp
                                    @if ($program_id_edit == '')
                                        <option value="" disabled>Pilih Pilar Terlebih Dahulu</option>
                                    @else
                                        @foreach ($daftar_kegiatan_edit as $aa)
                                            <option value="{{ $aa->sub_program_id }}">{{ $aa->no_urut }}
                                                {{ $aa->sub_program }}</option>
                                        @endforeach
                                        @foreach ($daftar_kegiatan2_edit as $bb)
                                            <option value="{{ $bb->sub_program_id }}">{{ $bb->no_urut }}
                                                {{ $bb->sub_program }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputNama">NOMINAL PERMOHONAN &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bor-abu">Rp</span>
                                    </div>

                                    <input type="text" wire:model="permohonan_nominal_edit"
                                        id="nominal_permohonan" class="form-control" placeholder="Masukan nominal">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputNama">BENTUK BANTUAN &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                <select wire:model="permohonan_bentuk_bantuan_edit"
                                    class="select2dulus form-control ">
                                    <option value="">Pilih Bentuk Bantuan</option>
                                    <option value="Uang Tunai">Uang Tunai</option>
                                    <option value="Barang">Barang</option>

                                </select>
                            </div>
                            <hr>
                            <div class="form-group col-md-12">
                                <label for="inputAlamat">CATATAN TAMBAHAN&nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                <textarea type="text" class="form-control" wire:model="permohonan_catatan_input_edit"
                                    placeholder="Masukan Keterangan / Perihal" rows="4"> </textarea>

                            </div>




                            {{-- info --}}
                            <div class="card card-body" style="background-color:#cbf2d6;">
                                <b>INFORMASI!</b>
                                <span>
                                    Setelah simpan data, lengkapi data penerima manfaat, dan data lampiran pendukung
                                    lainnya.
                                </span>
                            </div>
                            {{-- end info --}}



                        </div>
                    </div>




                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i>
                        Batal</button>

                    @if ($permohonan_nominal_edit == '' or $permohonan_bentuk_bantuan_edit == '' or $permohonan_jenis_edit == '')
                        <button class="btn btn-success" disabled wire:loading.attr="disabled"><i
                                class="fas fa-save"></i>
                            Simpan</button>
                    @else
                        <button type="submit" name="submit" class="btn btn-success"
                            wire:loading.attr="disabled"><i class="fas fa-save"></i>
                            Simpan</button>
                    @endif
                </div>
            </div>
        </div>
        {{-- end tabbed --}}

        {{-- form --}}

        {{-- end form --}}

        @push('script')
            <script>
                $(document).ready(function() {
                    // Menginisialisasi Select2 setelah halaman dimuat sepenuhnya
                    $('#select2Permohonan').select2();
                });
            </script>

            <script>
                $(document).ready(function() {

                    window.loadContactDeviceSelect2 = () => {
                        bsCustomFileInput.init();
                        $('#select2Permohonan').select2();
                        $('#nominal_permohonan').on('input', function(e) {
                            $('#nominal_permohonan').val(formatRupiah($('#nominal_permohonan').val(),
                                'Rp. '));
                        });
                    }

                    loadContactDeviceSelect2();
                    window.livewire.on('loadContactDeviceSelect2', () => {
                        loadContactDeviceSelect2();
                    });

                });
            </script>
        @endpush

    </div>
@endif
