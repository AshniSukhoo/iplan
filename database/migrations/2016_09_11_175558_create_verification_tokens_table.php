<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerificationTokensTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('verification_tokens', function(Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->string('token', '50');
            $table->timestamps();
		});

		Schema::table('verification_tokens', function (Blueprint $table) {
			$table->foreign('user_id')
				  ->references('id')
				  ->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('verification_tokens', function (Blueprint $table) {
			$table->dropForeign(['user_id']);
		});

		Schema::drop('verification_tokens');
	}

}
