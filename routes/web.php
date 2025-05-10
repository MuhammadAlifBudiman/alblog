<?php

use App\Models\Category; // Needed to access the Category model for fetching category data.
use Illuminate\Support\Facades\Route; // Required to define web routes for the application.
use App\Http\Controllers\PostController; // Needed to handle requests related to posts.
use App\Http\Controllers\LoginController; // Required for handling login-related actions.
use App\Http\Controllers\RegisterController; // Needed for handling user registration actions.
use App\Http\Controllers\DashboardPostController; // Required for managing posts in the dashboard.
use App\Http\Controllers\AdminCategoryController; // Needed for managing categories in the admin dashboard.
use App\Models\Post; // Import the Post model to fetch posts for the home page

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        'title' => 'Home', // Needed to pass the page title to the home view.
        'newlyPosts' => Post::latest()->take(10)->get(), // Fetch the 5 most recent posts.
        'popularPosts' => Post::orderBy('view_count', 'desc')->take(10)->get(), // Fetch the 5 most viewed posts.
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About', // Needed to pass the page title to the about view.
        'name' => 'Muhammad Alif Budiman', // Required to display the user's name on the about page.
        'email' => 'alifm2101@gmail.com', // Needed to display the user's email on the about page.
        'image' => 'my-photo.png' // Required to display the user's photo on the about page.
    ]);
});

Route::get('/posts', [PostController::class, 'index']); // Needed to display a list of posts using the PostController.

Route::get('posts/{post:slug}', [PostController::class, 'show']); // Required to display a single post based on its slug.

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories', // Needed to pass the page title to the categories view.
        'categories' => Category::all() // Required to fetch and display all categories.
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); // Needed to show the login page only to unauthenticated users.
Route::post('/login', [LoginController::class, 'authenticate']); // Required to handle login form submissions.
Route::post('/logout', [LoginController::class, 'logout']); // Needed to handle user logout actions.

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest'); // Required to show the registration page only to unauthenticated users.
Route::post('/register', [RegisterController::class, 'store']); // Needed to handle user registration form submissions.

Route::get('/dashboard', function () {
    return view('dashboard.index'); // Required to display the dashboard index page.
})->middleware('auth'); // Needed to restrict access to authenticated users only.

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug']); // Required to check the slug for a post in the dashboard.
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth'); // Needed to manage posts in the dashboard, restricted to authenticated users.

Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin'); // Required to manage categories in the admin dashboard, restricted to admin users.
