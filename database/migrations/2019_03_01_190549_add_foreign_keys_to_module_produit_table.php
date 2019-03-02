<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToModuleProduitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('module_produit', function(Blueprint $table)
		{
			$table->foreign('id_module', 'module_produit_module_FK')->references('id_module')->on('module')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_produit', 'module_produit_produit0_FK')->references('id_produit')->on('produit')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('module_produit', function(Blueprint $table)
		{
			$table->dropForeign('module_produit_module_FK');
			$table->dropForeign('module_produit_produit0_FK');
		});
	}

}
