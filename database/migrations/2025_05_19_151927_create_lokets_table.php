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
        Schema::create('lokets', function (Blueprint $table) {
            $table->id('id_lokets');
            $table->string('nama_lokets');
            $table->string('jenis_berobat');
            $table->string('keterangan');
            $table->unsignedBigInteger('id_dokter');
            $table->foreign('id_dokter')->references('id_dokter')->on('dokters');
            $table->unsignedBigInteger('id_poli');
            $table->foreign('id_poli')->references('id_poli')->on('poli');
            $table->unsignedBigInteger('id_kategoris');
            $table->foreign('id_kategoris')->references('id_kategoris')->on('kategoris');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokets');
    }
};
