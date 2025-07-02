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
        Schema::create('donasi_manuals', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nama_donatur');
            $table->string('jenis_donasi');
            $table->string('jumlah');
            $table->string('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi_manuals');
    }
};
