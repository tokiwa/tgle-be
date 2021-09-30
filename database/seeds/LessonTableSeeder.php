<?php

use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->insert([
            'academicyear'=>2021,
            'label'=>'u3003',
            'lessontitle' =>'グループ学習 2021-9-30'
        ]);
    }
}
