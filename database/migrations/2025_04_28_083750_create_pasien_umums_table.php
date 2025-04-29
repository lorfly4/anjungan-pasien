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
        Schema::create('pasien_umum', function (Blueprint $table) {
            $table->id('id_pasien'); // SERIAL PRIMARY KEY
            $table->string('no_rm', 20)->unique()->nullable(false); // Nomor Rekam Medis
            $table->string('nama_lengkap', 100)->nullable(false);
            $table->string('nik', 20)->unique()->nullable();
            $table->string('jenis_kelamin', 10);
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->date('tanggal_daftar');
            $table->boolean('status_aktif')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_umum');
    }
};
