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
            'user_id'=>'user1',
            'keyword'=>'学習',
            'lesson_id' =>9999
        ]);
    }
}
