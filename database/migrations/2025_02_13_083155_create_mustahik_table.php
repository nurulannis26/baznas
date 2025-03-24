<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('mustahik', function (Blueprint $table) {
            $table->uuid('mustahik_id')->primary();
            $table->foreignUuid('wilayah_id')->index()->nullable();
            $table->foreign('wilayah_id')->references('wilayah_id')->on('wilayah');
            $table->foreignUuid('asnaf_id')->index()->nullable();
            $table->foreign('asnaf_id')->references('asnaf_id')->on('asnaf');
            $table->string('pasien_pj_id')->index()->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('nik')->nullable();
            $table->string('kk')->nullable();
            $table->string('nama')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('nohp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('foto_url')->nullable();
            $table->string('ktp_url')->nullable();
            $table->string('kk_url')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mustahik');
    }
};
