<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModuleProduitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('module_produit', function(Blueprint $table)
		{
			$table->integer('id_module');
			$table->integer('id_produit')->index('module_produit_produit0_FK');
			$table->primary(['id_module','id_produit']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('module_produit');
	}

}
