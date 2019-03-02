<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProduitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('produit', function(Blueprint $table)
		{
			$table->foreign('id_cctp', 'produit_cctp0_FK')->references('id_cctp')->on('cctp')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_coupe_principe', 'produit_coupe_principe2_FK')->references('id_coupe_principe')->on('coupe_principe')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_couverture', 'produit_couverture_FK')->references('id_couverture')->on('couverture')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_gamme', 'produit_gamme1_FK')->references('id_gamme')->on('gamme')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('produit', function(Blueprint $table)
		{
			$table->dropForeign('produit_cctp0_FK');
			$table->dropForeign('produit_coupe_principe2_FK');
			$table->dropForeign('produit_couverture_FK');
			$table->dropForeign('produit_gamme1_FK');
		});
	}

}
