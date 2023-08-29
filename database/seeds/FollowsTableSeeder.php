<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //コード記入[ユーザー名、メールアドレス、パスワード]
        DB::table('follows')->insert([
            'following_id'=>'way',
            'followed'=>'ろっこく',
        ]);
    }
}
