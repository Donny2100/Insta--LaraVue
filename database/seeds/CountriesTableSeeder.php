<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('countries')->insert([
            [
                'name' => 'United States',
                'slug' => 'united-states',
                'priority' => 0,
                'status' => true,
                'seo_title' => '',
                'seo_description' => '',
                'seo_cover_image' => '',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);
    }
}
