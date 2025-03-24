<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Wilayah extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'wilayah_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $guarded = [];

    protected static function boot() {
        parent::boot();
        static::creating(function ($wilayah) {
            $wilayah->wilayah_id = Str::uuid();
        });
    }

    public function pengguna() {
        return $this->hasMany(Pengguna::class, 'wilayah_id', 'wilayah_id');
    }
}
