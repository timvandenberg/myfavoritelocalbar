<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bars', function (Blueprint $table) {
            $table->id();
            $table->integer('town_id');
            $table->string('name');
            $table->text('google_place_description');
            $table->text('google_place_id');
            $table->double('lat');
            $table->double('lng');
            $table->string('street');
            $table->string('street_nr');
            $table->string('town');
            $table->string('province');
            $table->string('country');
            $table->string('postal_code');
            $table->text('description')->nullable();

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
        Schema::dropIfExists('bars');
    }
};
