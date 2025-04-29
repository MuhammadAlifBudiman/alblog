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
        return view('login.index', [
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
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

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
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
