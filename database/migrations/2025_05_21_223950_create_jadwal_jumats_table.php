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
        Schema::create('jadwal_jumats', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('tanggal');
            $table->string('nama_imam');
            $table->string('nama_khatib');
            $table->string('nama_muadzin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_jumats');
    }
};
