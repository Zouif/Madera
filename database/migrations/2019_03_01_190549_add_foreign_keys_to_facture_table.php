<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFactureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('facture', function(Blueprint $table)
		{
			$table->foreign('id_devis', 'facture_devis_FK')->references('id_devis')->on('devis')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('facture', function(Blueprint $table)
		{
			$table->dropForeign('facture_devis_FK');
		});
	}

}
