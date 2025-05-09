<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * This method returns the login view with a title.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Return the login view to allow users to input their credentials.
        return view('login.index', [
            // Provide a title for the login page to enhance user experience.
            'title' => 'Login',
        ]);
    }

    /**
     * Authenticate the user.
     *
     * This method validates the login credentials, attempts to authenticate
     * the user, and regenerates the session on success. If authentication fails,
     * it redirects back with an error message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        // Validate the user input to ensure email and password are provided and correctly formatted.
        $credentials = $request->validate([
            'email' => 'required|email:dns', // Ensure the email is required and follows a valid DNS format.
            'password' => 'required' // Ensure the password is required for authentication.
        ]);

        // Attempt to authenticate the user with the provided credentials.
        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent session fixation attacks.
            $request->session()->regenerate();
            // Redirect the user to their intended destination after successful login.
            return redirect()->intended('/dashboard');
        }

        // Redirect back with an error message if authentication fails to inform the user.
        return back()->with('loginError', 'Login failed!');
    }

    /**
     * Log the user out.
     *
     * This method logs out the authenticated user, invalidates the session,
     * regenerates the CSRF token, and redirects to the homepage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Log out the currently authenticated user to end their session.
        Auth::logout();

        // Invalidate the current session to ensure it cannot be reused.
        request()->session()->invalidate();

        // Regenerate the CSRF token to prevent cross-site request forgery attacks.
        request()->session()->regenerateToken();

        // Redirect the user to the homepage after logging out.
        return redirect('/');
    }
}
