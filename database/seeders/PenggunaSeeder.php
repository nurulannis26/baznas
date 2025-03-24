<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'pengguna_id' => Str::uuid(),
                'wilayah_id' => '33.01.21.1002', 
                'pengurus_id' => DB::table('pengurus')->where('sk_nomor', 'SK-001')->value('pengurus_id'), 
                'driver_id' => null,
                'nik' => '1234567890123456',
                'kk' => '3201123456789012',
                'nama' => 'Nurul Annisa',
                'jenis_kelamin' => 1,
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '1990-05-20',
                'email' => 'budi@example.com',
                'nohp' => '089639481199',
                'password' => Hash::make('089639481199'), 
                'alamat' => 'Jl. Merdeka No. 10',
                'rt' => '01',
                'rw' => '02',
                'foto_url' => 'uploads/budi.jpg',
                'ttd_url' => 'uploads/budi_ttd.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
