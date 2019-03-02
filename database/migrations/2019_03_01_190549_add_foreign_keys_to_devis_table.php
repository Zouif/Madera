<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDevisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('devis', function(Blueprint $table)
		{
			$table->foreign('id_entreprise', 'devis_entreprise0_FK')->references('id_entreprise')->on('entreprise')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_etat_devis', 'devis_etat_devis_FK')->references('id_etat_devis')->on('etat_devis')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_projet', 'devis_projet1_FK')->references('id_projet')->on('projet')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_tva', 'devis_tva2_FK')->references('id_tva')->on('tva')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('devis', function(Blueprint $table)
		{
			$table->dropForeign('devis_entreprise0_FK');
			$table->dropForeign('devis_etat_devis_FK');
			$table->dropForeign('devis_projet1_FK');
			$table->dropForeign('devis_tva2_FK');
		});
	}

}
