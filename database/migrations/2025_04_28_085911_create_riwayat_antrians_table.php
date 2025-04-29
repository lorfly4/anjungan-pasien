<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_antrians', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm', 20); // Sesuaikan tipe data dengan tabel pasien_umum
            $table->foreign('no_rm')->references('no_rm')->on('pasien_umum')->onDelete('cascade'); // Relasi foreign key
            $table->string('no_antrian', 20);
            $table->string('tujuan', 20);
            $table->string('status', 20)->nullable();
            $table->date('tanggal_antrian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_antrians');
    }
};
