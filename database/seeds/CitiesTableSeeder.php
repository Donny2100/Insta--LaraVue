<?php

use App\Models\State;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitiesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $parsed = [];

        $us = Country::where('slug', 'united-states')->first();
        $row = 0;
        $states = State::all();
        $now = \Carbon\Carbon::now();

        if (($handle = fopen('./uscities.csv', 'r')) !== false) {
            while (($data = fgetcsv($handle, 100000, ',')) !== false) {
                $preParsed[] = $data;
                $row++;
            }

            fclose($handle);

            $parsed = array_chunk(array_values(array_filter(array_map(function($city) use ($preParsed, $us, $states, $now) {
                $state = $states->first(function($value) use ($city) {
                    return $value->name === $city[1];
                });

                if ($state) {
                    return [
                        'name'               => $city[0],
                        'slug'               => Str::slug($city[0]),
                        'state_id'           => $state->id,
                        'country_id'         => $us->id,
                        'intro'              => '',
                        'description'        => '',
                        'thumb'              => '',
                        'banner'             => '',
                        'best_time_to_visit' => '',
                        'currency'           => 'USD',
                        'language'           => 'English',
                        'priority'           => 0,
                        'status'             => 1,
                        'created_at'         => $now,
                        'updated_at'         => $now,
                        $preParsed[0][2]     => $city[2],
                        $preParsed[0][3]     => $city[3],
                    ];
                }
            }, $preParsed))), 1000);
        }

        foreach ($parsed as $parsedGroup) {
            $translationGroup = [];

            foreach ($parsedGroup as $parsedCity) {
                $parsedCityId = DB::table('cities')->insertGetId($parsedCity);

                $translationGroup[] = [
                    'city_id'     => $parsedCityId,
                    'locale'      => 'en',
                    'name'        => $parsedCity['name'],
                    'intro'       => '',
                    'description' => '',
                ];
            }

            DB::table('city_translations')->insert($translationGroup);
        }
    }
}
