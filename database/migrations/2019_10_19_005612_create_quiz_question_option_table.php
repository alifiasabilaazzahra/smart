<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizQuestionOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_question_options', function (Blueprint $table) {
            $table->string('task_question_option_id',6)->primary();
            $table->string('task_question_id',6)->index();
            $table->string('task_question_option',1);
            $table->text('task_question_option_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_question_options');
    }
}
