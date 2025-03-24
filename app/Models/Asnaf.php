<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asnaf extends Model
{
    use HasFactory;

    protected $table = 'asnaf';
    protected $primaryKey = 'asnaf_id';
    public $timestamps = true;

    public $incrementing = false;

    protected $guarded = [];

    public function mustahik()
    {
        return $this->hasMany(Mustahik::class, 'asnaf_id', 'asnaf_id');
    }
}
