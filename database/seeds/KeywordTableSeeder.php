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
            'user_id'=>'user2',
            'keyword'=>'インターン',
            'lesson_id' =>9999
        ]);
    }
}
