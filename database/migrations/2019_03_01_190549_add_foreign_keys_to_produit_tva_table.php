<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProduitTvaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('produit_tva', function(Blueprint $table)
		{
			$table->foreign('id_produit', 'produit_tva_produit_FK')->references('id_produit')->on('produit')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_tva', 'produit_tva_tva0_FK')->references('id_tva')->on('tva')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('produit_tva', function(Blueprint $table)
		{
			$table->dropForeign('produit_tva_produit_FK');
			$table->dropForeign('produit_tva_tva0_FK');
		});
	}

}
