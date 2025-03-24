<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubProgram extends Model
{
    protected $table = 'sub_program';
    protected $primaryKey = 'sub_program_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $guarded = [];

    protected static function boot() {
        parent::boot();
        static::creating(function ($sub_program) {
            $sub_program->sub_program_id = Str::uuid();
        });
    }


    public function program() {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function permohonan() {
        return $this->hasMany(Permohonan::class, 'sub_program_id', 'sub_program_id');
    }
}
// 8a5736b2-fb61-11ef-8763-e4fd4537f50e