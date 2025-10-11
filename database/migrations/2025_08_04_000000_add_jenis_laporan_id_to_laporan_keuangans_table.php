<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisLaporanIdToLaporanKeuangansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('laporan_keuangans', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_laporan_id')->nullable()->after('uuid');
            $table->foreign('jenis_laporan_id')->references('id')->on('jenis_laporans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('laporan_keuangans', function (Blueprint $table) {
            $table->dropForeign(['jenis_laporan_id']);
            $table->dropColumn('jenis_laporan_id');
        });
    }
}
