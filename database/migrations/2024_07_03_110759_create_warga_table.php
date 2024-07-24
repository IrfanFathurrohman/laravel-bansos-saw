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
            Schema::create('wargas', function (Blueprint $table) {
                $table->id();
                $table->string('nik')->unique();
                $table->string('nama')->notNull();
                $table->string('alamat')->notNull();
                $table->string('jenis_kelamin')->notNull(); // Perbaikan di sini
                $table->integer('tahun_pengajuan')->notNull()->default(2024);
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
