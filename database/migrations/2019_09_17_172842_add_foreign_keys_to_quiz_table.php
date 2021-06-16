<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('task_category_id')->references('task_category_id')->on('task_categories')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('task_classes', function (Blueprint $table) {
            $table->foreign('student_class_id')->references('student_class_id')->on('student_classes')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('task_schedules', function (Blueprint $table) {
            $table->foreign('task_id')->references('task_id')->on('tasks')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('task_questions', function (Blueprint $table) {
            $table->foreign('task_id')->references('task_id')->on('tasks')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('tasks', function(Blueprint $table)
        {
            $table->foreign('user_id')->references('user_id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });

        Schema::table('task_classes', function(Blueprint $table)
        {
            $table->foreign('task_id')->references('task_id')->on('tasks')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
