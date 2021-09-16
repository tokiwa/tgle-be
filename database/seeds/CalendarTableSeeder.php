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
        // TGLE3
        $calendar = Calendar::create([
            'lesson_at'     => '2012-07-16',
            'course_id'    => '',
            'issuer' => 'https://c3.yujitokiwa.jp/moodle',
            'deployment' => '',
        ]);
    }
}
