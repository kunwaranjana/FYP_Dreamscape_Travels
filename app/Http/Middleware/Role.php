<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


     // handle() is a function which accept three parameters: $request, $next, $role
     // $request - The incoming HTTP request.
     //$next - A Closure (callback function) that forwards the request to the next middleware or controller
     //$role - A role that needs to be checked.

    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($request->user()->role != $role) {
            return redirect('/'); 
        }

        return $next($request); 
    }

    // $request->user() fetches the currently authenticated user.
    // $request->user()->role retrieves the role assigned to that user.
    // If the user's role does not match the required $role, they are redirected to / (home page).

    // If the user has the required role, the request is forwarded to the next middleware or controller for further processing.
}
