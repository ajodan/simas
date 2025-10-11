<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFotoColumnToTextInDokumentasisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('dokumentasis', function (Blueprint $table) {
            $table->text('foto')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('dokumentasis', function (Blueprint $table) {
            $table->string('foto')->change();
        });
    }
}
