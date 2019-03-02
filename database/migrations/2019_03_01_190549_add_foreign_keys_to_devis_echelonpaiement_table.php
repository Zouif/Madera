<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDevisEchelonpaiementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('devis_echelonpaiement', function(Blueprint $table)
		{
			$table->foreign('id_devis', 'devis_echelonpaiement_devis_FK')->references('id_devis')->on('devis')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_echelon_paiement', 'devis_echelonpaiement_echelon_paiement0_FK')->references('id_echelon_paiement')->on('echelon_paiement')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('devis_echelonpaiement', function(Blueprint $table)
		{
			$table->dropForeign('devis_echelonpaiement_devis_FK');
			$table->dropForeign('devis_echelonpaiement_echelon_paiement0_FK');
		});
	}

}
