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

        Schema::create('sub_program', function (Blueprint $table) {
            $table->uuid('sub_program_id')->primary();
            $table->foreignUuid('program_id')->index();
            $table->foreign('program_id')->references('program_id')->on('program')->onDelete('cascade');
            $table->string('sub_program');
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
        Schema::dropIfExists('sub_program');
    }
};
