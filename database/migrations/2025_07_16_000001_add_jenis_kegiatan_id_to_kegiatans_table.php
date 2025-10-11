<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisKegiatanIdToKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_kegiatan_id')->nullable()->after('id');
            $table->foreign('jenis_kegiatan_id')->references('id')->on('jenis_kegiatans')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropForeign(['jenis_kegiatan_id']);
            $table->dropColumn('jenis_kegiatan_id');
        });
    }
}
