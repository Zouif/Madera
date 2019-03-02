<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projet', function(Blueprint $table)
		{
			$table->integer('id_projet', true);
			$table->string('nom_projet', 50);
			$table->date('date_projet');
			$table->string('ref_projet', 50)->unique('projet_AK');
			$table->integer('id_client')->index('projet_client_FK');
			$table->integer('id_user')->index('projet_user0_FK');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projet');
	}

}
