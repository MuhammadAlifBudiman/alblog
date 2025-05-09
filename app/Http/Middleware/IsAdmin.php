<?php

namespace App\Http\Middleware; // Defines the namespace for the middleware, ensuring it is autoloaded correctly.

use Closure; // Imports the Closure class, which is required to define the middleware's handle method.
use Illuminate\Http\Request; // Imports the Request class to type-hint the incoming HTTP request.

class IsAdmin // Declares the middleware class, which will be used to check if a user is an admin.
{
    /**
     * Handle an incoming request.
     *
     * This middleware checks if the authenticated user is an admin.
     * If the user is not an admin, it aborts with a 403 status code.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) // Defines the middleware logic to process the request and pass it to the next middleware.
    {
        if (!auth()->check() || !auth()->user()->is_admin) { // Ensures the user is authenticated and has admin privileges before proceeding.
            abort(403); // Stops further processing and returns a 403 Forbidden response if the user is not an admin.
        }
        return $next($request); // Passes the request to the next middleware or controller if the user is an admin.
    }
}
