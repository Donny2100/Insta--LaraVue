<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            [
                'name' => 'Vyudu Admin',
                'email' => 'devops@vyudu.com',
                'password' => Hash::make('!vyudu2020!'),
                'avatar' => '',
                'email_verified_at' => \Carbon\Carbon::now(),
                'phone_number' => '1234567890',
                'facebook' => '',
                'instagram' => '',
                'status' => true,
                'is_admin' => true,
            ]
        ]);
    }
}
