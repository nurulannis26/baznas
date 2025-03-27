<div class="card mt-3 ml-2 mr-2">
    <div class="card-body">
        @php
            $dp = App\Models\Permohonan::where('permohonan_id', $data_detail->permohonan_id)->first();
        @endphp

    @if ($dp->permohonan_status_input == 'Selesai Input')
    <sup class="text-light badge badge-success">Pengajuan Selesai diinput FO</sup>
    @else
    <sup class="text-light badge badge-warning">Pengajuan Blm Selesai diinput FO</sup>
    @endif
    
    @if ($dp->permohonan_status_input == 'Selesai Input')
    @if ($dp->permohonan_status_atasan == 'Diterima')
    <sup class="text-light badge badge-success">Sudah Disetujui Atasan</sup>
    @elseif ($dp->permohonan_status_atasan == 'Ditolak')
    <sup class="text-light badge badge-danger">Ditolak Atasan</sup>
    @else
    <sup class="text-light badge badge-warning">Blm Direspon Atasan</sup>
    @endif
    @endif

    @if ($dp->permohonan_status_atasan == 'Diterima')
    @if ($dp->survey_status == 'Selesai')
    <sup class="text-light badge badge-success">Sudah Survey</sup>
    @else
    <sup class="text-light badge badge-warning">Blm Survey</sup>
    @endif
    @endif

    @if ($dp->permohonan_status_atasan == 'Diterima')
    @if ($dp->pencairan_status == 'Berhasil Dicairkan')
    <sup class="text-light badge badge-success">Sudah Dicairkan</sup>
    @elseif ($dp->pencairan_status == 'Ditolak')
    <sup class="text-light badge badge-danger">Pencairan Ditolak</sup>
    @else
    <sup class="text-light badge badge-warning">Blm Dicairkan</sup>
    @endif
    @endif

    <br>
        <span>
            <i class="fas fa-info-circle"></i>
            Data permohonan, penerima manfaat & lampiran diinput oleh Front Office.
        </span>
        </div>
    </div>