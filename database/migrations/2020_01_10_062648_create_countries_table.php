<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('slug');
            $table->integer('priority')
                  ->default(0);
            $table->boolean('status')
                  ->default(0);
            $table->string('seo_title')
                  ->nullable();
            $table->string('seo_description')
                  ->nullable();
            $table->string('seo_cover_image')
                  ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('countries');
    }
}
