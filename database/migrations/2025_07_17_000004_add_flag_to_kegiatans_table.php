<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFlagToKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->boolean('flag')->default(1)->after('link_youtube');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn('flag');
        });
    }
}
