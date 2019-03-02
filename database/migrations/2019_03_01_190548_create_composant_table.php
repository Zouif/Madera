<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComposantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('composant', function(Blueprint $table)
		{
			$table->integer('id_composant', true);
			$table->string('nom_composant', 50);
			$table->string('caracteristique_composant', 50);
			$table->integer('prix_composant');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('composant');
	}

}
