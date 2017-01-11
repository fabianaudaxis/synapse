<?php
use Illuminate\Database\Migrations\Migration;
class ConfideSetupEwbsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {

		// Creates the users table
		Schema::create ( 'users', function ($table) {
			$table->increments ( 'id' );
			$table->string ( 'username' );
			$table->string ( 'email' );
			$table->string ( 'password' );
			$table->string ( 'confirmation_code' );
			$table->string ( 'remember_token' )->nullable ();
			$table->boolean ( 'confirmed' )->default ( false );
            $table->timestamps ();
            $table->softDeletes();
		} );
		
		// Creates password reminders table
		Schema::create ( 'password_reminders', function ($table) {
			$table->string ( 'email' );
			$table->string ( 'token' );
			$table->timestamp ( 'created_at' );
		} );

	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop ( 'password_reminders' );
		Schema::drop ( 'users' );
	}
}
