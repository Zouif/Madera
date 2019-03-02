<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProduitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produit', function(Blueprint $table)
		{
			$table->integer('id_produit', true);
			$table->string('nom_produit', 50);
			$table->decimal('taux_tva', 10, 0);
			$table->decimal('prix_produit_ht', 10, 0);
			$table->integer('id_couverture')->index('produit_couverture_FK');
			$table->integer('id_cctp')->index('produit_cctp0_FK');
			$table->integer('id_gamme')->index('produit_gamme1_FK');
			$table->integer('id_coupe_principe')->index('produit_coupe_principe2_FK');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produit');
	}

}
