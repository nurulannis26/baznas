<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jabatan extends Model
{
    protected $table = 'jabatan';
    protected $primaryKey = 'jabatan_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $guarded = [];

    protected static function boot() {
        parent::boot();
        static::creating(function ($jabatan) {
            $jabatan->jabatan_id = Str::uuid();
        });
    }

    public function divisi() {
        return $this->belongsTo(Divisi::class, 'divisi_id', 'divisi_id');
    }

    public function pengurus() {
        return $this->hasMany(Pengurus::class, 'jabatan_id', 'jabatan_id');
    }
}
