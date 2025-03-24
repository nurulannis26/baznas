<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarMustahik extends Model
{
    use HasFactory;

    protected $table = 'daftar_mustahik';
    protected $primaryKey = 'daftar_mustahik_id';
    public $timestamps = true;
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string';

    protected $guarded = [];

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class, 'permohonan_id', 'permohonan_id');
    }

    public function mustahik()
    {
        return $this->belongsTo(Mustahik::class, 'mustahik_id', 'mustahik_id');
    }
}
