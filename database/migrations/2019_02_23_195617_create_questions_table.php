<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("character_id");
            $table->integer("quiz_id");
            $table->integer("points");
            $table->text("body");
            $table->timestamps();
        });

        Schema::create('question_user', function (Blueprint $table) {
            $table->integer('question_id');
            $table->integer('user_id');
            $table->text("answer");
            $table->integer("points")->default(0);
            $table->timestamp("answered_at");

            $table->primary(["question_id", "user_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_user');
    }
}
