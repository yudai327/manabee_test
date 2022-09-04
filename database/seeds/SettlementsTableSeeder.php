<?php

use App\Settlement;
use Illuminate\Database\Seeder;

class SettlementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '1',
            'item_id' => '2',
            'payment_id' => '1',
            'price' => 10000,
            'settlement_fee' => 10000 * 0.0325,
            'platform_fee' => 10000 - (10000 * 0.0325) * 0.1,
            'brand' => 'VISA',
            'last_4' => '0101',
        ];
        DB::table('settlements')->insert($param);
        $param = [
            'user_id' => '1',
            'item_id' => '5',
            'payment_id' => '1',
            'price' => 20000,
            'settlement_fee' => 20000 * 0.0325,
            'platform_fee' => 20000 - (20000 * 0.0325) * 0.1,
            'brand' => 'VISA',
            'last_4' => '0101',
        ];
        DB::table('settlements')->insert($param);
        $param = [
            'user_id' => '1',
            'item_id' => '6',
            'payment_id' => '1',
            'price' => 1000,
            'settlement_fee' => 1000 * 0.0325,
            'platform_fee' => 1000 - (1000 * 0.0325) * 0.1,
            'brand' => 'VISA',
            'last_4' => '0101',
        ];
        DB::table('settlements')->insert($param);
        $param = [
            'user_id' => '4',
            'item_id' => '1',
            'payment_id' => '1',
            'price' => 3000,
            'settlement_fee' => 3000 * 0.0325,
            'platform_fee' => 3000 - (3000 * 0.0325) * 0.1,
            'brand' => 'VISA',
            'last_4' => '9999',
        ];
        DB::table('settlements')->insert($param);
        $param = [
            'user_id' => '4',
            'item_id' => '3',
            'payment_id' => '1',
            'price' => 5000,
            'settlement_fee' => 5000 * 0.0325,
            'platform_fee' => 5000 - (5000 * 0.0325) * 0.1,
            'brand' => 'VISA',
            'last_4' => '9999',
        ];
        DB::table('settlements')->insert($param);
        factory(App\Settlement::class, 200)->create();

    }
}
