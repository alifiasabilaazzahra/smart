<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('student_id',50)->primary();
            $table->string('user_id',6)->index();
            $table->string('student_class_id',10)->index('student_student_class_FK');
            $table->string('student_name', 100);
            $table->enum('student_gender',['laki-laki','perempuan'])->nullable();
            $table->enum('student_status', ['Lulus', 'Belum Lulus'])->nullable();
            $table->year('student_start')->nullable();
            $table->year('student_end')->nullable();
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
        Schema::dropIfExists('students');
    }
}
