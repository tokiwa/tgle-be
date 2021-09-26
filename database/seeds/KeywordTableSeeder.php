<?php

use Illuminate\Database\Seeder;

class KeywordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keywords')->insert([
            'userid'=>'user2',
            'keyword'=>'インターン',
            'lessonid' =>9999,
            'sessionid' => '123456'
        ]);
    }
}
