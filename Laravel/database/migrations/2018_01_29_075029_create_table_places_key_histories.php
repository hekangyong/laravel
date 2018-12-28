<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePlacesKeyHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('searchHistories', function (Blueprint $table) {
            $table->integer('from_place_id')->unsigned();
            $table->foreign('from_place_id')->references('id')->on('places');
            $table->integer('to_place_id')->unsigned();
            $table->foreign('to_place_id')->references('id')->on('places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
