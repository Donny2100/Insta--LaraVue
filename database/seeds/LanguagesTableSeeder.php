<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('languages')->insert([
            [
                'name' => 'English',
                'native_name' => 'English',
                'code' => 'en',
                'is_default' => 1,
                'is_active' => 1,
                'created_at' => '2019-12-18 07:53:47',
                'updated_at' => '2019-12-18 07:55:23'
            ],
        ]);
    }
}
