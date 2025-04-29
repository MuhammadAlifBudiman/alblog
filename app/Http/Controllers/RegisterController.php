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
        return view('register.index', [
            'title' => 'Register',
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration successfull! Please login');
    }
}
