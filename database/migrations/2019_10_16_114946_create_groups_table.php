<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("slug")->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin_group', function (Blueprint $table) {
            $table->integer("admin_id");
            $table->integer("group_id");

            $table->primary(["admin_id", "group_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
        Schema::dropIfExists('admin_group');
        Schema::dropIfExists('group_year');
    }
}
