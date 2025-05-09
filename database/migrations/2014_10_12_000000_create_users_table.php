<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Needed to uniquely identify each user in the database.
            $table->string('name'); // Needed to store the user's full name for identification purposes.
            $table->string('username')->unique(); // Needed to provide a unique identifier for user login or profile access.
            $table->boolean('is_admin')->default(false); // Needed to differentiate between regular users and administrators.
            $table->string('email')->unique(); // Needed to ensure each user has a unique email for communication and login.
            $table->timestamp('email_verified_at')->nullable(); // Needed to track whether the user's email has been verified.
            $table->string('password'); // Needed to securely store the user's password for authentication.
            $table->rememberToken(); // Needed to support "remember me" functionality for user sessions.
            $table->timestamps(); // Needed to track when the user was created and last updated.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users'); // Needed to clean up the database by removing the users table if the migration is rolled back.
    }
}
