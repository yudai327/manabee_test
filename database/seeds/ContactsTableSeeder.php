<?php

use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //contactsテーブルに仮にデータ入力
        $param = [
            'id' => '1',
            'name' => 'taro',
            'user_id' => '5',
            'email' => '11@11.11',
            'comment' => 'よろしくしてね。',
        ];
        DB::table('contacts')->insert($param);

        $param = [
            'id' => '2',
            'name' => 'jiro',
            'user_id' => '6',
            'email' => '12@11.11',
            'comment' => 'ハロー！',
        ];
        DB::table('contacts')->insert($param);
        
        $param = [
            'id' => '3',
            'name' => 'サブロー',
            'user_id' => '7',
            'email' => '13@11.11',
            'comment' => 'グッバイばい？',
        ];
        DB::table('contacts')->insert($param);

    }
}
