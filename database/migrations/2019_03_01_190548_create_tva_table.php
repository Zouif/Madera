<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTvaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tva', function(Blueprint $table)
		{
			$table->integer('id_tva', true);
			$table->string('libelle_tva', 50);
			$table->float('taux_tva', 10, 0);
			$table->date('date_effet_tva');
			$table->boolean('activite');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tva');
	}

}
