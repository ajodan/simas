<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUstadzIdToKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->unsignedBigInteger('ustadz_id')->nullable()->after('jenis_kegiatan_id');
            $table->foreign('ustadz_id')->references('id')->on('ustadzs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropForeign(['ustadz_id']);
            $table->dropColumn('ustadz_id');
        });
    }
}
