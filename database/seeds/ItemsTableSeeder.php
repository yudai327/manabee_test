<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Item;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //itemsテーブルに仮にデータ入力
        $param = [
            'title' => 'pre0,con1適当なたいとる入力1',
            'user_id' => '1',
            'detail' => '1kokonihaこの動画の詳細なことについて自由に作者が記載をするところですよー。',
            'price' => '10000',
            'path' => '1239',
            'image_path' => null,
            'course_id' => '1',
            'preview_id' => null,
            'preview_flg' => '0',
            'release_flg' => '0',
            'convert_flg' => '1',
            'delete_flg' => '0',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ];
        DB::table('items')->insert($param);
        $param = [
            'title' => 'con0,pre1,適当なたいとる入力',
            'user_id' => '2',
            'detail' => '2kokonihaこの動画の詳細なことについて自由に作者が記載をするところですよー。',
            'price' => '1000',
            'path' => '1239',
            'image_path' => null,
            'course_id' => '1',
            'preview_id' => null,
            'preview_flg' => '0',
            'release_flg' => '0',
            'convert_flg' => '0',
            'delete_flg' => '0',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ];
        DB::table('items')->insert($param);
        $param = [
            'title' => '3適当なたいとる入力',
            'user_id' => '1',
            'detail' => 'con1,pre0,kokonihaこの動画の詳細なことについて自由に作者が記載をするところですよー。',
            'price' => '3000',
            'path' => '1239',
            'image_path' => null,
            'course_id' => '1',
            'preview_id' => null,
            'preview_flg' => '0',
            'release_flg' => '0',
            'convert_flg' => '1',
            'delete_flg' => '0',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ];
        DB::table('items')->insert($param);
        $param = [
            'title' => 'pre0,con1,4適当なたいとる入力',
            'user_id' => '1',
            'detail' => '4kokonihaこの動画の詳細なことについて自由に作者が記載をするところですよー。',
            'price' => '4000',
            'path' => '1239',
            'image_path' => null,
            'course_id' => '1',
            'preview_id' => null,
            'preview_flg' => '0',
            'release_flg' => '0',
            'convert_flg' => '1',
            'delete_flg' => '0',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ];
        DB::table('items')->insert($param);
        $param = [
            'title' => 'pre0,con1,5適当なたいとる入力',
            'user_id' => '2',
            'detail' => '5kokonihaこの動画の詳細なことについて自由に作者が記載をするところですよー。',
            'price' => '5500',
            'path' => '1239',
            'image_path' => null,
            'course_id' => '1',
            'preview_id' => null,
            'preview_flg' => '0',
            'release_flg' => '0',
            'convert_flg' => '1',
            'delete_flg' => '0',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ];
        DB::table('items')->insert($param);
        $param = [
            'title' => 'pre0,con1,6適当なたいとる入力',
            'user_id' => '3',
            'detail' => '6kokonihaこの動画の詳細なことについて自由に作者が記載をするところですよー。',
            'price' => '60000',
            'path' => '1239',
            'image_path' => null,
            'course_id' => '1',
            'preview_id' => null,
            'preview_flg' => '0',
            'release_flg' => '0',
            'convert_flg' => '1',
            'delete_flg' => '0',
            'created_at' => Carbon::today(),
            'updated_at' => Carbon::today()
        ];
        DB::table('items')->insert($param);

        factory(Item::class, 50)->create();

    }
}
