<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Surat extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'surat_id';
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string';
    public $timestamps = true;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->surat_id = (string) Str::uuid(); // Pastikan UUID dibuat
        });
    }

}
