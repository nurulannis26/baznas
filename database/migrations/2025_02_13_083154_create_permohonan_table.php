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

        Schema::create('permohonan', function (Blueprint $table) {
            $table->uuid('permohonan_id')->primary();
            $table->foreignUuid('surat_id')->index()->nullable();
            $table->foreign('surat_id')->references('surat_id')->on('surat');
            $table->foreignUuid('program_id')->index()->nullable();
            $table->foreign('program_id')->references('program_id')->on('program');
            $table->foreignUuid('sub_program_id')->index()->nullable();
            $table->foreign('sub_program_id')->references('sub_program_id')->on('sub_program');
            $table->foreignUuid('asnaf_id')->index()->nullable();
            $table->foreign('asnaf_id')->references('asnaf_id')->on('asnaf');
            $table->foreignUuid('mustahik_id')->index()->nullable();
            $table->foreign('mustahik_id')->references('mustahik_id')->on('mustahik');
            $table->foreignUuid('upz_id')->index()->nullable();
            $table->foreign('upz_id')->references('upz_id')->on('upz');
            $table->string('permohonan_nomor');
            $table->enum('permohonan_jenis', ["Individu","UPZ"]);
            $table->string('permohonan_nama_pemohon')->nullable();
            $table->string('permohonan_alamat_pemohon')->nullable();
            $table->string('permohonan_nohp_pemohon')->nullable();
            $table->string('permohonan_tgl');
            $table->string('permohonan_nominal');
            $table->enum('permohonan_bentuk_bantuan', ["Uang Tunai","Barang"]);
            $table->string('permohonan_keterangan')->nullable();
            $table->string('permohonan_petugas_input')->index();
            $table->timestamp('permohonan_timestamp_input');
            $table->enum('permohonan_status_input', ["Selesai Input","Belum Selesai Input"])->nullable();
            $table->string('permohonan_catatan_input')->nullable();
            $table->string('permohonan_petugas_atasan')->index()->nullable();
            $table->timestamp('permohonan_timestamp_atasan')->nullable();
            $table->enum('permohonan_status_atasan', ["Diterima","Belum Dicek", "Ditolak"])->nullable();
            $table->string('permohonan_catatan_atasan')->nullable();
            $table->enum('survey_pilihan', ["Perlu","Tidak Perlu"])->nullable();
            $table->date('survey_tgl')->nullable();
            $table->string('survey_petugas_survey')->index()->nullable();
            $table->string('survey_hasil')->nullable();
            $table->enum('survey_status', ["Selesai","Belum Selesai"])->nullable();
            $table->string('survey_form_url')->nullable();
            $table->string('survey_timestamp')->nullable();
            $table->string('acc_nominal')->nullable();
            $table->string('acc_timestamp')->nullable();
            $table->string('acc_catatan')->nullable();
            $table->string('pencairan_sumberdana')->nullable();
            $table->string('pencairan_petugas_keuangan')->index()->nullable();
            $table->string('pencairan_nominal')->nullable();
            $table->string('pencairan_timestamp')->nullable();
            $table->string('pencairan_status')->nullable();
            $table->string('pencairan_catatan')->nullable();
            $table->string('denial_note_atasan')->nullable();
            $table->string('denial_note_pencairan')->nullable();
            $table->string('denial_date_atasan')->nullable();
            $table->string('denial_date_pencairan')->nullable();
            $table->string('survey_catatan')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan');
    }
};
