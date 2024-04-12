<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageUrlToMoviesTable extends Migration
{
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->string('image_url')->nullable();
        });
    }

    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });
    }
}
