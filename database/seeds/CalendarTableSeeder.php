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
            'lessonid'=>'9997',
            'courseid' =>'u3004',
            'issuer'=>'https://c3.yujitokiwa.jp',
            'deployment' =>'3',
            'schoolyear' =>'2021'
        ]);
    }
}
