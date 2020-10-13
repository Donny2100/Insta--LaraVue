<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->bigInteger('country_id')
                  ->unsigned();
            $table->integer('city_id')
                  ->unsigned();
            $table->bigInteger('state_id')
                  ->unsigned();
            $table->string('category');
            $table->string('place_type');
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->integer('price_range');
            $table->string('amenities');
            $table->string('address');
            $table->double('lat');
            $table->double('lng');
            $table->string('email');
            $table->string('phone_number');
            $table->string('website')
                  ->nullable();
            $table->string('social', 500);
            $table->string('opening_hour', 500);
            $table->string('thumb');
            $table->longText('gallery')
                  ->nullable();
            $table->string('video')
                  ->nullable();
            $table->integer('booking_type');
            $table->string('link_bookingcom')
                  ->nullable();
            $table->integer('status');

            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('places', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['state_id']);
            $table->dropForeign(['country_id']);
        });

        Schema::dropIfExists('places');
    }
}
