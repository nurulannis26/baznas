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
                                <input wire:model="nama_mustahik" type="text" class="form-control" placeholder="Masukan Nama">
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
                                <input wire:model="nkk" type="text" class="form-control" placeholder="Masukan No KK">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>NO HP &nbsp;</label>
                                <input wire:model="nohp_mustahik" type="text" class="form-control"
                                    placeholder="Masukan nomor hp">
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
                                <label>JUMLAH KK &nbsp;</label>
                                <input wire:model="jumlah_kk" type="text" class="form-control" placeholder="Masukan jumlah KK">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>JUMLAH JIWA &nbsp;</label>
                                <input wire:model="jumlah_jiwa" type="text" class="form-control" placeholder="Masukan jumlah jiwa">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>JENIS BANTUAN &nbsp;</label>
                                <input wire:model="jenis_bantuan" type="text" class="form-control" placeholder="Masukan jenis bantuan">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>NOMINAL BANTUAN &nbsp;</label>
                                <input wire:model="nominal_bantuan" type="text" class="form-control" placeholder="Masukan nominal bantuan">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>TGL REALISASI &nbsp;</label>
                                <input wire:model="tgl_realisasi" type="date" class="form-control">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label>KETERANGAN &nbsp;</label>
                                <input wire:model="keterangan" type="date" class="form-control" placeholder="Masukan keterangan">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-ban"></i>
                            Batal</button>

                        @if ($nama_mustahik == '' or $alamat == '' or $nohp == '')
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
