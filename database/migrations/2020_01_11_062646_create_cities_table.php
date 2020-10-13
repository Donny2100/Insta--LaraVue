<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('country_id')
                  ->unsigned();
            $table->bigInteger('state_id')
                  ->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('intro');
            $table->longText('description');
            $table->string('thumb')
                  ->nullable();
            $table->string('banner')
                  ->nullable();
            $table->string('best_time_to_visit');
            $table->string('currency');
            $table->string('language');
            $table->double('lat');
            $table->double('lng');
            $table->integer('priority')
                  ->default(0);
            $table->integer('status')
                  ->default(false);

            $table->timestamps();

            $table->unique(['state_id', 'country_id', 'slug']);

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
            $table->dropForeign(['state_id']);
        });

        Schema::dropIfExists('cities');
    }
}
