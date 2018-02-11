<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolygonRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polygon_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->double('TopLeftLat');
            $table->double('TopLeftLng');

            $table->double('BottomRightLat');
            $table->double('BottomRightLng');

            $table->double('Rating');
            $table->double('Step');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polygon_ratings');
    }
}
