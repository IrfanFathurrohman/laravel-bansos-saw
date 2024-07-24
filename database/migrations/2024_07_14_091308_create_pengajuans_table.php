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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nik');
            $table->unsignedBigInteger('bansos_id');
            $table->unsignedBigInteger('kriteria_id');
            $table->decimal('nilai', 8, 2); // Sesuaikan dengan tipe nilai yang digunakan
            $table->timestamps();
        
            $table->foreign('nik')->references('id')->on('wargas');
            $table->foreign('bansos_id')->references('id')->on('bansos');
            $table->foreign('kriteria_id')->references('id')->on('kriteria');

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
