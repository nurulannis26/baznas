<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Permohonan extends Model
{
    use HasFactory;

    protected $table = 'permohonan';
    protected $primaryKey = 'permohonan_id';
    public $timestamps = true;
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->permohonan_id = (string) Str::uuid(); // Pastikan UUID dibuat
        });
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function subProgram()
    {
        return $this->belongsTo(SubProgram::class, 'sub_program_id');
    }

    public function asnaf()
    {
        return $this->belongsTo(Asnaf::class, 'asnaf_id');
    }

    public function mustahik()
    {
        return $this->belongsTo(Mustahik::class, 'mustahik_id');
    }

    public function upz()
    {
        return $this->belongsTo(Upz::class, 'upz_id');
    }

    public static function getNamaUPZ($id)
    {
        $upz = DB::table('permohonan')
            ->join('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
            ->where('upz.upz_id', $id)
            ->first();

        return $upz ? $upz->nama : 'Tidak ditemukan';
    }

    public static function getNoHP($id)
    {
        $upz = DB::table('permohonan')
            ->join('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
            ->where('upz.upz_id', $id)
            ->first();

        return $upz ? $upz->nohp : 'Tidak ditemukan';
    }

    public static function getAlamat($id)
    {
        $upz = DB::table('permohonan')
            ->join('upz', 'upz.upz_id', '=', 'permohonan.upz_id')
            ->where('upz.upz_id', $id)
            ->first();

        return $upz ? $upz->alamat : 'Tidak ditemukan';
    }

    public static function getProgram($id)
    {
        $a = DB::table('permohonan')->join('program', 'program.program_id', '=', 'permohonan.program_id')
        ->where('program.program_id', $id)->first();
        return $a->program;
    }

    public static function getSubProgram($id)
    {
        $a = DB::table('program')->join('sub_program', 'program.program_id', '=', 'sub_program.program_id')
        ->where('sub_program.program_id', $id)->first();
        return $a->sub_program;
    }

    public static function getAsnaf($id)
    {
        $a = DB::table('permohonan')->join('asnaf', 'asnaf.asnaf_id', '=', 'permohonan.asnaf_id')
        ->where('asnaf.asnaf_id', $id)->first();
        return $a->asnaf;
    }
}
