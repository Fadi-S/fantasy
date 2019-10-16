<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->integer("max_minutes");
            $table->timestamp("start_date")->nullable();
            $table->timestamp("end_date")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('quiz_user', function (Blueprint $table) {
            $table->integer('quiz_id');
            $table->integer('user_id');
            $table->timestamp("started_at")->nullable();
            $table->timestamp("ended_at")->nullable();

            $table->primary(["quiz_id", "user_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
        Schema::dropIfExists('quiz_user');
    }
}
