<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            'name' => 'admin',
            'email' => 'admin@test.test',
            'nickname' => '어드민',
            'tel' => '010-000-0000',
            'sex' => 'M',
            'password' => bcrypt('12341234'),
            'email_verified_at' => Carbon::now()
        ]);


        User::create([
            'name' => 'member1',
            'email' => 'member1@test.test',
            'nickname' => '유저1',
            'tel' => '010-000-0000',
            'sex' => 'F',
            'password' => bcrypt('12341234'),
            'email_verified_at' => Carbon::now()
        ]);


        User::create([
            'name' => 'member2',
            'email' => 'member2@gtest.test',
            'nickname' => '유저2',
            'tel' => '010-000-0000',
            'sex' => 'M',
            'password' => bcrypt('12341234'),
            'email_verified_at' => Carbon::now()
        ]);

    }
}
