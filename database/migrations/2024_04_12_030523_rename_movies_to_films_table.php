<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('movies', 'films');
    }

    public function down()
    {
        Schema::rename('films', 'movies');
    }
};
