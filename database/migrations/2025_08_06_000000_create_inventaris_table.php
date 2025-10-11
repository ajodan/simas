<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('jenisinventaris_id');
            $table->string('kode_inventaris');
            $table->string('nama_inventaris');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->string('kondisi');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('jenisinventaris_id')->references('id')->on('jenis_inventaris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
}
