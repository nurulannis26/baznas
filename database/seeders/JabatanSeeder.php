<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatan')->insert([
            ['jabatan_id' => Str::uuid(), 'divisi_id' => DB::table('divisi')->where('divisi', 'Bidang Pengumpulan')->value('divisi_id'), 'jabatan' => 'Wakil Ketua I', 'created_at' => now(), 'updated_at' => now()],
            ['jabatan_id' => Str::uuid(), 'divisi_id' => DB::table('divisi')->where('divisi', 'Bidang Distribusi dan Dayaguna')->value('divisi_id'), 'jabatan' => 'Wakil Ketua II', 'created_at' => now(), 'updated_at' => now()],
            ['jabatan_id' => Str::uuid(), 'divisi_id' => DB::table('divisi')->where('divisi', 'Bidang Perencanaan Keuangan dan Pelaporan')->value('divisi_id'), 'jabatan' => 'Wakil Ketua III', 'created_at' => now(), 'updated_at' => now()],
            ['jabatan_id' => Str::uuid(), 'divisi_id' => DB::table('divisi')->where('divisi', 'Bidang Adm. SDM dan Umum')->value('divisi_id'), 'jabatan' => 'Wakil Ketua IV', 'created_at' => now(), 'updated_at' => now()],
            ['jabatan_id' => Str::uuid(), 'divisi_id' => DB::table('divisi')->where('divisi', 'Ketua')->value('divisi_id'), 'jabatan' => 'Ketua', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
