<?php

namespace App\Imports;

use App\Models\Mustahik;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class PermohonanMustahikImport implements ToCollection, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            Mustahik::create([
                'mustahik_id' => Str::uuid()->toString(),
                'tgl_realisasi' => $row[0],
                'nama_mustahik' => $row[1],
                'nohp' => $row[2],
                'tgl_lahir' => $row[3],
                'nkk' => $row[4],
                'nik' => $row[5],
                'alamat' => $row[6],
                'jumlah_kk' => $row[7],
                'jumlah_jiwa' => $row[8],
                'jenis_bantuan' => $row[9],
                'nominal_bantuan' => $row[10],
                'keterangan' => $row[11],
            ]);
        }
    }

    public function startRow(): int
    {
        return 9;
    }
}
