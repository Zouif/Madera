<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComposantModuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('composant_module', function(Blueprint $table)
		{
			$table->integer('id_composant');
			$table->integer('id_module')->index('composant_module_module0_FK');
			$table->primary(['id_composant','id_module']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('composant_module');
	}

}
