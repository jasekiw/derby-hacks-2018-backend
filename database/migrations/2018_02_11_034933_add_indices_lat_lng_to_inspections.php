<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndicesLatLngToInspections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inspections', function(Blueprint $table) {
            $table->index('Latitude', 'inpcts_lat_index');
            $table->index('Longitude', 'inpcts_lng_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspections', function(Blueprint $table) {
            $table->dropIndex('inpcts_lat_index');
            $table->dropIndex('inpcts_lng_index');
        });
    }
}
