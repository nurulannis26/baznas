<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Divisi extends Model
{
    protected $table = 'divisi';
    protected $primaryKey = 'divisi_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $guarded = [];

    protected static function boot() {
        parent::boot();
        static::creating(function ($divisi) {
            $divisi->divisi_id = Str::uuid();
        });
    }

    public function jabatan() {
        return $this->hasMany(Jabatan::class, 'divisi_id', 'divisi_id');
    }
}
