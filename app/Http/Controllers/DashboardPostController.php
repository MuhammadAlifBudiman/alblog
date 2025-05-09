<?php

namespace App\Http\Controllers;

use App\Models\Category; // Interacts with the Category model to retrieve category data.
use App\Models\Post; // Interacts with the Post model for CRUD operations on posts.
use Illuminate\Http\Request; // Handles HTTP requests and retrieves input data.
use \Cviebrock\EloquentSluggable\Services\SlugService; // Generates unique slugs for posts.
use Illuminate\Support\Facades\Storage; // Interacts with the storage system, particularly S3.
use illuminate\Support\Str; // Provides string manipulation utilities, such as creating excerpts.

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * This method retrieves all posts created by the authenticated user
     * and passes them to the 'dashboard.posts.index' view for display.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get() // Retrieves posts created by the authenticated user.
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * This method returns a view to create a new post, including a list
     * of all available categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all() // Provides a list of all categories for the post creation form.
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * This method validates the request data, uploads the image to S3,
     * and creates a new post in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255', // Ensures the title is provided and does not exceed 255 characters.
            'slug' => 'required|unique:posts', // Ensures the slug is unique for each post.
            'image' => 'required|file|max:255', // Ensures an image is uploaded and its size is within the limit.
            'category_id' => 'required', // Associates the post with a category.
            'body' => 'required' // Ensures the post body is provided.
        ]);

        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images', 's3'); // Uploads the image to S3 storage.
        }

        $validateData['user_id'] = auth()->user()->id; // Associates the post with the authenticated user.
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 100, '...'); // Creates a short excerpt from the post body.

        Post::create($validateData); // Saves the new post in the database.

        return redirect('/dashboard/posts')->with('success', 'New post has been added!'); // Redirects the user with a success message.
    }

    /**
     * Display the specified resource.
     *
     * This method retrieves and displays a specific post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post // Displays the details of a specific post.
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * This method returns a view to edit an existing post, including a list
     * of all available categories.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post, // Provides the post data for editing.
            'categories' => Category::all() // Provides a list of all categories for the edit form.
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * This method validates the request data, updates the post in the database,
     * and handles image replacement if a new image is uploaded.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => 'required|max:255', // Ensures the title is provided and does not exceed 255 characters.
            'category_id' => 'required', // Associates the post with a category.
            'body' => 'required' // Ensures the post body is provided.
        ];

        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts'; // Ensures the slug is unique if it has been changed.
        }

        $validateData = $request->validate($rules); // Validates the input data against the defined rules.

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::disk('s3')->delete($request->oldImage); // Deletes the old image from S3 storage if it exists.
            }
            $validateData['image'] = $request->file('image')->store('post-images', 's3'); // Uploads the new image to S3 storage.
        }

        $validateData['user_id'] = auth()->user()->id; // Associates the post with the authenticated user.
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 100, '...'); // Creates a short excerpt from the post body.

        Post::where('id', $post->id)->update($validateData); // Updates the post in the database.

        return redirect('/dashboard/posts')->with('success', 'Post has been edited!'); // Redirects the user with a success message.
    }

    /**
     * Remove the specified resource from storage.
     *
     * This method deletes the specified post and its associated image
     * from the S3 storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('s3')->delete($post->image); // Deletes the associated image from S3 storage.
        }

        Post::destroy($post->id); // Deletes the post from the database.

        return redirect('/dashboard/posts')->with('success', 'post has been deleted!'); // Redirects the user with a success message.
    }

    /**
     * Generate a unique slug for a post title.
     *
     * This method uses the SlugService to generate a unique slug based
     * on the provided title and returns it as a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title); // Generates a unique slug for the given title.
        return response()->json(['slug' => $slug]); // Returns the generated slug as a JSON response.
    }
}
