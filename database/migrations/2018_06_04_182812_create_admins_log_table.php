<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id');
            $table->integer('logable_id');
            $table->string('logable_type');
            $table->longText('message')->nullable();
            $table->timestamp('done_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins_log');
    }
}
