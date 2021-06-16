<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_subjects', function (Blueprint $table) {
            $table->string('teacher_subject_id')->primary();
            $table->string('teacher_id',50)->index();
            $table->string('subject_id', 10)->index();
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('teacher_subjects');
    }
}
