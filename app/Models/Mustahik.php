<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahik extends Model
{
    use HasFactory;

    protected $table = 'mustahik';
    protected $primaryKey = 'mustahik_id';
    public $timestamps = true;
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string';

    protected $guarded = [];
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id', 'wilayah_id');
    }

    public function asnaf()
    {
        return $this->belongsTo(Asnaf::class, 'asnaf_id', 'asnaf_id');
    }

    public function daftarMustahik()
    {
        return $this->hasMany(DaftarMustahik::class, 'mustahik_id', 'mustahik_id');
    }
}
