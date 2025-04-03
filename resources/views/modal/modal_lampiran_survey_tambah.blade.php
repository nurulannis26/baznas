@if (Auth::user()->pengurus_id != null)
    {{--  tambah program_penguatan_kelembagaan --}}
    <div wire:ignore.self class="modal fade " id="modal_lampiran_survey_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 class="modal-title"> TAMBAH LAMPIRAN
                    </h5>
                    <div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <form wire:submit.prevent="lampiran_survey_tambah">

                    <div class="modal-body">
                        <div class="form-row">
                            
                            <div class="form-group col-md-6">
                                <label>JUDUL &nbsp;</label>
                                <input wire:model="keterangan_lampiran_survey" type="text" class="form-control"
                                    placeholder="Masukan judul">
                            </div>
                            <hr>
                            <div class="form-group col-md-6">
                                <label for="inputHP">FILE LAMPIRAN</label>
                                <div class="custom-file custom-file-surat">
                                    <input type="file" wire:model="url_survey"
                                        accept="application/pdf, image/png, image/jpg, image/jpeg"
                                        class="custom-file-input" id="file" name="file">
                                    <label class="custom-file-label" for="customFile">Pilih file</label>
                                </div>
                            </div>
                        </div>
                    </div>




                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="fas fa-ban"></i>
                        Batal</button>

                    {{-- @if ($url == '')
                        <button class="btn btn-success" disabled wire:loading.attr="disabled"><i
                                class="fas fa-save"></i>
                            Simpan</button>
                    @else --}}
                        <button type="submit" name="submit" class="btn btn-success"
                            wire:loading.attr="disabled"><i class="fas fa-save"></i>
                            Simpan</button>
                    {{-- @endif --}}
                </div>
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
