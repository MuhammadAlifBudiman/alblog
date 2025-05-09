<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creating the 'posts' table to store blog post data
        Schema::create('posts', function (Blueprint $table) {
            // Adding an auto-incrementing primary key for unique identification of posts
            $table->id();
            // Adding a foreign key to associate posts with categories
            $table->foreignId('category_id');
            // Adding a foreign key to associate posts with users (authors)
            $table->foreignId('user_id');
            // Adding a title column to store the title of the post
            $table->string('title');
            // Adding a unique slug column for SEO-friendly URLs
            $table->string('slug')->unique();
            // Adding an optional image column to store the post's featured image
            $table->string('image')->nullable();
            // Adding an excerpt column to store a short summary of the post
            $table->text('excerpt');
            // Adding a body column to store the main content of the post
            $table->text('body');
            // Adding a timestamp column to indicate when the post was published
            $table->timestamp('published_at')->nullable();
            // Adding created_at and updated_at columns to track record creation and updates
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Dropping the 'posts' table to reverse the migration
        Schema::dropIfExists('posts');
    }
}
