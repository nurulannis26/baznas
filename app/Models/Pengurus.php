<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengurus extends Model
{
    protected $table = 'pengurus';
    protected $primaryKey = 'pengurus_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $guarded = [];
    protected static function boot() {
        parent::boot();
        static::creating(function ($pengurus) {
            $pengurus->pengurus_id = Str::uuid();
        });
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'jabatan_id');
    }

    public function pengguna()
    {
        return $this->hasOne(Pengguna::class, 'pengurus_id', 'pengurus_id');
    }
}
