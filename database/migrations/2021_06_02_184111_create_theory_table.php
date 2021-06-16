<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTheoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theories', function (Blueprint $table) {
            $table->string('theory_id', 6)->primary();
            $table->string('subject_id', 10)->index();
            $table->text('theory_name');
            $table->text('theory_description');
            $table->text('theory_url');
            $table->enum('theory_type', ['Video', 'File']);
            $table->foreign('subject_id', 'FK_THEORY_SUBJECT_ID')->references('subject_id')->on('subjects')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('theories');
    }
}
