<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $adminEmails = [
            'admin1@admin.com',
            'admin2@admin.com',
            'admin3@admin.com'
        ];

        if (auth()->check() && in_array(auth()->user()->email, $adminEmails)) {
            return $next($request);
        }

        // Si no es admin, redirigir a la tienda
        return redirect()->route('tienda');
    }
}