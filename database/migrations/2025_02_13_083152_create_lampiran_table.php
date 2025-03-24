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

        Schema::create('lampiran', function (Blueprint $table) {
            $table->uuid('lampiran_id')->primary();
            $table->foreignUuid('permohonan_id')->index()->nullable();
            $table->foreign('permohonan_id')->references('permohonan_id')->on('permohonan');
            $table->enum('jenis', ["Permohonan","Survey","Pencairan","LPJ"])->nullable();
            $table->string('keterangan')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('lampiran');
    }
};
