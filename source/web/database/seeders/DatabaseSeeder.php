<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 유저 테이블 seed
        $this->call(UserSeeder::class);
        // 상품 테이블 seed
        $this->call(ProductSeeder::class);
    }
}
