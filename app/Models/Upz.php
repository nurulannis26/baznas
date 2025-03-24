<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Upz extends Model
{
    use HasFactory;

    protected $table = 'upz';
    protected $primaryKey = 'upz_id';
    public $timestamps = true;
    public $incrementing = false; // Nonaktifkan auto-increment
    protected $keyType = 'string';

    protected $guarded = [];


    public function permohonan()
    {
        return $this->hasMany(Permohonan::class, 'upz_id', 'upz_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->upz_id = (string) Str::uuid(); // Pastikan UUID dibuat
        });
    }
}
