@if (Auth::user()->pengurus_id != null)
    {{--  tambah program_penguatan_kelembagaan --}}
    <div wire:ignore.self class="modal fade " id="modal_tambah_pengurus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title"> TAMBAH PENGURUS
                    </h5>
                    <div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form wire:submit.prevent="tambah_pengurus">

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>NAMA &nbsp;</label><input wire:model="nama_pengurus" type="text" class="form-control"
                                    placeholder="Masukan Nama">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputNama">JENIS KELAMIN &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                <select wire:model="jenis_kelamin_pengurus" class="select2dulus form-control ">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>

                                </select>
                            </div>
                            <hr>

                            <div class="form-group col-md-6">
                                <label for="inputNama">NOMOR HP &nbsp;</label>
                                <input wire:model="nohp_pengurus" type="text" class="form-control" placeholder="Masukan Nomor HP">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputNama">EMAIL &nbsp;</label>
                                <input wire:model="email_pengurus" type="text" class="form-control" placeholder="Masukan Email">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>NIK &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="nik_pengurus" type="text" class="form-control"
                                    placeholder="Masukkan NIK">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>KK &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="kk_pengurus" type="text" class="form-control"
                                    placeholder="Masukkan KK">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>TEMPAT LAHIR &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgb(0, 187, 31)">Optional</sup> --}}
                                <input wire:model="tgl_lahir_pengurus" type="text" class="form-control"
                                    placeholder="Masukkan Tempat Lahir">
                            </div>
                            <hr>
                            <div class="form-group col-md-12">
                                <label>ALAMAT &nbsp;</label>
                                <input wire:model="alamat_pengurus" type="text" class="form-control" placeholder="Masukkan Alamat">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputHP">FILE SCAN SURAT</label>
                                <sup class="badge badge-danger text-white mb-2"
                                    style="background-color:rgba(230,82,82)">WAJIB
                                    (PDF/JPG/JPEG/PNG)</sup>
                                <div class="custom-file custom-file-surat">
                                    <input type="file" wire:model="surat_url"
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
                                    <select wire:model="asnaf_id" class=" form-control ">
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
                                <select wire:model="program_id" id="id_program_pilars"
                                    class="select2dulur form-control pilar">
                                    <option value="">Pilih Program</option>
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
                                <select  class="form-control" id="select2Permohonan" wire:model="selectedProgram"
                                    data-placeholder="Pilih Program Terlebih Dahulu">

                                    @if ($program_id == '')
                                        <option value="" disabled>Pilih Pilar Terlebih Dahulu</option>
                                    @else
                                        @foreach ($daftar_kegiatan as $aa)
                                            <option value="{{ $aa->sub_program_id }}">{{ $aa->no_urut }}
                                                {{ $aa->sub_program }}</option>
                                        @endforeach
                                        @foreach ($daftar_kegiatan2 as $bb)
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

                                    <input type="text" wire:model="permohonan_nominal" id="nominal_permohonan"
                                        class="form-control" placeholder="Masukan nominal">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputNama">BENTUK BANTUAN &nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                <select wire:model="permohonan_bentuk_bantuan" class="select2dulus form-control ">
                                    <option value="">Pilih Bentuk Bantuan</option>
                                    <option value="Uang Tunai">Uang Tunai</option>
                                    <option value="Barang">Barang</option>

                                </select>
                            </div>
                            <hr>
                            <div class="form-group col-md-12">
                                <label for="inputAlamat">CATATAN TAMBAHAN&nbsp;</label>
                                {{-- <sup class="badge badge-danger text-white mb-2" style="background-color:rgba(230,82,82)">WAJIB</sup> --}}
                                <textarea type="text" class="form-control" wire:model="permohonan_catatan_input"
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fas fa-ban"></i>
                        Batal</button>

                    @if ($permohonan_nominal == '' or $permohonan_bentuk_bantuan == '' or $permohonan_jenis == '')
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
