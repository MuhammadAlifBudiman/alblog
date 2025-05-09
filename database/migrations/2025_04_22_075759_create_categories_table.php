<?php

use Illuminate\Database\Migrations\Migration; // Required to extend the base Migration class for creating database migrations.
use Illuminate\Database\Schema\Blueprint; // Needed to define the structure of the database table.
use Illuminate\Support\Facades\Schema; // Provides methods to interact with the database schema.

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Defines the structure of the 'categories' table in the database.
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Adds an auto-incrementing primary key, essential for uniquely identifying records.
            $table->string('name')->unique(); // Ensures each category has a unique name, preventing duplicates.
            $table->string('slug')->unique(); // Ensures each category has a unique slug for URL-friendly identifiers.
            $table->timestamps(); // Adds 'created_at' and 'updated_at' columns to track record creation and updates.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Removes the 'categories' table from the database when rolling back the migration.
        Schema::dropIfExists('categories');
    }
}
