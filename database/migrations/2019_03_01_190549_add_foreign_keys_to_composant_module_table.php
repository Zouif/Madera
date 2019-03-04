<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComposantModuleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('composant_module', function(Blueprint $table)
		{
			$table->foreign('id_composant', 'composant_module_composant_FK')->references('id_composant')->on('composant')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_module', 'composant_module_module0_FK')->references('id_module')->on('modules')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('composant_module', function(Blueprint $table)
		{
			$table->dropForeign('composant_module_composant_FK');
			$table->dropForeign('composant_module_module0_FK');
		});
	}

}
