<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pengguna extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'pengguna';
    protected $primaryKey = 'pengguna_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    public $incrementing = false;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        // 'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Override default authentication field (email) to no_hp.
     */
    public function username(): string
    {
        return 'nohp';
    }

    protected static function boot() {
        parent::boot();
        static::creating(function ($pengguna) {
            $pengguna->pengguna_id = Str::uuid();
        });
    }


    public function wilayah() {
        return $this->belongsTo(Wilayah::class, 'wilayah_id', 'wilayah_id');
    }

    public function pengurus() {
        return $this->belongsTo(Pengurus::class, 'pengurus_id', 'pengurus_id');
    }

    public static function pengguna($id) {
        $a = DB::table('pengguna')->where('pengguna.pengurus_id', $id)->first();
        return $a ? $a->nama : null; // Hindari error jika data tidak ditemukan
    }
       
    public static function jabatan($id) {
        $a = DB::table('pengguna')->join('pengurus', 'pengurus.pengurus_id', '=', 'pengguna.pengurus_id')->join('jabatan', 'jabatan.jabatan_id', '=', 'pengurus.jabatan_id')
        ->where('pengguna.pengurus_id', $id)->first();
        return $a ? $a->jabatan : null; // Hindari error jika data tidak ditemukan
    }

}
