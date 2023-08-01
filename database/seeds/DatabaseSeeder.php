<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // こちらの記述がないと、コマンドを実行してもレコードが作成されないので注意しましょう。
        $this->call(UsersTableSeeder::class);
        // $this->call(BooksTableSeeder::class);


    }
}
