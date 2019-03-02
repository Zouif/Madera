<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntrepriseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entreprise', function(Blueprint $table)
		{
			$table->integer('id_entreprise', true);
			$table->string('adresse');
			$table->string('telephone');
			$table->string('rs');
			$table->integer('siret');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entreprise');
	}

}
