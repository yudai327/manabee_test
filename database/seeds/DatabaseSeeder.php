<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
    //  * @return void
     */
    public function run()
    {
        //テスト用
        $this->call(UsersTableSeeder::class);
        $this->call(PushesTableSeeder::class);
        $this->call(SettlementsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(SalesTableSeeder::class);
    }
}
