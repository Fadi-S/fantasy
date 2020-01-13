<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("slug");
            $table->integer("group_id");
            $table->integer("type_id");
            $table->boolean("allow_late")->default(0);
            $table->double("late_penalty")->default(1);
            $table->boolean("show_answers")->default(1);
            $table->date("start");
            $table->date("end");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitions');
    }
}
