<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PushesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //pushesテーブルに入力
        $param = [
            'status' => '1',
            'user_id' => '1',
            'item_id' => '2',
            'comment' => '12312341234',
            'created_at' => Carbon::now()->subDays(15),
        ];
        DB::table('pushes')->insert($param);

        $param = [
            'status' => '2',
            'user_id' => '1',
            'item_id' => '1',
            'comment' => 'アーはん',
            'created_at' => Carbon::now()->subDays(1),
        ];
        DB::table('pushes')->insert($param);

        $param = [
            'status' => '3',
            'user_id' => '1',
            'item_id' => '1',
            'comment' => 'あいう',
            'created_at' => Carbon::now()->subDays(2),
        ];
        DB::table('pushes')->insert($param);

        $param = [
            'status' => '1',
            'user_id' => '1',
            'item_id' => '2',
            'comment' => '動画が購入されました。評価しましょう。',
            'created_at' => Carbon::now()->subDays(3),
        ];
        DB::table('pushes')->insert($param);

        $param = [
            'status' => '2',
            'user_id' => '1',
            'item_id' => '1',
            'comment' => 'コメントされました。返信しましょう。',
            'created_at' => Carbon::now()->subDays(4),
        ];
        DB::table('pushes')->insert($param);

        $param = [
            'status' => '3',
            'user_id' => '4',
            'item_id' => '2',
            'comment' => '決済関係',
            'created_at' => Carbon::now()->subDays(5),
        ];
        DB::table('pushes')->insert($param);
        $param = [
            'status' => '3',
            'user_id' => '4',
            'item_id' => '3',
            'comment' => '12312341234',
            'created_at' => new DateTime(),
        ];
        DB::table('pushes')->insert($param);

        $param = [
            'status' => '0',
            'user_id' => null,
            'item_id' => null,
            'comment' => 'アーはん',
            'created_at' => new DateTime(),
        ];
        DB::table('pushes')->insert($param);

        $param = [
            'status' => '0',
            'user_id' => null,
            'item_id' => null,
            'comment' => 'あいう',
            'created_at' => new DateTime(),
        ];
        DB::table('pushes')->insert($param);

        $param = [
            'status' => '0',
            'user_id' => null,
            'item_id' => null,
            'comment' => '動画が購入されました。評価しましょう。',
            'created_at' => Carbon::now()->subDays(2),
        ];
        DB::table('pushes')->insert($param);

        $param = [
            'status' => '2',
            'user_id' => '4',
            'item_id' => '3',
            'comment' => 'コメントされました。返信しましょう。',
            'created_at' => Carbon::now()->subDays(8),
        ];
        DB::table('pushes')->insert($param);

        $param = [
            'status' => '3',
            'user_id' => '4',
            'item_id' => '4',
            'comment' => '決済関係',
            'created_at' => Carbon::now()->subDays(10),
        ];
        DB::table('pushes')->insert($param);

    }
}
