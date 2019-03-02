<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCctpTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cctp', function(Blueprint $table)
		{
			$table->integer('id_cctp', true);
			$table->string('nom_cctp', 50);
			$table->integer('prix_cctp');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cctp');
	}

}
