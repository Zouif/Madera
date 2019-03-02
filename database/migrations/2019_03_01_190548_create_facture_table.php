<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFactureTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('facture', function(Blueprint $table)
		{
			$table->integer('id_facture', true);
			$table->date('date_emission');
			$table->string('cee');
			$table->integer('id_devis')->unique('facture_devis_AK');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('facture');
	}

}
