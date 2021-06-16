<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTheoryClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theory_classes', function (Blueprint $table) {
            $table->string('theory_class_id', 6)->primary();
            $table->string('theory_id',6)->index();
            $table->string('student_class_id', 10)->index();
            $table->foreign('student_class_id')->references('student_class_id')->on('student_classes')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('theory_id')->references('theory_id')->on('theories')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('theory_classes');
    }
}
