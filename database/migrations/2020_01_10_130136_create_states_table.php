<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('states', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('country_id')
                  ->unsigned();

            $table->string('name');
            $table->string('slug');
            $table->boolean('status')
                  ->default(false);
            $table->timestamps();

            $table->unique(['country_id', 'slug']);

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('states', function (Blueprint $table) {
            $table->dropForeign(['country_id']);
        });

        Schema::dropIfExists('states');
    }
}
