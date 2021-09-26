<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keywords', function (Blueprint $table) {
            $table->string('sessionid');
            $table->renameColumn('user_id', 'userid');
            $table->renameColumn('lesson_id', 'lessonid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keywords', function (Blueprint $table) {
            $table->dropColumn('sessionid');
            $table->renameColumn('userid', 'user_id');
            $table->renameColumn('lessonid', 'lesson_id');
        });
    }
}
