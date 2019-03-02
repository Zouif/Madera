<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client', function(Blueprint $table)
		{
			$table->integer('id_client', true);
			$table->string('nom_client', 50);
			$table->string('prenom_client', 50);
			$table->string('adresse_client', 50);
			$table->string('nom_collectivite', 50);
			$table->string('telephone_client', 50);
			$table->string('mail_client', 50);
			$table->string('ref_client', 50)->unique('client_AK');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('client');
	}

}
