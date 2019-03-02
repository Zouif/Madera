<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProjetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projet', function(Blueprint $table)
		{
			$table->foreign('id_client', 'projet_client_FK')->references('id_client')->on('client')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_user', 'projet_user0_FK')->references('id_user')->on('user')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projet', function(Blueprint $table)
		{
			$table->dropForeign('projet_client_FK');
			$table->dropForeign('projet_user0_FK');
		});
	}

}
