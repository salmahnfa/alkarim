<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) { // or if (!Auth::check()) {
            // User is not logged in, redirect to login page
            return redirect()->route('login');
        }

        $userRole = $request->user()->role->nama;
        $requiredRole = $this->getRequiredRole($request);

        if ($userRole !== $requiredRole) {
            // Redirect or abort if the user doesn't have the required role
            return redirect()->route('unauthorized');
        }

        return $next($request);
    }

    private function getRequiredRole(Request $request)
    {
        $routePrefix = $request->route()->getPrefix();
        $roleIdMap = [
            'admin-pusat' => 'Administrator Pusat',
            'ppq' => 'Pengembangan Pembelajaran Quran',
            'admin-unit' => 'Administrator Unit',
            'guru-quran' => 'Guru Quran',
        ];

        foreach ($roleIdMap as $prefix => $roleName) {
            if (str_starts_with($routePrefix, $prefix)) {
                return $roleName;
            }
        }

        // If no match, throw an exception
        throw new Exception('Unknown role');
    }
    
}
