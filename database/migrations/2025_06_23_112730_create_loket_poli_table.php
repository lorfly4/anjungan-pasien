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
        Schema::create('loket_poli', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('loket_id');
        $table->unsignedBigInteger('poli_id');
        $table->foreign('loket_id')->references('id_lokets')->on('lokets')->onDelete('cascade');
        $table->foreign('poli_id')->references('id_poli')->on('poli')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loket_poli');
    }
};
