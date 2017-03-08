<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;


class ModifyUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$output=new ConsoleOutput();
		$output->writeln("Modification de la table users");

		$exists=DB::select("
		SELECT column_name 
		FROM information_schema.columns 
		WHERE table_name='users' and column_name='deleted_at';");
		
		if(!empty($exists))
			$output->writeln("La colonne deleted_at existe déjà");
		else {
			Schema::table('users', function(Blueprint $table) {
				$table->softDeletes();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$output=new ConsoleOutput();
		$output->writeln("Annulation des modification de la table users");

		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('deleted_at');
		});
	}
}
