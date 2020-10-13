<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('settings')->insert([
            [
                'name' => 'app_name',
                'val'  => 'City Guide Travel Laravel Platform',
                'type' => 'string',
                'created_at' => '2019-12-18 07:53:47',
                'updated_at' => '2019-12-18 07:55:23'
            ],
            [
                'name' => 'logo',
                'val'  => '5df9db8757535_1576655751.png',
                'type' => 'image',
                'created_at' => '2019-12-18 07:55:23',
                'updated_at' => '2019-12-18 07:55:51'
            ],
            [
                'name' => 'email_system',
                'val'  => 'hello@uxper.co',
                'type' => 'string',
                'created_at' => '2019-12-21 10:18:55',
                'updated_at' => '2020-02-11 01:50:43'
            ],
            [
                'name' => 'ads_sidebar_banner_link',
                'val'  => 'https://www.getyourguide.com',
                'type' => 'string',
                'created_at' => '2019-12-21 10:18:55',
                'updated_at' => '2019-12-23 14:37:34'
            ],
            [
                'name' => 'ads_sidebar_banner_image',
                'val'  => '5e02cf9f0538b_1577242527.jpg',
                'type' => 'image',
                'created_at' => '2019-12-21 10:19:03',
                'updated_at' => '2019-12-25 02:55:27'
            ],
            [
                'name' => 'home_description',
                'val'  => 'Golo is a Laravel Theme built on the Laravel 5.8 framework. With this theme, you can create your own City Travel Guide website with Points of Interest group by Categories (Sight, Restaurant, Drink, Shopping, Hotel, Fitness, Beaty, Activities...)',
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'mail_driver',
                'val'  => 'smtp',
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'mail_host',
                'val'  => 'smtp.googlemail.com',
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'mail_port',
                'val'  => '465',
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'mail_username',
                'val'  => null,
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'mail_password',
                'val'  => null,
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'mail_encryption',
                'val'  => 'ssl',
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'mail_from_address',
                'val'  => 'hello@uxper.co',
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'mail_from_name',
                'val'  => 'uxper',
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'facebook_app_id',
                'val'  => null,
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'facebook_app_secret',
                'val'  => null,
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'google_app_id',
                'val'  => null,
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'google_app_secret',
                'val'  => null,
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'goolge_map_api_key',
                'val'  => null,
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'style_rtl',
                'val'  => '0',
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:09:58'
            ],
            [
                'name' => 'template',
                'val'  => '02',
                'type' => 'string',
                'created_at' => '2020-06-22 15:09:58',
                'updated_at' => '2020-06-22 15:42:00'
            ],
        ]);
    }
}
