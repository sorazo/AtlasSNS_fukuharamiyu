<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
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
        DB::table('posts')->insert([
            'user_id'=>'sora',
            'post'=>'初投稿',
        ]);
    }
}
