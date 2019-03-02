<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProduitTvaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produit_tva', function(Blueprint $table)
		{
			$table->integer('id_produit');
			$table->integer('id_tva')->index('produit_tva_tva0_FK');
			$table->primary(['id_produit','id_tva']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produit_tva');
	}

}
