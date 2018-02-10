<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function(Blueprint $table) {
            $table->unsignedInteger('EstablishmentID');
            $table->unsignedInteger('InspectionID')->unique();
            $table->string('EstablishmentName');
            $table->string('Address');
            $table->string('City');
            $table->string('State');
            $table->string('Zip');
            $table->string('TypeDescription');
            $table->double('Longitude');
            $table->double('Latitude');
            $table->date('InspectionDate');
            $table->unsignedInteger('Score');
            $table->string('Grade');
            $table->string('NameSearch');
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
        Schema::drop('inspections');
    }
}
