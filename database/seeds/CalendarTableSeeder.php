<?php

use Illuminate\Database\Seeder;

class CalendarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendars')->insert([
            'lesson_at'=>'2021-09-27',
            'lesson_id'=>'9999',
            'course_id' =>'u3003',
            'issuer'=>'https://c3.yujitokiwa.jp',
            'deployment' =>'3'
        ]);
    }
}
