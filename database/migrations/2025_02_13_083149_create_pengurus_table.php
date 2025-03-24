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

        Schema::create('pengurus', function (Blueprint $table) {
            $table->uuid('pengurus_id')->primary();
            $table->foreignUuid('jabatan_id');
            $table->foreign('jabatan_id')->references('jabatan_id')->on('jabatan');
            $table->string('sk_nomor');
            $table->string('sk_url');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->enum('status', [""]); //kosongi
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
        Schema::dropIfExists('pengurus');
    }
};
