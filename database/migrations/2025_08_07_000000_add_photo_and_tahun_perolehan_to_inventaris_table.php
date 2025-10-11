<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoAndTahunPerolehanToInventarisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('inventaris', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('keterangan');
            $table->integer('tahun_perolehan')->nullable()->after('photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('inventaris', function (Blueprint $table) {
            $table->dropColumn(['photo', 'tahun_perolehan']);
        });
    }
}
