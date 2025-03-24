<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengurus')->insert([
            [
                'pengurus_id' => Str::uuid(),
                'jabatan_id' => DB::table('jabatan')->where('jabatan', 'Wakil Ketua I')->value('jabatan_id'),
                'sk_nomor' => 'SK-001',
                'sk_url' => 'uploads/sk_001.pdf',
                'tgl_mulai' => '2023-01-01',
                'tgl_selesai' => '2025-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pengurus_id' => Str::uuid(),
                'jabatan_id' => DB::table('jabatan')->where('jabatan', 'Wakil Ketua II')->value('jabatan_id'),
                'sk_nomor' => 'SK-002',
                'sk_url' => 'uploads/sk_002.pdf',
                'tgl_mulai' => '2023-06-01',
                'tgl_selesai' => '2025-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
