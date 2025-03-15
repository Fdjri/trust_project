<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
namespace App\Http\Middleware;


class BranchMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && $request->route('branch_id') !== Auth::user()->branch_id) {
            abort(403, 'Akses Ditolak');
        }

        return $next($request);
    }
}
