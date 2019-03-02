<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('devis', function(Blueprint $table)
		{
			$table->integer('id_devis', true);
			$table->date('date_devis');
			$table->integer('duree_validite_devis');
			$table->decimal('taux_horaire_main_oeuvre', 10, 0);
			$table->decimal('montant_frais_deplacement', 10, 0);
			$table->decimal('prix_prestation', 10, 0);
			$table->string('modalite_decompte_passe');
			$table->decimal('taux_tva', 10, 0);
			$table->decimal('montant_tva', 10, 0);
			$table->decimal('prix_total_ht', 10, 0);
			$table->string('ref_devis', 50)->unique('devis_AK');
			$table->integer('id_etat_devis')->index('devis_etat_devis_FK');
			$table->integer('id_entreprise')->index('devis_entreprise0_FK');
			$table->integer('id_projet')->index('devis_projet1_FK');
			$table->integer('id_tva')->index('devis_tva2_FK');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('devis');
	}

}
