<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indicators')->insert(
            [
                [
                    'target_id' => 1,
                    'contents' => '新しいサービスの紹介プログラムを開始する',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'target_id' => 1,
                    'contents' => 'サービスの配信パートナーとの新規契約を3件獲得する',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'target_id' => 1,
                    'contents' => '収益に関する4つのテストを実施し、収益化を促進する要因を特定する',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'target_id' => 2,
                    'contents' => '3つの業界イベントで講演を行う',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'target_id' => 2,
                    'contents' => 'サービスについてブログで紹介してくれるユーザーを10人獲得する',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'target_id' => 2,
                    'contents' => 'サービスの商品レビューのスコアを１ポイント伸ばす',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]
        );
    }
}
