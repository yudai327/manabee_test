<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $param = [
            'user_id' => '1',
            'bank_id' => '1',
            'price' => '3000',
            'transfer_fee' => '300',
            'transfer_fee_real' => '300',
            'transfer_flg' => '1',
            'request_at' => Carbon::now()->subDays(15),
            'transfer_at' => Carbon::now()->subDays(15),
        ];
        DB::table('sales')->insert($param);
        $param = [
            'user_id' => '1',
            'bank_id' => '1',
            'price' => '3000',
            'transfer_fee' => '300',
            'transfer_fee_real' => '300',
            'transfer_flg' => '0',
            'request_at' => Carbon::now()->subDays(15),
            'transfer_at' => Carbon::now()->subDays(15),
        ];
        DB::table('sales')->insert($param);

    }
}
