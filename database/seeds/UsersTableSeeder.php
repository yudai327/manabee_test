<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 開発用ユーザーを定義
        $param = [
            'name' => 'develop_user',
            'email' => 'yudai0316k@gmail.com',
            'password' => bcrypt('11111111'), // この場合、「11111111」でログインできる
            'nickname' => 'dev',
            'tel' => '12312341234',
            'detail' => 'よろしくしてね。私が彼方との恋ってなんだろうねー。そしてこれから私たには一体どうなるのか。それは誰にもわかりませーん。',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ];
        DB::table('users')->insert($param);

        //usersテーブルに仮にデータ入力
        $param = [
            'name' => 'hirame',
            'email' => 'hirame_0202@icloud.com',
            'password' => bcrypt('11111111'), // この場合、「11111111」でログインできる
            'nickname' => 'chan',
            'tel' => '12312341234',
            'detail' => '平田です。よろしくしてね。私が彼方との恋ってなんだろうねー。そしてこれから私たには一体どうなるのか。それは誰にもわかりませーん。',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'satou',
            'email' => '22@11.11',
            'password' => 'asdf0000',
            'nickname' => 'sattton',
            'tel' => '12312341234',
            'detail' => 'よろしくしてちゃん。チャンチャンちゃん太郎。チャン太郎はとってもこう、行為いったどういったんだろう。',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ];

        DB::table('users')->insert($param);
        $param = [
            'name' => 'baachan',
            'email' => '13@11.11',
            'password' => 'asdf0000',
            'nickname' => 'baachan',
            'tel' => '12312341234',
            'detail' => '老いぼれをよろしくしてね。老いぼれレボリューションーーー・クラえーーこの俺の悲報のひっっとオンパレード。',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ];
        DB::table('users')->insert($param);

        // モデルファクトリーで定義したテストユーザーを 100 作成
        factory(App\User::class, 20)->create();

    }
}
