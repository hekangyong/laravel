<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSeachHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('searchHistories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('users_id');
            $table->integer('from_place_id');
            $table->integer('to_place_id');
            $table->float('search_histories');
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
