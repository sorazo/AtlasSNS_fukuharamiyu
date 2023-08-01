<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //コード記入[ユーザー名、メールアドレス、パスワード]
        DB::table('users')->insert([
            'username'=>'sora',
            'mail'=>'sora@gmail.com',
            'password'=>bcrypt('sorazora'),
        ]);
    }
}
