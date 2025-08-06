<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PermohonanMustahikImport;
use App\Models\Mustahik;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ImportMustahikController extends Controller
{
     public function import_mustahik($permohonan_id)
    {
        $data = Permohonan::where('permohonan_id', $permohonan_id)->first();

        return view('import.import_mustahik', compact('data'));
    }

    public function import_excel_mustahik(Request $request)
    {
        // dd('dw');
        if ($request->file('file_penerima')) {
            if (preg_match('/\.(php\d?|phtml|phar|php56|php7)(\.|\z)/', $request->file('file_penerima')->getClientOriginalName())) {
                // Alert::error('Error', 'Upload File Sesuai Extensi');
                // return back();
                $notification = array(
                    'message' => 'Upload File Sesuai Extensi !',
                    'alert-type' => 'error'
                );
                return redirect()->route('import_mustahik')->with($notification);
            }
        }

        // validasi
        $this->validate($request, [
            'file_penerima' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file_penerima');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_import_mustahik', $nama_file);

        // import data
        $import = new PermohonanMustahikImport();
        $rows = Excel::toCollection($import, public_path('/file_import_mustahik/' . $nama_file));

        $data = $request->permohonan_id;
        // tampilkan preview
        return view('import.preview_import_mustahik', compact('rows', 'nama_file', 'data'));
    }

    public function save(Request $request)
    {
        $nama_file = $request->input('nama_file');

        // Import data
        $import = new PermohonanMustahikImport();
        $rows = Excel::toCollection($import, public_path('/file_import_mustahik/' . $nama_file))->first();

        // Simpan data ke database
        foreach ($rows->toArray() as $row) {
            // Cek apakah baris kosong
            if (empty(array_filter($row))) {
                // Lewatkan baris kosong
                continue;
            }

            $tanggalExcel = $row[0];
            $tanggalExcel1 = $row[3];
            if (is_numeric($tanggalExcel) && is_numeric($tanggalExcel1)) {
                // Jika formatnya numeric (serial number)
                $excelSerialDate = $tanggalExcel;
                $baseDate = Carbon::createFromDate(1900, 1, 1);
                $tanggalBantuan = $baseDate->addDays($excelSerialDate - 2)->format('Y-m-d');
                $excelSerialDate1 = $tanggalExcel1;
                $baseDate1 = Carbon::createFromDate(1900, 1, 1);
                $tanggalLahir = $baseDate1->addDays($excelSerialDate1 - 2)->format('Y-m-d');

                if (Auth::user()->pengurus_id) {
                    Mustahik::create([
                        'mustahik_id' => Str::uuid()->toString(),
                        'permohonan_id' => $request->permohonan_id,
                        'tgl_realisasi' => $tanggalBantuan,
                        'nama_mustahik' => $row[1],
                        'nohp' => $row[2],
                        'tgl_lahir' =>  $tanggalLahir,
                        'nkk' => $row[4],
                        'nik' => $row[5],
                        'alamat' => $row[6],
                        'jumlah_kk' => $row[7],
                        'jumlah_jiwa' => $row[8],
                        'jenis_bantuan' => $row[9],
                        'nominal_bantuan' => $row[10],
                        'keterangan' => $row[11],
                        'pengurus_id' => Auth::user()->pengurus_id,
                    ]);
                }
            } else {
                // Jika formatnya adalah tanggal (misalnya "01/04/2024")
                list($day, $month, $year) = explode('/', $tanggalExcel);
                $baseDate = Carbon::createFromDate($year, $month, $day);
                $tanggalBantuan = $baseDate->format('Y-m-d');
                list($day, $month, $year) = explode('/', $tanggalExcel1);
                $baseDate1 = Carbon::createFromDate($year, $month, $day);
                $tanggalLahir = $baseDate1->format('Y-m-d');

                if (Auth::user()->gocap_id_pc_pengurus) {
                    Mustahik::create([
                        'mustahik_id' => Str::uuid()->toString(),
                        'permohonan_id' => $request->permohonan_id,
                        'tgl_realisasi' => $tanggalBantuan,
                        'nama_mustahik' => $row[1],
                        'nohp' => $row[2],
                        'tgl_lahir' => $tanggalLahir,
                        'nkk' => $row[4],
                        'nik' => $row[5],
                        'alamat' => $row[6],
                        'jumlah_kk' => $row[7],
                        'jumlah_jiwa' => $row[8],
                        'jenis_bantuan' => $row[9],
                        'nominal_bantuan' => $row[10],
                        'keterangan' => $row[11],
                        'pengurus_id' => Auth::user()->pengurus_id,
                    ]);
                }
            }
        }


        // Hapus file setelah berhasil mengimpor
        File::delete(public_path('/file_import_mustahik/' . $nama_file));


        $notification = array(
            'message' => 'Import Berhasil !',
            'alert-type' => 'success'
        );

        $data_detail = $request->permohonan_id;
        return redirect()->route('import_mustahik', ['permohonan_id' => $data_detail])->with($notification);
    }

    public function cancel(Request $request)
    {

        $notification = array(
            'message' => 'Import Dibatalkan !',
            'alert-type' => 'error'
        );

        $data_detail = $request->permohonan_id;
        return redirect()->route('import_mustahik', ['permohonan_id' => $data_detail])->with($notification);
    }
}
