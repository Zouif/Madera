<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProduitDevisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produit_devis', function(Blueprint $table)
		{
			$table->integer('id_devis');
			$table->integer('id_produit')->index('produit_devis_produit0_FK');
			$table->integer('quantite_produit');
			$table->primary(['id_devis','id_produit']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produit_devis');
	}

}
