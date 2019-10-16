<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("category_id");
            $table->string("name");
            $table->text("picture")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('character_user', function (Blueprint $table) {
            $table->integer('character_id');
            $table->integer('user_id');
            $table->integer('quiz_id');

            $table->boolean("captain")->default(0);

            $table->primary(["character_id", "user_id", "quiz_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
        Schema::dropIfExists('character_user');
    }
}
