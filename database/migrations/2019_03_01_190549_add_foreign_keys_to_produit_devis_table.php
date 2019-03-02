<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProduitDevisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('produit_devis', function(Blueprint $table)
		{
			$table->foreign('id_devis', 'produit_devis_devis_FK')->references('id_devis')->on('devis')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_produit', 'produit_devis_produit0_FK')->references('id_produit')->on('produit')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('produit_devis', function(Blueprint $table)
		{
			$table->dropForeign('produit_devis_devis_FK');
			$table->dropForeign('produit_devis_produit0_FK');
		});
	}

}
