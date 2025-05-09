<?php

namespace App\Http\Controllers; // Define the namespace for the controller class.

use App\Models\Category; // Interact with the Category model for retrieving category data.
use Illuminate\Http\Request; // Handle HTTP requests in the controller methods.
use App\Models\Post; // Interact with the Post model for retrieving post data.
use App\Models\User; // Interact with the User model for retrieving author data.

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     *
     * This method retrieves posts from the database, applies filters for
     * search, category, and author, and paginates the results. The posts
     * are then passed to the 'posts' view for display.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $title = ''; // Initializes the title variable to append dynamic content based on filters.
        if (request('category')) { // Checks if a category filter is applied in the request.
            $category = Category::firstWhere('slug', request('category')); // Retrieves the category matching the slug from the request.
            $title = ' in ' . $category->name; // Appends the category name to the title for display purposes.
        }

        if (request('author')) { // Checks if an author filter is applied in the request.
            $author = User::firstWhere('username', request('author')); // Retrieves the author matching the username from the request.
            $title = ' by ' . $author->name; // Appends the author name to the title for display purposes.
        }

        return view('posts', [ // Returns the 'posts' view with the necessary data for rendering.
            "title" => "All Posts" . $title, // Sets the page title dynamically based on filters.
            "active" => 'posts', // Indicates the active navigation item for UI purposes.
            "posts" => Post::latest() // Retrieves the latest posts from the database.
                ->filter(request(['search', 'category', 'author'])) // Applies search, category, and author filters to the query.
                ->paginate(7) // Paginates the results to display 7 posts per page.
                ->withQueryString() // Preserves query string parameters for pagination links.
        ]);
    }

    /**
     * Display a single post.
     *
     * This method retrieves a specific post and passes it to the 'post'
     * view for display.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('post', [ // Returns the 'post' view with the necessary data for rendering.
            "title" => "Single Post", // Sets the page title for the single post view.
            "active" => 'posts', // Indicates the active navigation item for UI purposes.
            "post" => $post // Passes the retrieved post to the view for display.
        ]);
    }
}
