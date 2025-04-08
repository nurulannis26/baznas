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

        Schema::create('daftar_mustahik', function (Blueprint $table) {
            $table->uuid('daftar_mustahik_id')->primary();
            $table->foreignUuid('permohonan_id')->index()->nullable();
            $table->foreign('permohonan_id')->references('permohonan_id')->on('permohonan');
            $table->foreignUuid('mustahik_id')->index()->nullable();
            $table->foreign('mustahik_id')->references('mustahik_id')->on('mustahik');
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
        Schema::dropIfExists('daftar_mustahik');
    }
};
