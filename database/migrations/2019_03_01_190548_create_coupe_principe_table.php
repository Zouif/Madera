<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoupePrincipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupe_principe', function(Blueprint $table)
		{
			$table->integer('id_coupe_principe', true);
			$table->string('nom_coupe_principe', 50);
			$table->integer('prix_coupe_principe');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('coupe_principe');
	}

}
