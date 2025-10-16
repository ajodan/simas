<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterKegiatansTableAddJamColumn extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            // Add jam column as time
            $table->time('jam')->nullable()->after('tanggal');
        });

        // Extract time from existing tanggal datetime and populate jam column
        DB::statement("UPDATE kegiatans SET jam = TIME(tanggal) WHERE tanggal IS NOT NULL");

        // Change tanggal to date type
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->date('tanggal')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Change tanggal back to datetime
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->datetime('tanggal')->change();
        });

        // Combine date and time back into tanggal
        DB::statement("UPDATE kegiatans SET tanggal = CONCAT(tanggal, ' ', jam) WHERE tanggal IS NOT NULL AND jam IS NOT NULL");

        // Drop jam column
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropColumn('jam');
        });
    }
}
