<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('admin.login');
        }

        $adminRoleNames = [
            'Super Admin',
            'Branch Manager',
            'Loan Officer',
            'Teller',
            'Accountant',
            'HR Officer',
            'Auditor',
        ];

        $isAdminUser = $request->user()->roles()->whereIn('name', $adminRoleNames)->exists();

        if (! $isAdminUser) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access the admin panel.');
        }

        return $next($request);
    }
}
