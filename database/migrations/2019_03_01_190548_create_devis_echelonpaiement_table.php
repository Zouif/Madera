<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevisEchelonpaiementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('devis_echelonpaiement', function(Blueprint $table)
		{
			$table->integer('id_devis');
			$table->integer('id_echelon_paiement')->index('devis_echelonpaiement_echelon_paiement0_FK');
			$table->primary(['id_devis','id_echelon_paiement']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('devis_echelonpaiement');
	}

}
