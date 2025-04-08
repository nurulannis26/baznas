@if (Auth::user()->pengurus_id != null)
    {{--  tambah program_penguatan_kelembagaan --}}
    <div wire:ignore.self class="modal fade " id="modal_mustahik_tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title"> TAMBAH MUSTAHIK
                    </h5>
                    <div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form wire:submit.prevent="tambah_mustahik">

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>NAMA &nbsp;</label>
                                <input wire:model="nama" type="text" class="form-control" placeholder="Masukan Nama">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>TGL INPUT &nbsp;</label>
                                <input value="{{ date('Y-m-d') }}" type="date" class="form-control" readonly>
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>NO NIK &nbsp;</label>
                                <input wire:model="nik" type="text" class="form-control" placeholder="Masukan NIK">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>NO KK &nbsp;</label>
                                <input wire:model="kk" type="text" class="form-control" placeholder="Masukan KK">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>TEMPAT LAHIR &nbsp;</label>
                                <input wire:model="tempat_lahir" type="text" class="form-control"
                                    placeholder="Masukan tempat lahir">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>TGL LAHIR &nbsp;</label>
                                <input wire:model="tgl_lahir" type="date" class="form-control">
                            </div>
                            <hr>
                            <div class="form-group col-md-12">
                                <label>ALAMAT &nbsp;</label>
                                <input wire:model="alamat_mustahik" type="text" class="form-control"
                                    placeholder="Masukan alamat">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>NO HP &nbsp;</label>
                                <input wire:model="nohp_mustahik" type="text" class="form-control"
                                    placeholder="Masukan nomor hp">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>EMAIL &nbsp;</label>
                                <input wire:model="email" type="text" class="form-control"
                                    placeholder="Masukan email">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputNama">JENIS KELAMIN &nbsp;</label>
                                <select wire:model="jenis_kelamin" class=" form-control ">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <hr>
                            <div class="form-group col-md-6 modal-tambah-asnaf-pilar">
                                <label for="inputNama">ASNAF &nbsp;</label>
                                <select wire:model="asnaf" class=" form-control ">
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
                            <div class="form-group col-md-3">
                                <label>RT &nbsp;</label>
                                <input wire:model="rt" type="text" class="form-control" placeholder="Masukan rt">
                            </div>
                            <hr>
                            <div class="form-group col-md-3">
                                <label>RW &nbsp;</label>
                                <input wire:model="rw" type="text" class="form-control" placeholder="Masukan rw">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputHP">FILE FOTO DIRI</label>
                                <div class="custom-file custom-file-foto">
                                    <input type="file" wire:model="foto_url"
                                        accept="application/pdf, image/png, image/jpg, image/jpeg"
                                        class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputHP">FILE KTP</label>
                                <div class="custom-file custom-file-ktp">
                                    <input type="file" wire:model="ktp_url"
                                        accept="application/pdf, image/png, image/jpg, image/jpeg"
                                        class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputHP">FILE KK</label>
                                <div class="custom-file custom-file-kk">
                                    <input type="file" wire:model="kk_url"
                                        accept="application/pdf, image/png, image/jpg, image/jpeg"
                                        class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-ban"></i>
                            Batal</button>

                        @if ($nama == '' or $alamat == '' or $nohp == '')
                            <button class="btn btn-success" disabled wire:loading.attr="disabled"><i
                                    class="fas fa-save"></i>
                                Simpan</button>
                        @else
                            <button type="submit" name="submit" class="btn btn-success"
                                wire:loading.attr="disabled"><i class="fas fa-save"></i>
                                Simpan</button>
                        @endif
                    </div>


                </form>

            </div>
        </div>
        {{-- end tabbed --}}

        {{-- form --}}

        {{-- end form --}}

        @push('script')
            <script>
                $(document).ready(function() {

                    window.loadContactDeviceSelect2 = () => {
                        bsCustomFileInput.init();
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
