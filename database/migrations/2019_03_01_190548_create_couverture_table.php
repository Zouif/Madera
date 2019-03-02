<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouvertureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('couverture', function(Blueprint $table)
		{
			$table->integer('id_couverture', true);
			$table->string('nom_couverture', 50);
			$table->integer('prix_couverture');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('couverture');
	}

}
