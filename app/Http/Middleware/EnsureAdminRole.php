<?php
namespace App\Http\Middleware;
use Closure; use Illuminate\Http\Request; use Symfony\Component\HttpFoundation\Response;
class EnsureAdminRole { public function handle(Request $request, Closure $next, string ...$roles): Response { $user=$request->user(); abort_unless($user && $user->is_active && in_array($user->role,$roles ?: ['admin','editor'],true),403,'You are not authorized to access this area.'); return $next($request); } }
