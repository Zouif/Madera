<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGammeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gamme', function(Blueprint $table)
		{
			$table->integer('id_gamme', true);
			$table->string('nom_gamme', 50);
			$table->string('finition_gamme', 50);
			$table->string('huisseries_gamme', 50);
			$table->string('isolant_gamme', 50);
			$table->integer('prix_gamme');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gamme');
	}

}
