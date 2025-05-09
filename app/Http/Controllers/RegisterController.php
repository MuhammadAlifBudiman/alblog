<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * This method returns the registration view with a title.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Return the registration view to allow users to access the registration page.
        return view('register.index', [
            'title' => 'Register', // Provide a title for the registration page to enhance user experience.
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * This method validates the registration data, hashes the password,
     * creates a new user in the database, and redirects to the login page
     * with a success message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming registration data to ensure it meets the required criteria.
        $validatedData = $request->validate([
            'name' => 'required|max:255', // Ensure the name is provided and does not exceed the maximum length.
            'username' => ['required', 'min:3', 'max:255', 'unique:users'], // Ensure the username is unique and meets length requirements.
            'email' => 'required|email:dns|unique:users', // Ensure the email is valid, unique, and uses a DNS-compliant format.
            'password' => 'required|min:5|max:255' // Ensure the password meets minimum and maximum length requirements.
        ]);

        // Hash the password to securely store it in the database.
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create a new user in the database with the validated data.
        User::create($validatedData);

        // Redirect the user to the login page with a success message to inform them of successful registration.
        return redirect('/login')->with('success', 'Registration successfull! Please login');
    }
}
