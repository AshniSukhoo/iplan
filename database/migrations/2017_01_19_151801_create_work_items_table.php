<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('assigned_user_id')->nullable();
            $table->string('title');
            $table->string('type');
            $table->unsignedInteger('priority');
            $table->unsignedInteger('estimated_time');
            $table->unsignedInteger('parent_id')->nullable();
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('work_items', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('assigned_user_id')->references('id')->on('users');
            $table->foreign('parent_id')->references('id')->on('work_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_items', function (Blueprint $table){
            $table->dropForeign(['user_id', 'project_id', 'assigned_user_id', 'parent_id']);
        });
        Schema::dropIfExists('work_items');
    }
}
