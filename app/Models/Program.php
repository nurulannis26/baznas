<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Program extends Model
{
    protected $table = 'program';
    protected $primaryKey = 'program_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $guarded = [];

    protected static function boot() {
        parent::boot();
        static::creating(function ($program) {
            $program->program_id = Str::uuid();
        });
    }

    public function sub_program() {
        return $this->hasMany(SubProgram::class, 'program_id', 'program_id');
    }

    public function permohonan() {
        return $this->hasMany(Permohonan::class, 'program_id', 'program_id');
    }
}
