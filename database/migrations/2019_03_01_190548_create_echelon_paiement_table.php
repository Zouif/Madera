<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEchelonPaiementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('echelon_paiement', function(Blueprint $table)
		{
			$table->integer('id_echelon_paiement', true);
			$table->decimal('signature_echelon_paiement', 10, 0);
			$table->decimal('permis_construire_echelon_paiement', 10, 0);
			$table->decimal('chantier_echelon_paiement', 10, 0);
			$table->decimal('fondation_echelon_paiement', 10, 0);
			$table->decimal('mur_echelon_paiement', 10, 0);
			$table->decimal('mise_hors_echelon_paiement', 10, 0);
			$table->decimal('travaux_echelon_paiement', 10, 0);
			$table->decimal('remise_clef_echelon_paiement', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('echelon_paiement');
	}

}
