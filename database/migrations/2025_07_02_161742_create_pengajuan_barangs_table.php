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
        Schema::create('pengajuan_barangs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('penanggung_jawab');
            $table->string('barang');
            $table->string('nomor');
            $table->string('surat');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_barangs');
    }
};
